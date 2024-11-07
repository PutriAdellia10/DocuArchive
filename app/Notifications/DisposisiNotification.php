<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DisposisiNotification extends Notification
{
    use Queueable;

    protected $disposisi;

    public function __construct($disposisi)
    {
        $this->disposisi = $disposisi;
    }

    public function via($notifiable)
    {
        return ['database'];  // Hanya simpan di database
    }

    public function toArray($notifiable)
    {
        return [
            'disposisi_id' => $this->disposisi->id,
            'message' => 'Anda menerima disposisi baru: ' . $this->disposisi->keterangan,
            'url' => route('disposisi.show', $this->disposisi->id),
        ];
    }
}
