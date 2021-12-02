<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkberandanonaktifcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            if((Auth::user()->tipeuser!='bk')){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan')->with('tipe','danger');
            }

        return $next($request);
        });
    }

    public function index(Request $request)
    {
        $pages='bk-beranda';
        $datas=DB::table('tahun')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        return view('pages.bk.beranda.non',compact('pages','id','request','datas'));
    }

    

}
