<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StatusPesananBerubah extends Notification
{
    use Queueable;

    public $pesanan;

    public function __construct($pesanan)
    {
        $this->pesanan = $pesanan;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Notifikasi via email dan database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Status Pesanan Anda Telah Berubah')
            ->greeting('Hai ' . $notifiable->nama)
            ->line('Status pesanan Anda untuk ' . $this->pesanan->item . ' telah berubah menjadi: **' . strtoupper($this->pesanan->status) . '**.')
            ->action('Lihat Pesanan', url('/dashboard'))
            ->line('Terima kasih telah memesan bersama kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'status' => $this->pesanan->status,
            'item' => $this->pesanan->item,
            'message' => 'Status pesanan Anda telah berubah menjadi: ' . strtoupper($this->pesanan->status),
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'status' => $this->pesanan->status,
            'item' => $this->pesanan->item,
            'message' => 'Status pesanan Anda telah berubah menjadi: ' . strtoupper($this->pesanan->status),
        ];
    }
}

