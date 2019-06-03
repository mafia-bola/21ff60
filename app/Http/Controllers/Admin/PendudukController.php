<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penduduk;
use Carbon\Carbon;
use Alert;

class PendudukController extends Controller
{
    private $template = [
        'title' => "Penduduk",
        'route' => 'admin.penduduk',
        'menu' => 'penduduk',
        'icon' => 'fa fa-group',
        'theme' => 'skin-red'
    ];

    public function form(){
        $jenis = [
            ['value' => 'Laki Laki','name' => 'Laki Laki'],
            ['value' => 'Perempuan','name' => 'Perempuan']
        ];
        $agama = [
            ['value' => 'Hindu','name' => 'Hindu'],
            ['value' => 'Islam','name' => 'Islam'],
            ['value' => 'Katolik','name' => 'Katolik'],
            ['value' => 'Protestan','name' => 'Protestan'],
            ['value' => 'Budha','name' => 'Budha'],
            ['value' => 'Konghuchu','name' => 'Konghuchu'],
        ];
        return [
           ['label' => 'NIK','name' => 'nik','view_index' => true],
           ['label' => 'Nama','name' => 'nama','view_index' => true],
           ['label' => 'Jenis Kelamin', 'name' => 'jenis_kelamin','type' => 'select', 'option' => $jenis, 'view_index' => true],
           ['label' => 'Tempat Lahir','name' => 'tempat_lahir','view_index' => true],
           ['label' => 'Tanggal Lahir','name' => 'tgl_lahir', 'type' => 'datepicker'],
           ['label' => 'Agama','name' => 'agama','type' => 'select','option' => $agama,'view_index' => true],
           ['label' => 'Pekerjaan','name' => 'pekerjaan','view_index' => true],
           ['label' => 'Golongan Darah','name' => 'golongan_darah','view_index' => true],
           ['label' => 'Status','name' => 'status','view_index' => true]
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penduduk::where('desa_id',auth()->user()->desa_id)
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
        $request->validate([
            'nik' => 'required|unique:penduduk,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status' => 'required'
        ]);

        Penduduk::create([
            'desa_id' => auth()->user()->desa_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'golongan_darah' => $request->golongan_darah,
            'status' => $request->status
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
        $data = Penduduk::findOrFail($id);
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
        $data = Penduduk::findOrFail($id);
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
            'nik' => 'required|unique:penduduk,nik,'.$id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status' => 'required'
        ]);
        Penduduk::find($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'golongan_darah' => $request->golongan_darah,
            'status' => $request->status
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
        Penduduk::find($id)->delete();
        Alert::make('success','Berhasil hapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
