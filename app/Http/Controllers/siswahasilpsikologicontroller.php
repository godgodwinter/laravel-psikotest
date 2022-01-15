<?php

namespace App\Http\Controllers;

use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\masterdeteksi;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class siswahasilpsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='siswa'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });


    }
    public function deteksi_lihat(Request $request)
    {
        $siswa=siswa::where('users_id',Auth::user()->id)->first();
        $id=sekolah::where('id',$siswa->sekolah_id)->first();
        // dd($siswa,$id);
        $getdatadeteksi=apiprobk_deteksi::where('apiprobk_id',$siswa->apiprobk_id)->get();
        foreach($getdatadeteksi as $item){
            $datas[$item->kunci]=$item->isi;
        }
        $deteksi_list=apiprobk_deteksi_list::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='deteksi';
            $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
            $masterdeteksi=masterdeteksi::get();
        return view('pages.siswa.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
    }
    public function deteksi_cetak(Request $request)
    {
        dd('cetak deteksi');
    }
    public function sertifikat_lihat(Request $request)
    {
        $siswa=siswa::where('users_id',Auth::user()->id)->first();
        $id=sekolah::where('id',$siswa->sekolah_id)->first();
        $getdatasertifikat=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='sertifikat';
        $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
        return view('pages.siswa.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','datasiswa'));
    }
    public function sertifikat_lihatapi(Request $request)
    {
        $siswa=siswa::where('users_id',Auth::user()->id)->first();
        $id=sekolah::where('id',$siswa->sekolah_id)->first();
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        if($datas!=null){
            $status=true;
            $msg="Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);

    }
    public function sertifikat_cetak(Request $request)
    {
        dd('cetak Sertifikat');
    }
}
