<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class admininputnilaipsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request,sekolah $id)
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

                $kelas=kelas::where('sekolah_id',$id->id)->get();

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
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian','kelas','kelaspertama'));
    }
    public function cari(Request $request,sekolah $id)
    {
        $pages='inputnilaipsikologi';

        $kelaspertama=kelas::where('sekolah_id',$id->id)->where('id',$request->kelas_id)->first();
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

                $kelas=kelas::where('sekolah_id',$id->id)->get();

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
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian','kelas','kelaspertama'));
    }
}
