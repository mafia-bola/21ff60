<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengunjungController extends Controller
{
    private $template = [
        'title' => 'Pengunjung',
        'route' => 'admin.pengunjung',
        'menu' => 'pengunjung',
        'icon' => 'fa fa-map',
        'theme' => 'skin-red'
    ]; 

    public function index()
    {
        $template = (object) $this->template;
        return view('admin.dashboard.index',compact('template'));
    }
}
