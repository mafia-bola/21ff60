<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pengunjung;
    public $jadwal_kecak;
    public $total_harga;
    public $jumlah_tiket;
    public $nama_kecak;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pengunjung, $jadwal_kecak, $total_harga, $jumlah_tiket, $nama_kecak)
    {
        $this->pengunjung = $pengunjung;
        $this->nama_kecak = $nama_kecak;
        $this->jadwal_kecak = $jadwal_kecak;
        $this->total_harga = $total_harga;
        $this->jumlah_tiket = $jumlah_tiket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notifikasi Tiket')->view('mailable.email-notification',['pengunjung' => $this->pengunjung, 'nama_kecak' => $this->nama_kecak, 'jadwal_kecak' => $this->jadwal_kecak,'total_harga' => $this->total_harga,'jumlah_tiket' => $this->jumlah_tiket]);
    }
}
