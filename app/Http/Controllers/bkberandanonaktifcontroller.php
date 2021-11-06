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


        return view('pages.bk.beranda.non',compact('pages','request'));
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
