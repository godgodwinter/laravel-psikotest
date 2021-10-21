<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkgrafikcontroller extends Controller
{
    public function nilaipsikologi (Request $request){

        $cetakdatamaster=$request->cetakdatamaster;
        $alldatas=explode(',',$cetakdatamaster);
        // dd($alldatas);
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

        $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->where('singkatan',$alldatas)
        ->orderBy('id','asc')
        ->get();

        $collectionpenilaian = new Collection();

        foreach($datas as $d){

            $collectionmaster = new Collection();

            foreach($alldatas as $masterwhere){
                if(($masterwhere!='')AND($masterwhere!=null)){
                    $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')
                    ->where('singkatan',$masterwhere)
                    ->skip(0)->take(1)
                    ->orderBy('id','asc')
                    ->get();
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

                }


            }



            $collectionpenilaian->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'master'=>$collectionmaster
            ]);
        }
        dd($request->cetakdatamaster,$collectionpenilaian);

        $tgl=date("YmdHis");
        $datas=DB::table('peminjaman')->where('kodetrans')->first();
            $datapinjamdetail=DB::table('peminjamandetail')->where('kodetrans')->orderBy('created_at', 'desc')->get();

            $detaildatas = $datapinjamdetail->unique('buku_kode');
        $pdf = PDF::loadview('admin.cetak.peminjamanshow',compact('datas','detaildatas'))->setPaper('a4', 'potrait');
        return $pdf->download('laporansekolah_'.$tgl.'-pdf');
    }
}
