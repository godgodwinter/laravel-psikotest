<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admindashboardcontroller extends Controller
{
    public function index(){
        if(Auth::user()->tipeuser=='bk'){
            return redirect()->route('bk.beranda');

        }
        $jmlsekolah=sekolah::count();
        $jmlyayasan='0';
        $jmlbk=sekolah::count();
        $pages='dashboard';
        return view('pages.admin.dashboard.index',compact('pages','jmlsekolah','jmlbk','jmlyayasan'));
    }
}
