<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
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
        $datas=DB::table('siswa')
        // ->where('id','5')
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('id','asc')
        ->get();

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('id','asc')
        ->get();

        foreach($datas as $d){
            $datamaster=([]);
            foreach($master as $m){
                $datasiswa=([
                    'id'=>$d->id,
                    'nomerinduk'=>$d->nomerinduk,
                    'nama'=>$d->nama
                ]);
                // dd($m);
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

                        $datamaster[$m->singkatan]=([
                            'nilai'=>$nilai,
                        ]);

                        $datasiswa['masternilai']=$datamaster;

            }

            array_push($dataakhir_array,$datasiswa);
        }
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','dataakhir_array'));
    }
}
