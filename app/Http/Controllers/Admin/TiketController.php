<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Helpers\Alert;
use Carbon\Carbon;
use App\Kecak;
use Storage;

class TiketController extends Controller
{
    private $template = [
        'title' => 'Tiket Kecak',
        'route' => 'admin.tiket',
        'menu' => 'tiket',
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
            ['label' => 'Jadwal', 'name' => 'jadwal','view_index' => true],
            // ['label' => 'Jadwal','name' => 'jadwal', 'type' => 'datepicker', 'view_index' => true],
            ['label' => 'Status','name' => 'status', 'type' => 'select','option' => $status, 'view_index' => true],
            ['label' => 'Harga','name' => 'harga','type' => 'number', 'view_index' => true],
            ['label' => 'Foto','name' => 'foto', 'type' => 'file'],
        ];
    }

    public function index()
    {
        $data = Kecak::all();
        $template = (object) $this->template;
        $form = $this->form();
        return view('admin.master.index',compact('template','form','data'));
    }

    public function create()
    {
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.create',compact('form','template'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kecak' => 'required',
            'jadwal' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'foto' => 'required|file',
            'deskripsi' => 'required',
        ]);

        $path = $request->foto->store('public/files_kecak');

        Kecak::create([
            'nama_kecak' => $request->nama_kecak,
            'jadwal' => $request->jadwal,
            'status' => $request->status,
            'foto' => '/storage/files_kecak/'.$request->foto->hashname(),
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::make('success','Berhasil simpan data');
        return redirect(route($this->template['route'].'.index'));
    }


    public function show($id)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $data = Kecak::findOrFail($id);
        return view('admin.master.show',compact('template','form','data'));
    }


    public function edit($id)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $data = Kecak::findOrFail($id);
        return view('admin.master.edit',compact('template','form','data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kecak' => 'required',
            'jadwal' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'foto' => 'required',
            'deskripsi' => 'required',
        ]);

        $path = $request->foto->store('public/files_kecak');

        Kecak::find($id)->update([
            'nama_kecak' => $request->nama_kecak,
            'jadwal' => $request->jadwal,
            'status' => $request->status,
            'foto' => $path,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::make('success','Berhasil Update data');
        return redirect(route($this->template['route'].'.index'));


    }

    public function destroy($id)
    {
        // Kecak::find($id)->delete();
        // Alert::make('success','Berhasil hapus data');
        // return redirect(route($this->template['route'].'.index'));
    }
}
