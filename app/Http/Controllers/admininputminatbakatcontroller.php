<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class admininputminatbakatcontroller extends Controller
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
        $pages='inputminatbakat';
        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=DB::table('minatbakat')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();

            $collectionpenilaian = new Collection();

        foreach($datas as $d){

            $collectionmaster = new Collection();

            foreach($master as $m){


                $periksadata=DB::table('minatbakatdetail')
                ->where('siswa_id',$d->id)
                // ->where('id','2')
                ->where('minatbakat_id',$m->id)
                ->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->nilai;
                }else{
                    $nilai=null;
                }

            $collectionmaster->push((object)[
                'id'=>$m->id,
                'kategori'=>$m->kategori,
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
        return view('pages.admin.sekolah.pages.inputminatbakat.index',compact('pages','request','datas','id','collectionpenilaian'));
    }
}
