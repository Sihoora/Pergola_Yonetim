<?php
namespace App\Http\Livewire;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message = '';
    public $messages;
    public $users = [];
    
    protected $listeners = [
        'messageReceived' => 'handleReceivedMessage'
    ];

    public function mount()
    {
        $this->loadMessages();
    }

    public function getUsersList($search = '')
    {
        Log::info('Searching users with query: ' . $search);
        
        $search = trim($search);
        
        return User::where(function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->where('id', '!=', auth()->id())
        ->orderBy('name')
        ->limit(10)
        ->get(['id', 'name'])
        ->toArray();
    }

    public function loadMessages()
    {
        $this->messages = ChatMessage::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();
    }


    public function sendMessage()
    {
        if (empty(trim($this->message))) {
            return;
        }

         // regex pattern
        preg_match_all('/@([^\s@]+(?:\s+[^\s@]+)*)/', $this->message, $matches);
        $mentionedUsers = [];
        
        if (!empty($matches[1])) {
            Log::info('Found mentions:', $matches[1]);
            
            $mentionedUsernames = array_map('trim', $matches[1]);
            $mentionedUsers = User::whereIn('name', $mentionedUsernames)
                ->pluck('id')
                ->toArray();
                
            Log::info('Mentioned user IDs:', $mentionedUsers);
        }

        $newMessage = ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $this->message,
            'mentions' => !empty($mentionedUsers) ? $mentionedUsers : null
        ]);

        $newMessage->load('user');
        
        broadcast(new MessageSent($newMessage))->toOthers();
        
        $this->messages->push($newMessage);
        $this->message = '';
        $this->emit('scrollToBottom');
    }


    public function handleReceivedMessage($messageData)
    {
        try {
            if ($this->messages->contains('id', $messageData['id'])) {
                return;
            }

            $newMessage = ChatMessage::with('user')->find($messageData['id']);
            
            if ($newMessage) {
                $this->messages->push($newMessage);
            } else {
                $newMessage = new ChatMessage([
                    'id' => $messageData['id'],
                    'user_id' => $messageData['user_id'],
                    'message' => $messageData['message'],
                    'mentions' => $messageData['mentions'] ?? null,
                    'created_at' => \Carbon\Carbon::parse($messageData['created_at'])
                ]);

                $user = new User([
                    'id' => $messageData['user_id'],
                    'name' => $messageData['user_name']
                ]);

                $newMessage->setRelation('user', $user);
                $this->messages->push($newMessage);
            }
            
            $this->emit('scrollToBottom');
            
        } catch (\Exception $e) {
            Log::error('Error handling received message: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.chat-component', [
            'messages' => $this->messages
        ]);
    }
}