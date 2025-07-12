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
    $url = '';

    // Cek apakah yang menerima notifikasi adalah pelanggan atau admin
    if ($notifiable instanceof \App\Models\Pelanggan) {
        // arahkan pelanggan ke dashboard atau detail pesanan
        $url = route('pesanan.show', $this->pesanan->id_pesanan); // jika tersedia
    } else {
        // arahkan admin ke halaman pesanan spesifik
        $url = route('admin.pesanan.show', $this->pesanan->id_pesanan);

    }

    return [
        'pesan' => 'Pesanan #' . $this->pesanan->id_pesanan . ' status berubah menjadi "' . ucfirst($this->pesanan->status) . '".',
        'pesanan_id' => $this->pesanan->id_pesanan,
        'status' => $this->pesanan->status,
        'url' => $url
    ];
}



    public function toDatabase($notifiable)
{
    $status = ucfirst($this->pesanan->status);
    $namaItem = $this->pesanan->item;
    $id = $this->pesanan->id_pesanan;

    return [
        'pesanan_id' => $id,
        'status' => $status,
        'message' => "Pesanan {$namaItem} telah {$status}.",
        'link' => route(
            $notifiable instanceof \App\Models\Admin
                ? 'admin.pesanan.show'
                : 'dashboard'
            , $id),
    ];
}

}

