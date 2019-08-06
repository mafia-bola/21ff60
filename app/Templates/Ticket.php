<?php
/**
 * Author : Pande
 * CLass untuk render
 */
namespace App\Templates;

use App\Pemesanan;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use File;
use Carbon\Carbon;
use Hashid;

class Ticket
{
    protected $pemesanan;
    protected $template_path;
    protected $file_name;
    protected $template_processor;
    protected $save_path;
    protected $download_path;

    function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
        $this->template_path = 'templates.ticket';
        $this->save_path = storage_path('app/public/downloads');
        $this->template_processor = new Mpdf([
            'tempDir' => storage_path('app/public/temp'),
            'margin_top' => 0,
            'format' => 'A7-L',
            // 'orientation' => 'L',
            // [10, 54]
        ]);
        $this->file_name = $this->pemesanan->ps_id.'_kecak_ticket.pdf';
    }

    public function render()
    {
        $html_resource = view($this->template_path)->with([
            'id' => strtoupper($this->pemesanan->id),
            'kode_tiket' => '#'.str_pad($this->pemesanan->id,6,"0",STR_PAD_LEFT),
            'tanggal_pesan' => date("d F Y", strtotime($this->pemesanan->tanggal_pesan)),
            'jumlah_tiket' => $this->pemesanan->jumlah,
            'harga_tiket' => $this->pemesanan->harga,
            'total_harga' => $this->pemesanan->total,
            'pengunjung' => ucwords($this->pemesanan->nama),
            'alamat_pengunjung' => ucwords($this->pemesanan->alamat),
            'email_pengunjung' => ucwords($this->pemesanan->email),
            'jadwal_kecak' => $this->pemesanan->jadwal,
            'nama_kecak' => ucwords($this->pemesanan->nama_kecak)
        ])->render();

        $this->template_processor->WriteHTML($html_resource);
        $this->download_path = $this->save_path.'/'.$this->file_name;
        $this->save();

        return $this->download_path;
    }

    public function save()
    {
        $this->template_processor->Output(storage_path('app/public/downloads/'.$this->file_name), Destination::FILE);
    }
}

?>
