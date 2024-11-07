{{-- chat-component.blade.php --}}
<div class="chat-container" id="chat-container" wire:poll.10s="loadMessages">
    <div class="chat-messages" id="chat-messages">
        @foreach($messages as $message)
            <div class="message {{ $message->user_id === auth()->id() ? 'message-mine' : 'message-other' }}">
                <div class="message-header">
                    <strong>{{ $message->user->name }}</strong>
                    <span class="text-sm text-gray-500">
                        @if($message->created_at)
                            {{ $message->created_at->format('H:i') }}
                        @endif
                    </span>
                </div>
                <div class="message-content">
                    {!! preg_replace('/@([^\s]+(?:\s+[^\s]+)*)/', '<span class="mentioned-user">@$1</span>', e($message->message)) !!}
                </div>
            </div>
        @endforeach
    </div>

    <div class="chat-input relative">
        <form wire:submit.prevent="sendMessage">
            <div class="input-group position-relative"> 
                <input 
                    type="text" 
                    wire:model.defer="message" 
                    class="form-control @error('message') is-invalid @enderror" 
                    placeholder="@ ile kullanıcı etiketleyebilirsiniz..."
                >
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Gönder</button>
            </div>
        </form>
    </div>
</div>

