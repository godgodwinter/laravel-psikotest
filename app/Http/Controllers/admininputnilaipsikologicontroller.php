<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class admininputnilaipsikologicontroller extends Controller
{
    public function index(Request $request,sekolah $id)
    {
        $pages='inputnilaipsikologi';
        $datas=DB::table('siswa')
        ->skip(0)->take(2)
        ->where('sekolah_id',$id->id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();

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
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian'));
    }
}
