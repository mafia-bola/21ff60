<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Pemesanan;
use Mail;
use App\Mail\MailNotification;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $pengunjung;
    public $jadwal_kecak;
    public $total_harga;
    public $jumlah_tiket;
    public $nama_kecak;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $pengunjung, $jadwal_kecak, $total_harga, $jumlah_tiket, $nama_kecak)
    {
        $this->pengunjung = $pengunjung;
        $this->nama_kecak = $nama_kecak;
        $this->jadwal_kecak = $jadwal_kecak;
        $this->total_harga = $total_harga;
        $this->jumlah_tiket = $jumlah_tiket;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new MailNotification($this->pengunjung, $this->nama_kecak, $this->jadwal_kecak, $this->total_harga, $this->jumlah_tiket));
    }
}
