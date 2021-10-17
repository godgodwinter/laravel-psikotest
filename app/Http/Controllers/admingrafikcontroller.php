<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admingrafikcontroller extends Controller
{
    public function ex(Request $request){
        $pages='example';
        return view('pages.admin.testing.grafik',compact('pages'));

    }
}
