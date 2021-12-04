<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        ->where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();
        // dd($datas);

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();



            // $collection = new Collection();
            //     $collection->push((object)['prod_id' => '99',
            //                                'desc'=>'xyz',
            //                                'price'=>'99',
            //                                'discount'=>'7.35',

            //     ]);
            // dd($collection);
            $collectionpenilaian = new Collection();

        foreach($datas as $d){

            $collectionmaster = new Collection();

            foreach($master as $m){


                $periksadata=DB::table('inputnilaipsikologi')
                ->where('siswa_id',$d->id)
                // ->where('id','2')
                ->where('masternilaipsikologi_id',$m->id)
                ->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->nilai;
                }else{
                    $nilai=null;
                }


            $collectionmaster->push((object)[
                'id'=>$m->id,
                'singkatan'=>$m->singkatan,
                'nilai'=>$nilai
            ]);

            }

            $collectionpenilaian->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'master'=>$collectionmaster
            ]);
        }

        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.yayasan.sekolah.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian','kelas','kelaspertama'));
    }
    public function inputnilaipsikologicari(sekolah $id,Request $request)
    {

        $this->cari=$request->kelas_id;
        // dd($this->cari,$id);
        $pages='inputnilaipsikologi';

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
        ->where('kelas_id',$this->cari)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();
        // dd($datas);

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();



            // $collection = new Collection();
            //     $collection->push((object)['prod_id' => '99',
            //                                'desc'=>'xyz',
            //                                'price'=>'99',
            //                                'discount'=>'7.35',

            //     ]);
            // dd($collection);
            $collectionpenilaian = new Collection();

        foreach($datas as $d){

            $collectionmaster = new Collection();

            foreach($master as $m){


                $periksadata=DB::table('inputnilaipsikologi')
                ->where('siswa_id',$d->id)
                // ->where('id','2')
                ->where('masternilaipsikologi_id',$m->id)
                ->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->nilai;
                }else{
                    $nilai=null;
                }


            $collectionmaster->push((object)[
                'id'=>$m->id,
                'singkatan'=>$m->singkatan,
                'nilai'=>$nilai
            ]);

            }

            $collectionpenilaian->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'master'=>$collectionmaster
            ]);
        }

        $kelas=kelas::where('sekolah_id',$id->id)->get();

        return view('pages.yayasan.sekolah.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian','kelas','kelaspertama'));

    }
}
