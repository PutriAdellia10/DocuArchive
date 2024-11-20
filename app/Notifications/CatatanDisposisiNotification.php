<?php

namespace App\Notifications;

use App\Models\Disposisi;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CatatanDisposisiNotification extends Notification
{
    use Queueable;

    protected $disposisi;

    public function __construct(Disposisi $disposisi)
    {
        $this->disposisi = $disposisi;
    }

    public function via($notifiable)
    {
        return ['database']; // Menggunakan database untuk menyimpan notifikasi
    }

    public function toDatabase($notifiable)
    {
        return [
            'disposisi_id' => $this->disposisi->id,
            'catatan' => $this->disposisi->catatan,  // Catatan dari disposisi
            'message' => 'Catatan disposisi baru tersedia untuk surat ID ' . $this->disposisi->surat_id,
        ];
    }
}
