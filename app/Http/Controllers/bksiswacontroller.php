<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bksiswacontroller extends Controller
{

protected $projects;

function __construct() {

    $this->middleware(function ($request, $next) {
        $this->projects = Auth::user()->id;

        return $next($request);
    });
}
    public function index(Request $request){
        $projects = $request->user()->username;

        dd($projects);
    }
}
