<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengunjung;
use App\Kecak;
use App\Pemesanan;
use Hash;
use Storage;
use App\Helpers\AppHelper;
use App\Helpers\Alert;
class ApiController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Pengunjung::insert($data);
        return response()->json(['status' => 'sukses', 'pengunjung' => $data]);
    }

    public function getPesan(Request $request, $id)
    {
        $data = Pemesanan::select('pemesanan.*','kecak.foto','kecak.nama_kecak')
        ->where('pengunjung_id',$id)
        ->join('kecak', 'kecak.id', '=', 'pemesanan.kecak_id')
        ->where('pemesanan.status','0')->get();
        return response()->json(['status' => 'tersedia','data' => $data]);
    }

    public function setPesan(Request $request)
    {
        $pemesanan = Pemesanan::create([
            'pengunjung_id'=>$request->pengunjung_id,
            'kecak_id'=>$request->kecak_id,
            'tanggal_pesan'=>$request->tanggal_pesan,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'total'=>$request->total
        ]);
        return response()->json(['status' => 'sukses', 'pemesanan' => $pemesanan]);
    }

    public function konfirmasiPesan(Request $request, $id)
    {
        $file_name = 'image_'.time().".png";
        Storage::disk('public')->put($file_name,base64_decode($request->bukti_transfer));
        $pemesanan = Pemesanan::find($id)->update([
            'bukti_transfer'=>$file_name,
            'no_rekening'=>$request->no_rekening,
            'nama_bank'=>$request->nama_bank
        ]);
        if($pemesanan){
            return response()->json(['status' => 'sukses', 'konfirmasi' => $pemesanan]);
        } else {
            return response()->json(['status' => 'gagal']);
        }
    }

    public function getHistory(Request $request, $id)
    {
        $data = Pemesanan::select('pemesanan.*','kecak.foto','kecak.nama_kecak')
        ->where('pengunjung_id',$id)
        ->join('kecak', 'kecak.id', '=', 'pemesanan.kecak_id')
        ->where('pemesanan.status','1')->get();
        return response()->json(['status' => 'tersedia','data' => $data]);
    }

    public function login(Request $request)
    {
        $data = Pengunjung::select('*')
        ->where('email',$request->email)->get();
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
        $data = Kecak::all();
        return response()->json(['info' => 'tersedia', 'kecak' => $data]);
    }

    public function getPengunjung(Request $request)
    {
        $data = Pengunjung::all();
        return response()->json(['info' => 'tersedia', 'kecak' => $data]);
    }
}
