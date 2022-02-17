<?php

namespace App\Http\Controllers;

use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class admincetakcontroller extends Controller
{
    protected $cari;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin' && Auth::user()->tipeuser!='bk' && Auth::user()->tipeuser!='yayasan' && Auth::user()->tipeuser!='siswa'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function catatankasus(sekolah $id,siswa $data,Request $request){
        $datas=catatankasussiswa::with('siswa')->where('siswa_id',$data->id)->orderBy('tanggal','desc')->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.sekolah.pages.catatankasus.cetakpersiswa',compact('datas','data'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }

    public function catatanpengembangandiri(sekolah $id,siswa $data,Request $request){
        $datas=catatanpengembangandirisiswa::with('siswa')->where('siswa_id',$data->id)->orderBy('tanggal','desc')->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.sekolah.pages.catatanpengembangandiri.cetakpersiswa',compact('datas','data'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }

    public function catatanprestasi(sekolah $id,siswa $data,Request $request){
        $datas=catatanprestasisiswa::with('siswa')->where('siswa_id',$data->id)->orderBy('tanggal','desc')->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.sekolah.pages.catatanprestasi.cetakpersiswa',compact('datas','data'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }
}
