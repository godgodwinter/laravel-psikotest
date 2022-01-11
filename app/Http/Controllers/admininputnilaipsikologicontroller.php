<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
use App\Models\apiprobk_sertifikat;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class admininputnilaipsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin' ){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request,sekolah $id)
    {
        $pages='inputnilaipsikologi';

        $kelaspertama=kelas::where('sekolah_id',$id->id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        // ->select('id','apiprobk_id')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        // ->paginate(3);
        // ->paginate(Fungsi::paginationjml());
        ->get();
        // dd($datas);
        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($datas);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','kelas','kelaspertama','master'));
    }
    public function cari(Request $request,sekolah $id)
    {
        $pages='inputnilaipsikologi';

        $kelaspertama=kelas::where('sekolah_id',$id->id)->where('id',$request->kelas_id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        // ->select('id','apiprobk_id')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        // ->paginate(3);
        // ->paginate(Fungsi::paginationjml());
        ->get();
        // dd($datas);

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','kelas','kelaspertama','master'));
    }
}
