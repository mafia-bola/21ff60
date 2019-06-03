<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Administrasi;
use App\Helpers\AppHelper;
use Alert;

class AdministrasiController extends Controller
{
    private $template = [
        'title' => "Administrasi",
        'route' => 'admin.administrasi',
        'menu' => 'administrasi',
        'icon' => 'fa fa-users',
        'theme' => 'skin-red'
    ];

    public function form(){
        return [
            ['label' => 'Judul', 'name' => 'judul','view_index' => true],
            ['label' => 'File', 'name' => 'file','view_index' => true,'type' => 'file','required' => ['create']],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Administrasi::where('desa_id',auth()->user()->desa_id)
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
            'judul' => 'required',
            'file' => 'required'
        ]);
        $files = AppHelper::uploader($this->form(),$request);
        Administrasi::create([
            'desa_id' => auth()->user()->desa_id,
            'file' => $files['file'],
            'judul' => $request->judul
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
        $data = Administrasi::findOrFail($id);
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
        $data = Administrasi::findOrFail($id);
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
            'judul' => 'required'
        ]);
        $adm = Administrasi::find($id);
        $file = $adm->file;
        if($request->hasFile('file')){
            $file = AppHelper::uploader($this->form(),$request)['file'];
        }
        $adm->update([
            'judul' => $request->judul,
            'file' => $file
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
        Administrasi::find($id)->delete();
        Alert::make('success','Berhasil hapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
