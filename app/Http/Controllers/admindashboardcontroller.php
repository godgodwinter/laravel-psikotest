<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admindashboardcontroller extends Controller
{
    public function index(){
        if(Auth::user()->tipeuser=='bk'){
            return redirect()->route('bk.beranda');

        }
        $pages='dashboard';
        return view('pages.admin.dashboard.index',compact('pages'));
    }
}
