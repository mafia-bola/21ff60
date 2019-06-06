<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengunjung;
use Hash;
class ApiController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Pengunjung::insert($data);
        return response()->json($data);
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
}
