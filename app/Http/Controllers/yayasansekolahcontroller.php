<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class yayasansekolahcontroller extends Controller
{
    protected $datayayasan;
    protected $cari;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='yayasan'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });

        $this->datayayasan=yayasan::where('users_id','3')->first();

    }
    public function index(Request $request)
    {
        $pages='sekolah';
        // dd($this->datayayasan);
        if($this->datayayasan!=null){

            $datas = yayasandetail::with('sekolah')
            ->where('yayasan_id',$this->datayayasan->id)
            ->orderBy('id','asc')
            ->paginate(Fungsi::paginationjml());

        }else{
            $datas = yayasandetail::with('sekolah')
            ->where('yayasan_id','0')
            ->orderBy('id','asc')
            ->paginate(Fungsi::paginationjml());
        }

        return view('pages.yayasan.sekolah.index',compact('pages','request','datas'));
    }

    public function cari(Request $request)
    {

        $this->cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas = yayasandetail::with('sekolah')
        ->where('sekolah_id',function($query){
            $query->select('id')->from('sekolah')
            ->where('nama','like',"%".$this->cari."%");
        })
        ->where('yayasan_id',$this->datayayasan->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.index',compact('pages','request','datas'));
    }

    public function detail(sekolah $sekolah,Request $request)
    {
        $pages='sekolah';

        return view('pages.yayasan.sekolah.detail',compact('pages','request','sekolah'));
    }

    public function siswa(sekolah $sekolah,Request $request)
    {
        $pages='sekolah';
        $datas=siswa::where('sekolah_id',$sekolah->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.siswa.index',compact('pages','request','sekolah','datas'));
    }
    public function siswacari(sekolah $sekolah,Request $request)
    {

        $this->cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas = siswa::
        where('sekolah_id',$sekolah->id)
        ->where('nama','like',"%".$this->cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.siswa.index',compact('pages','request','sekolah','datas'));
    }
}
