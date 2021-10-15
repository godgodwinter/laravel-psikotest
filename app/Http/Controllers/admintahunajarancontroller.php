<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use Illuminate\Http\Request;

class admintahunajarancontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='sekolah';

        return view('pages.admin.sekolah.pages.tahun_index',compact('pages','id','request'));
    }
    public function create(sekolah $id)
    {
        $pages='sekolah';

        return view('pages.admin.sekolah.pages.tahun_create',compact('pages','id'));
    }
}
