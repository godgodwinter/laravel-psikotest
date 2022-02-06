<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class siswacatatanprestasicontroller extends Controller
{
    public function index(Request $request)
    {
        $siswa=siswa::where('users_id',Auth::user()->id)->first();
        $id=sekolah::where('id',$siswa->sekolah_id)->first();
        $data=$siswa;
        $pages = 'catatanprestasisiswa';

        $datas = catatanprestasisiswa::with('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->where('siswa_id', $siswa->id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

            $kelas=kelas::where('sekolah_id',$id->id)->get();
    return view('pages.siswa.catatanprestasisiswa.index', compact('pages', 'id', 'request', 'datas','kelas','data'));
    }

    public function cetak(Request $request){
        $siswa=siswa::where('users_id',Auth::user()->id)->first();
        $data=$siswa;
        $id=sekolah::where('id',$siswa->sekolah_id)->first();
        $datas=catatanprestasisiswa::with('siswa')->where('siswa_id',$siswa->id)->orderBy('tanggal','desc')->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.sekolah.pages.catatanprestasi.cetakpersiswa',compact('datas'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }
}
