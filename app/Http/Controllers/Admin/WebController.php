<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GambarDepan;
use Alert;
use App\Helpers\AppHelper;

class WebController extends Controller
{
    private $template = [
        'title' => "Web",
        'route' => 'admin.web',
        'menu' => 'web',
        'icon' => 'fa fa-globe',
        'theme' => 'skin-red'
    ];

    public function form(){
       return [
           ['label' => 'Slide Gambar','name' => 'gambar', 'type' => 'file','view_index' => true]
       ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GambarDepan::where('desa_id',auth()->user()->desa_id)
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
            'gambar' => 'required|mimes:jpg,png,jpeg,svg'
        ]);
        $files = AppHelper::uploader($this->form(),$request);
        GambarDepan::create([
            'desa_id' => auth()->user()->desa_id,
            'gambar' => $files['gambar']
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
        $data = GambarDepan::findOrFail($id);
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
        $data = GambarDepan::findOrFail($id);
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
            'gambar' => 'required|mimes:jpg,png,jpeg'
        ]);
        $gambarDepan = GambarDepan::find($id);
        $gbr = $gambarDepan->gambar;
        if($request->hasFile('gambar')){
            $gbr = AppHelper::uploader($this->form(),$request)['gambar'];
        }
        $gambarDepan->update([
            'gambar' => $gbr
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
        GambarDepan::find($id)->delete();
        Alert::make('success','Berhasil hapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
