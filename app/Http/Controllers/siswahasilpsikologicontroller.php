<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\klasifikasijabatan;
use App\Models\masterdeteksi;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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
        // return view('pages.siswa.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
        return view('pages.admin.sekolah.pages.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
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
        // return view('pages.siswa.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','datasiswa'));
        return view('pages.admin.sekolah.pages.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','datasiswa'));
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
    public function klasifikasijabatan(Request $request)
    {
        $pages='siswa-klasifikasijabatan';
        $datas = klasifikasijabatan::orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.siswa.klasifikasijabatan.index',compact('pages','request','datas'));
    }
    public function klasifikasijabatancari(Request $request)
    {
        // if($this->checkauth('admin')==='404'){
        //     return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        // }

        $cari=$request->cari;
        #WAJIB
        $pages='siswa-klasifikasijabatan';
        $datas=klasifikasijabatan::where('bidang','like',"%".$cari."%")
        ->orwhere('pekerjaan','like',"%".$cari."%")
        ->orwhere('nilaistandart','like',"%".$cari."%")
        ->orwhere('iqstandart','like',"%".$cari."%")
        ->orwhere('jurusan','like',"%".$cari."%")
        ->orwhere('bidangstudi','like',"%".$cari."%")
        ->orwhere('ket','like',"%".$cari."%")
        ->orwhere('akademis','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.siswa.klasifikasijabatan.index',compact('pages','request','datas'));
    }
    public function klasifikasijabatandetail(klasifikasijabatan $data)
    {
        $pages='klasifikasijabatan';

        return view('pages.admin.klasifikasijabatan.detail',compact('pages','data'));
    }
    public function referensi(Request $request)
    {
        $pages='siswa-referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.siswa.referensi.index',compact('pages','request','datas'));
    }
    public function referensicari(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='yayasan_referensi';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = DB::table('referensi')

            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.siswa.referensi.index',compact('pages','request','datas'));
        }
        public function informasipsikologi(Request $request)
        {
            $pages='siswa-informasipsikologi';
            $datas = DB::table('informasipsikologi')
            ->whereNull('deleted_at')
            ->orderBy('nama','asc')
            ->paginate(Fungsi::paginationjml());

            return view('pages.siswa.informasipsikologi.index',compact('pages','request','datas'));
        }
        public function informasipsikologicari(Request $request)
            {
                $cari=$request->cari;
                #WAJIB
                $pages='yayasan_informasipsikologi';
                $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

                $datas = DB::table('referensi')

                ->where('nama','like',"%".$cari."%")
                ->paginate(Fungsi::paginationjml());

                return view('pages.siswa.informasipsikologi.index',compact('pages','request','datas'));
            }
}
