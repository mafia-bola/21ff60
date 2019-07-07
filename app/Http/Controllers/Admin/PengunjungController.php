<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengunjung;
use App\Helpers\Alert;
use App\Pemesanan;
use Carbon\Carbon;
use DB;

class PengunjungController extends Controller
{
    private $template = [
        'title' => 'Pengunjung',
        'route' => 'admin.pengunjung',
        'menu' => 'pengunjung',
        'icon' => 'fa fa-map',
        'theme' => 'skin-red'
    ]; 

    public function form(){
        return [
            ['label' => 'Nama', 'name' => 'nama','view_index' => true],
            ['label' => 'Alamat','name' => 'alamat', 'view_index' => true],
            ['label' => 'Email','name' => 'jadwal','view_index' => true]
        ];
    }

    public function index()
    {
        $data = DB::table('pengunjung')->select('pengunjung.id as pengunjung_id','pengunjung.*')
                                       ->get();
        $template = (object) $this->template;
        return view('admin.pengunjung.index',compact('template','data'));
    }

    public function show($pengunjung_id)
    {
        $pengunjung = DB::table('pengunjung')->select('pengunjung.id as pengunjung_id','pengunjung.*')
                                       ->where('id',$pengunjung_id)
                                       ->get()->first();

        $pemesanan = DB::table('pemesanan')->select('pemesanan.*','kecak.nama_kecak','kecak.jadwal')
                                           ->join('kecak','kecak.id','=','pemesanan.kecak_id')
                                           ->join('pengunjung','pengunjung.id','=','pemesanan.pengunjung_id')
                                           ->where('pengunjung.id',$pengunjung_id)
                                           ->get();
        $template = (object) $this->template;
        return view('admin.pengunjung.detail',compact('template','pengunjung','pemesanan'));
    }
}
