<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkberandacontroller extends Controller
{
    public function index(Request $request)
    {
        $pages='bk-beranda';
        $datas=DB::table('tahun')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        return view('pages.bk.beranda.index',compact('pages','id','request','datas'));
    }

    public function referensi(Request $request)
    {
        $pages='bk-referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.referensi.index',compact('pages','request','datas'));
    }
    public function cari_ref(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk_referensi';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = DB::table('referensi')

            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.referensi.index',compact('pages','request','datas'));
        }
    public function informasipsikologi(Request $request)
    {
        $pages='bk-informasipsikologi';
        $datas = DB::table('informasipsikologi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.informasipsikologi.index',compact('pages','request','datas'));
    }
    public function cari_infp(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk_informasipsikologi';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = DB::table('referensi')

            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.informasipsikologi.index',compact('pages','request','datas'));
        }

}
