<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SurecIlerlemeBildirimi extends Notification implements ShouldQueue
{
    use Queueable;

    protected $proje;

    public function __construct($proje)
    {
        $this->proje = $proje;
    }

    // Bildirimi hangi kanallar aracılığıyla gönderileceğini belirtiyoruz
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // E-posta bildirimi oluşturma
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Proje Süreci İlerletildi')
            ->line('Projenizin süreci bir sonraki aşamaya ilerletildi: Teknik Çizimler Yapıldı.')
            ->action('Proje Detayları', url('/dashboard/proje-detay/' . $this->proje->id))  
            ->line('Proje hakkında daha fazla bilgi almak için yukarıdaki bağlantıya tıklayabilirsiniz.');
    }

    // Veritabanı bildirimi oluşturma
    public function toDatabase($notifiable)
    {
        return [
            'proje_id' => $this->proje->id,
            'title' => 'Proje Süreci İlerletildi',
            'message' => 'Projenizin süreci bir sonraki aşamaya ilerletildi: Teknik Çizimler Yapıldı.',
            'url' => url('/dashboard/proje-detay/' . $this->proje->id),
        ];
    }
}
