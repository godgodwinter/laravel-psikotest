<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\hasilpsikologi;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminhasilpsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(sekolah $id,Request $request)
    {
        $pages='hasilpsikologi';
        // $datas=DB::table('kelas')->whereNull('deleted_at')
        // ->where('sekolah_id',$id->id)
        // // ->with('walikelas','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = hasilpsikologi::with('siswa')
        ->where('sekolah_id',$id->id)
        ->orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.sekolah.pages.hasilpsikologi.index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='kelas';
        $siswa=siswa::where('sekolah_id',$id->id)->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();
        // dd($siswa);

        return view('pages.admin.sekolah.pages.hasilpsikologi.create',compact('pages','id','siswa'));
    }

}
