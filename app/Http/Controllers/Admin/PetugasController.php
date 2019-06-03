<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\AppHelper;
use App\Helpers\Alert;
use Carbon\Carbon;
use App\Rules\PackageLimit;

class PetugasController extends Controller
{
    private $template = [
        'title' => "Petugas",
        'route' => 'admin.petugas',
        'menu' => 'petugas',
        'icon' => 'fa fa-user',
        'theme' => 'skin-red'
    ];

    public function form(){
        $status = [
            ['value' => 1,'name' => 'Aktif'],
            ['value' => 0,'name' => 'Tidak Aktif']
        ];

        return [
            ['label' => 'Nama Pengguna', 'name' => 'nama','view_index' => true],
            ['label' => 'Alamat', 'name' => 'alamat','view_index' => true],
            ['label' => 'Tanggal Lahir','name' => 'tgl_lahir', 'type' => 'datepicker'],
            ['label' => 'Email','name' => 'email','view_index' => true],
            ['label' => 'Telepon','name' => 'telepon','view_index' => true],
            ['label' => 'Password','name' => 'password','type' => 'password'],
            ['label' => 'Status','name' => 'status', 'type' => 'select','option' => $status],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('desa_id',auth()->user()->desa_id)
            ->where('role','Petugas')
            ->get();
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.index',compact('data','form','template'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.create',compact('form','template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'email|required|unique:user,email',
            'password' => 'required|confirmed|min:6',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => ['required', new PackageLimit('User','user_limit',auth()->user()->desa_id)]
        ]);
        User::create([
            'desa_id' => auth()->user()->desa_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'role' => 'Petugas'
        ]);
        Alert::make('success','Berhasil simpan data');
        return redirect(route($this->template['route'].'.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $data = User::findOrFail($id);
        return view('admin.master.show',compact('template','form','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $data = User::findOrFail($id);
        return view('admin.master.edit',compact('template','form','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'email' => "email|required|unique:user,email,$id",
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required'
        ]);
        $user = User::find($id);
        $password = $user->password;
        if(!empty($request->password)){
            $request->validate([
                'password' => 'confirmed|min:6'
            ]);
            $password = bcrypt($request->password);
        }
        $user->update([
            'email' => $request->email,
            'password' => $password,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);
        Alert::make('success','Berhasil simpan data');
        return redirect(route($this->template['route'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Alert::make('success','Berhasil hapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
