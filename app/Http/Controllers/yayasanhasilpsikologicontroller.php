<?php

namespace App\Http\Controllers;

use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\masterdeteksi;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class yayasanhasilpsikologicontroller extends Controller
{
    protected $cari;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='yayasan'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function deteksi_lihat(sekolah $id,siswa $siswa,Request $request)
    {
        $getdatadeteksi=apiprobk_deteksi::where('apiprobk_id',$siswa->apiprobk_id)->get();
        foreach($getdatadeteksi as $item){
            $datas[$item->kunci]=$item->isi;
        }
        $deteksi_list=apiprobk_deteksi_list::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='sekolah';
            $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
            $masterdeteksi=masterdeteksi::get();
        return view('pages.admin.sekolah.pages.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
    }
    public function deteksi_cetak(Request $request)
    {
        dd('cetak deteksi',json_decode($request->data),$request);
    }
    public function sertifikat_lihat(sekolah $id,siswa $siswa,Request $request)
    {
        $getdatasertifikat=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='sekolah';
        $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
        return view('pages.admin.sekolah.pages.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','datasiswa'));
    }
}
