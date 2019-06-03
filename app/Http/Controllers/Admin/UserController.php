<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Helpers\Alert;
use Carbon\Carbon;

class UserController extends Controller
{
    private $template = [
        'title' => 'User',
        'route' => 'admin.user',
        'menu' => 'user',
        'icon' => 'fa fa-users',
        'theme' => 'skin-red'
    ];

    private function form()
    {
        $status = [
            ['value' => 1,'name' => 'Aktif'],
            ['value' => 0,'name' => 'Tidak Aktif']
        ];

        $akses = [
            ['value' => 'admin','name' => 'admin'],
        ];

        return [
            ['label' => 'Nama Pengguna', 'name' => 'nama','view_index' => true],
            ['label' => 'Alamat', 'name' => 'alamat','view_index' => true],
            ['label' => 'Tanggal Lahir','name' => 'tgl_lahir', 'type' => 'datepicker'],
            ['label' => 'Tempat Lahir','name' => 'tempat_lahir',],
            ['label' => 'Username','name' => 'username','view_index' => true,],
            ['label' => 'Akses','name' => 'role','view_index' => true,'type' => 'select','option' => $akses],
            ['label' => 'Password','name' => 'password', 'type' => 'password'],
            ['label' => 'Status','name' => 'status', 'type' => 'select','option' => $status],
        ];
    }

    public function index()
    {
        $template = (object) $this->template;
        $data = User::all();
        $form = $this->form();
        return view('admin.master.index',compact('template','data','form'));
    }

    public function create()
    {
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.create',compact('template','form'));
    }

    public function store(Request $request)
    {
        $username = User::where('username',$request->username)->get();
        $count = $username->count();
        if($count > 0){
            Alert::make('danger','Username sudah dipakai, silahkan buat username yang lain');
            return redirect(route($this->template['route'].'.create'));
        }
        else{
            $request->validate([    
                'nama' => 'required',
                'alamat' => 'required',
                'tgl_lahir' => 'required',
                'tempat_lahir' => 'required',
                'username' => 'required',
                'role' => 'required',
                'password' => 'required|confirmed|min:6',
                'status' => 'required',
            ]);
            
            User::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
                'tempat_lahir' => $request->tempat_lahir,
                'username' => $request->username,
                'role' => $request->role,
                'password' => bcrypt($request->password),
                'status' => $request->status,
            ]);
        }
    }

    public function show($id)
    {
        $template = (object)$this->template;
        $form = $this->form();
        $data = User::findOrFail($id);
        return view('admin.master.show',compact('template','data','form'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $template = (object)$this->template;
        $form = $this->form();
        return view('admin.master.edit',compact('template','form','data'));
    }

    public function update(Request $request, $id)
    {
        $username = User::where('username',$request->username)->where('id','!=',$id)->get();
        $count = $username->count();
        if($count > 0){
            Alert::make('danger','Username sudah dipakai, silahkan buat username yang lain');
            return redirect(route($this->template['route'].'.edit'));
        }
        else{
            $request->validate([    
                'nama' => 'required',
                'alamat' => 'required',
                'tgl_lahir' => 'required',
                'tempat_lahir' => 'required',
                'username' => 'required',
                'role' => 'required',
                'status' => 'required',
            ]);
            if($request->password != null){
                $request->validate([
                    'password' => 'required|confirmed|min:6'
                ]);
            }

            User::find($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
                'tempat_lahir' => $request->tempat_lahir,
                'username' => $request->username,
                'role' => $request->role,
                'password' => bcrypt($request->password),
                'status' => $request->status,
            ]);
        }

        Alert::make('success','Berhasil mengubah data');
        return redirect(route($this->template['route'].'.index'));
    }

    public function destroy($id)
    {
        $user_id = Auth::guard('admin')->user()->id;
        if($user_id == $id){
            Alert::make('danger','Anda Tidak Dapat Mengapus Data Ini');
            return redirect(route($this->template['route'].'.index'));
        }else{
            User::find($id)->delete();
            Alert::make('success','Berhasil menghapus data');
            return redirect(route($this->template['route'].'.index'));
        }
    }

    public function profile()
    {
        
    }
}
