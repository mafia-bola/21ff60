<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kegiatan;
use App\Helpers\AppHelper;
use App\Helpers\Alert;
use App\Rules\PackageLimit;

class KegiatanController extends Controller
{
    private $template = [
        'title' => "Kegiatan",
        'route' => 'admin.kegiatan',
        'menu' => 'kegiatan',
        'icon' => 'fa fa-group',
        'theme' => 'skin-red'
    ];

    public function form(){
        $kategori = [
            ['value' => 'Berita','name' => 'Berita'],
            ['value' => 'Sosial','name' => 'Sosial'],
            ['value' => 'Lomba','name' => 'Lomba']
        ];
        return [
            ['label' => 'Judul Kegiatan', 'name' => 'judul_kegiatan','view_index' => true],
            ['label' => 'Isi Kegiatan', 'name' => 'isi_kegiatan','type' => 'ckeditor'],
            ['label' => 'Kategori', 'name' => 'kategori','type' => 'select','option' => $kategori,'view_index' => true],
            ['label' => 'Foto Kegiatan', 'name' => 'foto_kegiatan', 'type' => 'file','required' => ['create']]
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
        $form = $this->form();
        $data = Kegiatan::where('desa_id',auth('admin')->user()->desa_id)
            ->get();
        return view('admin.master.index',compact('template','data','form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = (object) $this->template;
        $form = $this->form();
        return view('admin.master.create', compact('template','form'));
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
            'judul_kegiatan' => ['required',new PackageLimit('Kegiatan','limit_kegiatan',auth()->user()->desa_id)],
            'isi_kegiatan' => 'required',
            'kategori' => 'required',
            'foto_kegiatan' => 'required|mimes:png,jpg,jpeg'
        ]);
        $file = AppHelper::uploader($this->form(),$request);
        Kegiatan::create([
            'judul_kegiatan' => $request->judul_kegiatan,
            'isi_kegiatan' => $request->isi_kegiatan,
            'foto_kegiatan' => $file['foto_kegiatan'],
            'desa_id' => auth()->user()->desa_id,
            'user_id' => auth()->user()->id,
            'kategori' => $request->kategori
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
        $template = (object) $this->template;
        $form = $this->form();
        $data = Kegiatan::findOrFail($id);
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
        $data = Kegiatan::findOrFail($id);
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
            'judul_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
            'kategori' => 'required',
        ]);
        $kegiatan = Kegiatan::findOrFail($id);
        $foto = $kegiatan->foto_kegiatan;
        if($request->hasFile('foto_kegiatan')){
            $request->validate([
                'foto_kegiatan' => 'mimes:jpg,png,jpeg'
            ]);
            $foto = AppHelper::uploader($this->form(),$request)['foto_kegiatan'];
        }
        $kegiatan->update([
            'judul_kegiatan' => $request->judul_kegiatan,
            'isi_kegiatan' => $request->isi_kegiatan,
            'foto_kegiatan' => $foto,
            'kategori' => $request->kategori
        ]);
        Alert::make('success','Berhasil  simpan data');
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
        Kegiatan::find($id)->delete();
        Alert::make('success','Berhasil hapus data');
        return redirect(route($this->template['route'].'.index'));
    }
}
