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

    public function getPesan(Request $request, $id)
    {
        $data = Pemesanan::where('pengunjung_id',$id)->get();
        return response()->json(['data' => $data]);
    }

    public function setPesan(Request $request)
    {
        $Pemesanan = Pemesanan::create([
            'pengunjung_id'=>$request->pengunjung_id,
            'kecak_id'=>$request->kecak_id,
            'tanggal_pesan'=>$request->tanggal_pesan,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'total'=>$request->total
        ]);
        return response()->json(['status' => 'sukses', 'pemesanan' => $Pemesanan]);
    }

    public function konfirmasiPesan(Request $request, $id)
    {
        $Pemesanan = Pemesanan::find($id)->update([
            'bukti_transfer'=>$request->bukti_transfer,
            'no_rekening'=>$request->no_rekening,
            'nama_bank'=>$request->nama_bank
        ]);
        if($Pemesanan){
            return response()->json(['status' => 'sukses', 'konfirmasi' => $Pemesanan]);
        } else {
            return response()->json(['status' => 'gagal']);
        }
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
        $data = Kecak::all();
        return response()->json(['info' => 'tersedia', 'kecak' => $data]);
    }

    public function getPengunjung(Request $request, $id_pengunjung)
    {
        $data = Pengunjung::select('*')
        ->join('kecak','kecak.id','=','pengunjung.id')
        ->where('email', $id_pengunjung)->get();
        return response()->json(['info' => 'tersedia', 'kecak' => $data]);
    }
}
