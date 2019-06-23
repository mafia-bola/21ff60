<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengunjung;
use App\Kecak;
use App\Pemesanan;
use Hash;
class ApiController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Pengunjung::insert($data);
        return response()->json(['status' => 'sukses', 'pengunjung' => $data]);
    }

    public function login(Request $request)
    {
        $data = Pengunjung::where('email',$request->email)->get();
        if($data->count() > 0){      
            if(Hash::check($request->password,$data->first()->password)){
                return response()->json(['status' => '1','pengunjung' => $data]);
            }else{
                return response()->json(['status' => '0','message' => 'Password salah, mohon masukkan kembali']);
            }            
        }else{
            return response()->json(['status' => '0','message' => 'Email tidak ditemukan']);
        }
    }

    public function getTiketKecak(Request $request)
    {
        $data = Kecak::select('*');
        return response()->json(['info' => 'aktif', 'kecak' => $data]);
    }

    public function getPengunjung(Request $request, $id_pengunjung)
    {
        $data = Pengunjung::select('*')
        ->join('kecak','kecak.id','=','pengunjung.id')
        ->where('email', $id_pengunjung)->get();
        return response()->json(['info' => 'tersedia', 'kecak' => $data]);
    }

    // public function getPemesanan(Request $request, $id_pengunjung)
    // {
    //     $data = Pemesanan::select('*')
    //     ->join('pengunjung','pengunjung.id','=','pemesanan.pengunjung_id')
    //     ->join('kecak','kecak.id','=','pemesanan.kecak_id')
    //     ->where('pemesanan.pengunjung_id', $id_pengunjung)->get();
    //     return response()->json(['info' => 'aktif', 'kecak' => $data]);
    // }
}
