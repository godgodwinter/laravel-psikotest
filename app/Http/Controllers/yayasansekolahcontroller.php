<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\hasilpsikologi;
use App\Models\kelas;
use App\Models\klasifikasijabatan;
use App\Models\masterdeteksi;
use App\Models\minatbakat;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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

            $this->datayayasan=yayasan::where('users_id',Auth::user()->id)->first();
        return $next($request);

        });


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

    public function detail(sekolah $id,Request $request)
    {
        $pages='sekolah';

        return view('pages.yayasan.sekolah.detail',compact('pages','request','id'));
    }

    public function siswa(sekolah $id,Request $request)
    {
        $pages='sekolah';
        $datas=siswa::where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.siswa.index',compact('pages','request','id','datas'));
    }
    public function siswacari(sekolah $id,Request $request)
    {

        $this->cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas = siswa::
        where('sekolah_id',$id->id)
        ->where('nama','like',"%".$this->cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.siswa.index',compact('pages','request','id','datas'));
    }

    public function inputnilaipsikologi(Request $request,sekolah $id)
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
        return view('pages.yayasan.sekolah.inputnilaipsikologi.index',compact('pages','request','datas','id','kelas','kelaspertama','master'));
    }
    public function inputnilaipsikologicari(sekolah $id,Request $request)
    {

        // dd($this->cari,$id);
        $pages='inputnilaipsikologi';

        $this->cari=$request->kelas_id;
        $kelaspertama=kelas::where('id',$this->cari)
        ->where('sekolah_id',$id->id)
        ->first();
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
        return view('pages.yayasan.sekolah.inputnilaipsikologi.index',compact('pages','request','datas','id','kelas','kelaspertama','master'));

    }

    public function inputminatbakat(Request $request,sekolah $id)
    {
        $pages='inputminatbakat';
        $kelaspertama=kelas::where('sekolah_id',$id->id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();



        $master=minatbakat::where('kategori','Minat dan Bakat')
        ->orderBy('id','asc')
        ->get();



        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.yayasan.sekolah.inputminatbakat.index',compact('pages','request','datas','id','master','kelas','kelaspertama'));
    }

    public function inputminatbakatcari(Request $request,sekolah $id)
    {
        $pages='inputminatbakat';
        $this->cari=$request->kelas_id;
        $kelaspertama=kelas::where('id',$this->cari)
        ->where('sekolah_id',$id->id)
        ->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();



        $master=minatbakat::where('kategori','Minat dan Bakat')
        ->orderBy('id','asc')
        ->get();



        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.yayasan.sekolah.inputminatbakat.index',compact('pages','request','datas','id','master','kelas','kelaspertama'));
    }
    public function penjurusan(Request $request,sekolah $id)
    {
        $pages='penjurusan';
        $kelaspertama=kelas::where('sekolah_id',$id->id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }

        $kelas=kelas::where('sekolah_id',$id->id)->get();

        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();
        return view('pages.yayasan.sekolah.inputpenjurusan.index',compact('pages','request','datas','id','master','kelaspertama','kelas'));
    }
    public function penjurusancari(Request $request,sekolah $id)
    {
        $pages='penjurusan';
        $this->cari=$request->kelas_id;
        $kelaspertama=kelas::where('id',$this->cari)
        ->where('sekolah_id',$id->id)
        ->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $kelas=kelas::where('sekolah_id',$id->id)->get();

        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();
        return view('pages.yayasan.sekolah.inputpenjurusan.index',compact('pages','request','datas','id','master','kelaspertama','kelas'));
    }

    public function hasilpsikologi(sekolah $id,Request $request)
    {
        $pages='hasilpsikologi';
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        $pages='hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datas=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.hasilpsikologi.index',compact('pages','id','request','datas','kelas','kelaspertama'));
    }


    public function hasilpsikologicari(sekolah $id,Request $request)
    {
        $this->cari=$request->kelas_id;
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        $pages='hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datas=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($datas);

        return view('pages.yayasan.sekolah.hasilpsikologi.index',compact('pages','id','request','datas','kelas','kelaspertama'));
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
        return view('pages.yayasan.sekolah.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
    }
    public function deteksi_cetak(Request $request)
    {
        dd('cetak deteksi');
    }
    public function sertifikat_lihat(sekolah $id,siswa $siswa,Request $request)
    {
        $getdatasertifikat=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='sekolah';
        $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
        return view('pages.yayasan.sekolah.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','datasiswa'));
    }
    public function sertifikat_lihatapi(sekolah $id,siswa $siswa,Request $request)
    {
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
    // public function hasilpsikologi(sekolah $id,Request $request)
    // {
    //     $pages='hasilpsikologi';
    //     // $datas=DB::table('kelas')->whereNull('deleted_at')
    //     // ->where('sekolah_id',$id->id)
    //     // // ->with('walikelas','nama')
    //     // ->orderBy('nama','asc')
    //     // ->paginate(Fungsi::paginationjml());

    //     $datas = hasilpsikologi::with('siswa')
    //     ->where('sekolah_id',$id->id)
    //     ->orderBy('id','asc')
    //     ->paginate(Fungsi::paginationjml());
    //     // dd($datas);

    //     return view('pages.yayasan.sekolah.hasilpsikologi.index',compact('pages','id','request','datas'));
    // }
    public function catatankasus(sekolah $id, Request $request)
    {
        $pages = 'catatankasus';

        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatankasussiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatankasussiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatankasus.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }

    public function catatankasuscari(sekolah $id, Request $request)
    {
        $this->cari=$request->kelas_id;
        $pages = 'catatankasus';

        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatankasussiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatankasussiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatankasus.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }
    public function catatankasusdetail(sekolah $id,siswa $data, Request $request)
    {
        $pages = 'catatankasus';

        $datas = catatankasussiswa::with('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->where('siswa_id', $data->id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

            $kelas=kelas::where('sekolah_id',$id->id)->get();
    return view('pages.yayasan.sekolah.catatankasus.detail', compact('pages', 'id', 'request', 'datas','kelas','data'));
    }


    public function catatanpengembangandiri(sekolah $id, Request $request)
    {
        $pages = 'catatanpengembangandiri';

        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatanpengembangandiri.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }
    public function catatanpengembangandiridetail(sekolah $id,siswa $data, Request $request)
    {
        $pages = 'catatanpengembangandiri';

        $datas = catatanpengembangandirisiswa::with('siswa')
            ->where('siswa_id', $data->id)
            ->orderBy('tanggal', 'asc')
            ->paginate(Fungsi::paginationjml());
            // dd($datas);

        return view('pages.yayasan.sekolah.catatanpengembangandiri.detail', compact('pages', 'id', 'request', 'datas','data'));
    }

    public function catatanpengembangandiricari(sekolah $id, Request $request)
    {
        $pages = 'catatanpengembangandiri';
        $this->cari=$request->kelas_id;
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatanpengembangandiri.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }

    public function catatanprestasi(sekolah $id, Request $request)
    {
        $pages = 'catatanprestasi';

        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatanprestasisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanprestasisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatanprestasi.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }

    public function catatanprestasicari(sekolah $id, Request $request)
    {
        $pages = 'catatanprestasi';
        $this->cari=$request->kelas_id;
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=catatanprestasisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanprestasisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        return view('pages.yayasan.sekolah.catatanprestasi.index', compact('pages', 'id', 'request', 'datas','kelas','kelaspertama'));
    }
    public function catatanprestasidetail(sekolah $id,siswa $data, Request $request)
    {
        $pages = 'catatanprestasi';

        $datas = catatanprestasisiswa::with('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->where('siswa_id', $data->id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

            $kelas=kelas::where('sekolah_id',$id->id)->get();
    return view('pages.yayasan.sekolah.catatanprestasi.detail', compact('pages', 'id', 'request', 'datas','kelas','data'));
    }
    public function klasifikasijabatan(Request $request)
    {
        $pages='yayasan-klasifikasijabatan';
        $datas = klasifikasijabatan::orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.klasifikasijabatan.index',compact('pages','request','datas'));
    }

    public function klasifikasijabatandetail(klasifikasijabatan $data)
    {
        $pages='klasifikasijabatan';

        return view('pages.admin.klasifikasijabatan.detail',compact('pages','data'));
    }
    public function klasifikasijabatancari(Request $request)
    {
        // if($this->checkauth('admin')==='404'){
        //     return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        // }

        $cari=$request->cari;
        #WAJIB
        $pages='yayasan-klasifikasijabatan';
        $datas=klasifikasijabatan::where('bidang','like',"%".$cari."%")
        ->orwhere('pekerjaan','like',"%".$cari."%")
        ->orwhere('nilaistandart','like',"%".$cari."%")
        ->orwhere('iqstandart','like',"%".$cari."%")
        ->orwhere('jurusan','like',"%".$cari."%")
        ->orwhere('bidangstudi','like',"%".$cari."%")
        ->orwhere('ket','like',"%".$cari."%")
        ->orwhere('akademis','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.klasifikasijabatan.index',compact('pages','request','datas'));
    }
    public function referensi(Request $request)
    {
        $pages='yayasan-referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.yayasan.sekolah.referensi.index',compact('pages','request','datas'));
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

            return view('pages.yayasan.sekolah.referensi.index',compact('pages','request','datas'));
        }
        public function informasipsikologi(Request $request)
        {
            $pages='yayasan-informasipsikologi';
            $datas = DB::table('informasipsikologi')
            ->whereNull('deleted_at')
            ->orderBy('nama','asc')
            ->paginate(Fungsi::paginationjml());

            return view('pages.yayasan.sekolah.informasipsikologi.index',compact('pages','request','datas'));
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

                return view('pages.yayasan.sekolah.informasipsikologi.index',compact('pages','request','datas'));
            }
    // public function catatanprestasi(sekolah $id, Request $request)
    // {
    //     $pages = 'catatanprestasi';

    //     $datas = catatanprestasisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
    //         ->where('sekolah_id', $id->id)
    //         ->orderBy('siswa_id', 'asc')
    //         ->paginate(Fungsi::paginationjml());

    //     return view('pages.yayasan.sekolah.catatanprestasi.index', compact('pages', 'id', 'request', 'datas'));
    // }
    // public function catatanprestasicari(sekolah $id, Request $request)
    // {
    //     $pages = 'catatanprestasi';

    //     $datas = catatanprestasisiswa::with('siswa')->with('kelas')
    //         ->where('sekolah_id', $id->id)
    //         ->whereHas('siswa', function ($query) {
    //             global $request;
    //             $query->where('siswa.nama', 'like', "%" . $request->cari . "%");
    //         })
    //         ->orWhereHas('kelas', function ($query) {
    //             global $request;
    //             $query->where('kelas.nama', 'like', "%" . $request->cari . "%");
    //         })
    //         ->where('sekolah_id', $id->id)
    //         ->orWhere('prestasi', 'like', "%" . $request->cari . "%")
    //         ->where('sekolah_id', $id->id)
    //         ->paginate(Fungsi::paginationjml());

    //     return view('pages.yayasan.sekolah.catatanprestasi.index', compact('pages', 'id', 'request', 'datas'));
    // }
}
