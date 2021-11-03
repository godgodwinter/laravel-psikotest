<?php

namespace App\Http\Controllers;

use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class bkcetakcontroller extends Controller
{
    public function nilaipsikologi (Request $request){

        $cetakdatamaster=$request->cetakdatamaster;
        $alldatas=explode(',',$cetakdatamaster);
        $masters='';
        // dd($master);
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
            $masters = new Collection();

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

                    // average
                    $periksadataavg=DB::table('inputnilaipsikologi')
                        ->where('sekolah_id',$sekolah_id)
                        ->where('masternilaipsikologi_id',$m->id)
                        ->avg('nilai');

                        //min
                    $periksadatamin=DB::table('inputnilaipsikologi')
                    ->where('sekolah_id',$sekolah_id)
                    ->where('masternilaipsikologi_id',$m->id)
                    ->min('nilai');

                     //max
                    $periksadatamax=DB::table('inputnilaipsikologi')
                    ->where('sekolah_id',$sekolah_id)
                    ->where('masternilaipsikologi_id',$m->id)
                    ->max('nilai');


                     //frekuensi

        $collectionfrekuensi = new Collection();
                    //  1.ambilnilaiuniq
                     $nilai_uniq=DB::table('inputnilaipsikologi')
                     ->where('sekolah_id',$sekolah_id)
                     ->where('masternilaipsikologi_id',$m->id)
                     ->get()->unique('nilai');
                    //  2.  periksajmldatanilaiuiq
                    foreach($nilai_uniq as $data){
                        $ambiljmldata=DB::table('inputnilaipsikologi')
                        ->where('sekolah_id',$sekolah_id)
                        ->where('masternilaipsikologi_id',$m->id)
                        ->where('nilai',$data->nilai)
                        ->count();
                        // dd($data->nilai,$ambiljmldata);

                $collectionfrekuensi->push((object)[
                    'nilai'=>$data->nilai,
                    'jmldata'=>$ambiljmldata,
                ]);
                    }

                    // dd($collectionfrekuensi->max('jmldata'));

                    $frekuensi=$collectionfrekuensi->where('jmldata',$collectionfrekuensi->max('jmldata'));

                    //  3.  masukkan kedalamcollection where nilai=jumlahdata
                    //  4.  ambil jmldata terbanyak

                    // dd($nilai_uniq);
                    }

                }

                $masters->push((object)[
                    'nama'=>$masterwhere,
                    'avg'=>$periksadataavg,
                    'min'=>$periksadatamin,
                    'max'=>$periksadatamax,
                    'frekuensi'=>$frekuensi->first()->nilai,
                ]);

            }



            $collectionpenilaian->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'master'=>$collectionmaster
            ]);
        }
        // dd($request->cetakdatamaster,$collectionpenilaian);
        $datas=$collectionpenilaian;
        // dd($datas);
        // $avg=$datas->where('master',1)->first();
        // var_dump($avg);
        // die($avg);
        // dd($masters);
        // dd($datas->where('master','KB')->count());

        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.bk.cetak.cetaknilaipsikologi',compact('datas','masters'))->setPaper('a4', 'potrait');
        return $pdf->download('nilaipsikologi'.$tgl.'-pdf');
    }
    public function cetakcatatankasussiswa(){
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();



        $datas = catatankasussiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('siswa_id','asc')
        ->get();


        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.bk.cetak.cetakcatatankasussiswa',compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('catatan'.$tgl.'-pdf');
    }
    public function cetakcatatanpengembangandirisiswa(){
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('siswa_id','asc')
        ->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.bk.cetak.cetakcatatanpengembangandirisiswa',compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('catatanpengembangandiri'.$tgl.'-pdf');
    }
    public function cetakcatatanprestasisiswa(){
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        $datas = catatanprestasisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('siswa_id','asc')
        ->get();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.bk.cetakprestasi.cetakcatatanprestasisiswa',compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('catatan'.$tgl.'-pdf');
    }
}
