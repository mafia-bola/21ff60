<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Desa;
use App\Helpers\Alert;

class DesaController extends Controller
{
    private $template = [
        'title' => 'Desa',
        'route' => 'admin.desa',
        'menu' => 'desa',
        'icon' => 'fa fa-map',
        'theme' => 'skin-red'
    ];

    private function form()
    {
        return [
            ['label' => 'Nama Desa', 'name' => 'nama_desa','view_index' => true],
            ['label' => 'Deskripsi Desa', 'name' => 'deskripsi', 'type' => 'textarea'],
            ['label' => 'Alamat','name' => 'alamat','type' => 'textarea'],
            ['label' => 'Telepon','name' => 'telepon','type' => 'text'],
            ['label' => 'Email','name' => 'email','type' => 'email','view_index' => true],
            ['label' => 'Status Desa', 'name' => 'status_desa','view_index' => true],
            ['label' => 'Maksimal User', 'name' => 'user_limit','type' => 'number','view_index' => true],
            ['label' => 'Maksimal Kegiatan','name' => 'limit_kegiatan', 'type' => 'number','view_index' => true],
            ['label' => 'Peta','type' => 'text','name' => 'peta']
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = (object) $this->template;
        $data = Desa::all();
        $form = $this->form();
        return view('admin.master.index',compact('template','data','form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = (object)$this->template;
        $form = $this->form();
        return view('admin.master.create',compact('template','form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'status_desa' => 'required',
            'user_limit' => 'required',
            'limit_kegiatan' => 'required'
        ]);

        Desa::create([
            'nama_desa' => $request->nama_desa,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'status_desa' => $request->status_desa,
            'user_limit' => $request->user_limit,
            'limit_kegiatan' => $request->limit_kegiatan
        ]);

        Alert::make('success','Berhasil  simpan data');
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
        $template = (object)$this->template;
        $form = $this->form();
        $data = Desa::findOrFail($id);
        return view('admin.master.show',compact('template','data','form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Desa::findOrFail($id);
        $template = (object)$this->template;
        $form = $this->form();
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
        $request->validate([
            'nama_desa' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'email' => "required|unique:desa,email,$id",
            'status_desa' => 'required',
            'user_limit' => 'required',
            'limit_kegiatan' => 'required'
        ]);
        $data = $request->all();
        Desa::find($id)->update($data);
        Alert::make('success','Berhasil mengubah data');
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
        Desa::find($id)->delete();
        Alert::make('success','Berhasil menghapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
