<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bksiswacontroller extends Controller
{

protected $projects;

public function __construct()
{
    $this->middleware(function ($request, $next) {
        if(Auth::user()->tipeuser!='bk'){
            return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
        }
    return $next($request);
    });
}
    public function index(Request $request){
            $pages='bk-siswa';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = siswa::with('kelas')
            ->whereNull('deleted_at')
            ->where('sekolah_id',$id->id)
            ->orderBy('nama','asc')
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.siswa.index',compact('pages','id','request','datas'));
    }
}
