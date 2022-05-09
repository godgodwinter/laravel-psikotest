<?php

namespace App\Http\Controllers;

use App\Models\apiprobk_sertifikat;
use App\Models\kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkinputnilaipsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        $pages='bk-inputnilaipsikologi';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;

        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->orderBy('nama', 'asc')->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        // ->select('id','apiprobk_id')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        // ->paginate(3);
        // ->paginate(Fungsi::paginationjml());
        ->get();
        // dd($datas);
        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();
        $kelas=kelas::where('sekolah_id',$sekolah_id)->orderBy('nama', 'asc')->get();
        // dd($datas);
        return view('pages.bk.inputnilaipsikologi.index',compact('pages','request','datas','kelas','kelaspertama','master'));
    }
    public function cari(Request $request)
    {
        $pages='bk-inputnilaipsikologi';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;

        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->where('id',$request->kelas_id)->orderBy('nama', 'asc')->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        // ->select('id','apiprobk_id')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        // ->paginate(3);
        // ->paginate(Fungsi::paginationjml());
        ->get();
        // dd($datas);

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();
        $kelas=kelas::where('sekolah_id',$sekolah_id)->orderBy('nama', 'asc')->get();
        // dd($collectionpenilaian);
        return view('pages.bk.inputnilaipsikologi.index',compact('pages','request','datas','kelas','kelaspertama','master'));
    }
}
