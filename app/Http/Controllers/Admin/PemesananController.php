<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Helpers\Alert;
use App\Pemesanan;
use Carbon\Carbon;
use Auth;

use DB;

class PemesananController extends Controller
{
    private $template = [
        'title' => 'Pemesanan Tiket',
        'route' => 'admin.pemesanan',
        'menu' => 'pemesanan',
        'icon' => 'fa fa-map',
        'theme' => 'skin-red'
    ]; 

    public function form(){
        $status = [
            ['value' => 1,'name' => 'Aktif'],
            ['value' => 0,'name' => 'Tidak Aktif']
        ];

        return [
            ['label' => 'Nama', 'name' => 'nama_kecak','view_index' => true],
            ['label' => 'Deskripsi','name' => 'deskripsi','type' => 'textarea'],
            ['label' => 'Jadwal','name' => 'jadwal', 'type' => 'datepicker', 'view_index' => true],
            ['label' => 'Status','name' => 'status', 'type' => 'select','option' => $status, 'view_index' => true],
            ['label' => 'Harga','name' => 'harga','type' => 'number', 'view_index' => true],
            ['label' => 'Foto','name' => 'foto', 'type' => 'file'],
            ['label' => 'Nama', 'name' => 'nama_kecak','view_index' => true],
        ];
    }

    public function index()
    {
        $data = DB::table('pemesanan')->select('pemesanan.id as pemesanan_id','pengunjung.nama as nama_pengunjung','kecak.nama_kecak','pemesanan.jumlah as jumlah_pesan','pemesanan.tanggal_pesan','pemesanan.status as status_pesan')
                                      ->join('kecak','kecak.id','=','pemesanan.kecak_id')
                                      ->join('pengunjung','pengunjung.id','=','pemesanan.pengunjung_id')
                                      ->leftJoin('user','user.id','=','pemesanan.user_id')
                                      ->orderBy('pemesanan.tanggal_pesan','asc')
                                      ->get();
        $template = (object) $this->template;
        return view('admin.pemesanan.index',compact('template','data'));
    }

    public function showConfirm($id){
        $data = DB::table('pemesanan')->select('pemesanan.*','kecak.nama_kecak','kecak.jadwal as jadwal_kecak','pengunjung.nama as nama_pengunjung','user.nama as nama_user')
                                      ->join('kecak','kecak.id','=','pemesanan.kecak_id')
                                      ->join('pengunjung','pengunjung.id','=','pemesanan.pengunjung_id')
                                      ->leftJoin('user','user.id','=','pemesanan.user_id')
                                      ->where('pemesanan.id',$id)
                                      ->get()->first();
        $template = (object) $this->template;
        return view('admin.pemesanan.konfirmasi',compact('template','data'));
    }

    public function ConfirmTicket(Request $request, $id)
    {
        Pemesanan::find($id)->update([
            'status' => 1,
            'user_id' => $request->user_id
        ]);

        Alert::make('success','Berhasil Konfirmasi Tiket A/n '.$request->nama_pengunjung);
        return redirect(route($this->template['route'].'.index'));
    }
}
