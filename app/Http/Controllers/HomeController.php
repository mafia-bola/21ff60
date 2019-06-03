<?php

namespace App\Http\Controllers;
use App\Desa;
use App\Penduduk;
use App\Kegiatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('admin.auth.login');
        // $desa = Desa::where('nama_desa','dalung')->get()->first();
        // $totalPenduduk = Penduduk::where('desa_id',$desa->id)->get()->count();
        // $totalLaki= Penduduk::where('jenis_kelamin','Laki Laki')->where('desa_id',$desa->id)->get()->count();
        // $totalPerempuan = Penduduk::where('jenis_kelamin','Perempuan')->where('desa_id',$desa->id)->get()->count();
        // $kegiatan = Kegiatan::where('desa_id',$desa->id)->get();
        // return view('web.index',compact('desa','totalPenduduk','totalLaki','totalPerempuan','kegiatan'));
    }
}
