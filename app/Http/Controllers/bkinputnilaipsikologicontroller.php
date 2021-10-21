<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkinputnilaipsikologicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        $pages='bk-inputnilaipsikologi';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        $datas=DB::table('siswa')
        // ->skip(0)->take(2)
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



            $collectionpenilaian->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'master'=>[]
            ]);
        }
        // dd($collectionpenilaian);
        return view('pages.bk.inputnilaipsikologi.index',compact('pages','request','datas','id','collectionpenilaian'));
    }
}
