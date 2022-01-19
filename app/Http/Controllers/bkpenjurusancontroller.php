<?php

namespace App\Http\Controllers;

use App\Models\apiprobk_sertifikat;
use App\Models\kelas;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class bkpenjurusancontroller extends Controller
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
        $pages='bk-penjurusan';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }

        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();

        $datas=DB::table('siswa')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        ->get();


        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();
        return view('pages.bk.inputpenjurusan.index',compact('pages','request','datas','master','kelaspertama','kelas'));
    }
    public function cari(Request $request)
    {
        $pages='bk-penjurusan';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->where('id',$request->kelas_id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }

        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();

        $datas=DB::table('siswa')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        ->get();


        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();
        return view('pages.bk.inputpenjurusan.index',compact('pages','request','datas','master','kelaspertama','kelas'));
    }

    public function edit(Request $request,$siswa){
        // dd('edit');
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $data=siswa::where('sekolah_id',$sekolah_id)->where('id',$siswa)->first();

        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();
        // dd($data,$siswa);
        $pages='bk-penjurusan';
        return view('pages.bk.inputpenjurusan.edit',compact('pages','request','siswa','data','master'));

    }
    public function update(Request $request,siswa $siswa){
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $master=minatbakat::where('kategori','Bakat dan Penjurusan')
        ->orderBy('id','asc')
        ->get();

        foreach($master as $m){
            // dd($request,$request[$m->id]);
            if($request[$m->id]!=null){
                $periksadetail=minatbakatdetail::where('minatbakat_id',$m->id)
                ->where('sekolah_id',$sekolah_id)
                ->where('siswa_id',$siswa->id)
                ->count();

                if($periksadetail>0){
// dd('update');
                    minatbakatdetail::where('minatbakat_id',$m->id)
                    ->where('sekolah_id',$sekolah_id)
                    ->where('siswa_id',$siswa->id)
                    ->update([
                        'nilai'     =>   $request[$m->id],
                       'updated_at'=>date("Y-m-d H:i:s")
                    ]);

                }else{
                    // dd('tes');
                    DB::table('minatbakatdetail')->insert(
                        array(
                               'siswa_id'     =>   $siswa->id,
                               'minatbakat_id'     =>   $m->id,
                               'nilai'     =>   $request[$m->id],
                               'sekolah_id'     =>   $sekolah_id,
                               'created_at'=>date("Y-m-d H:i:s"),
                               'updated_at'=>date("Y-m-d H:i:s")
                        ));

                }

            }
            // dd($request[$m->id]);
        }
        // dd($request);
        return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');

}

public function cetakpersiswa(sekolah $id,siswa $siswa,Request $request){

    // dd($siswa);
    $users_id=Auth::user()->id;
    $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
    $sekolah_id=$pengguna->sekolah_id;
    $periksadetail=minatbakatdetail::
    where('sekolah_id',$sekolah_id)
    ->where('siswa_id',$siswa->id)
    ->count();
    // dd($periksadetail,$id,$siswa);
    if($periksadetail<1){
        return redirect()->back()->with('status','Data tidak ditemukan atau belum diisi!')->with('tipe','error')->with('icon','fas fa-feather');
    }


    $master=minatbakat::where('kategori','Bakat dan Penjurusan')
    ->orderBy('id','asc')
    ->get();

        $collectionpenilaian = new Collection();



        $collectionmaster = new Collection();
    $arr=[
        'id'=>$siswa->id,
        'nomerinduk'=>$siswa->nomerinduk,
        'nama'=>$siswa->nama,
    ];
    $nomer=1;
        foreach($master as $m){


            $periksadata=DB::table('minatbakatdetail')
            ->where('siswa_id',$siswa->id)
            // ->where('id','2')
            ->where('minatbakat_id',$m->id)
            ->get();

            if($periksadata->count()>0){
                $ambildata=$periksadata->first();
                $nilai=$periksadata->first()->nilai;
            }else{
                $nilai=null;
            }
            $arr2= ['nilai'.$nomer => $nilai];
            // $arr2= [$m->nama => $nilai];
            $arr=array_merge($arr,$arr2);
            $nomer++;
// dd($arr);
        // $collectionmaster->push((object)$arr);

        }

        $collectionpenilaian->push((object)$arr);

        $datas=$collectionpenilaian[0];
    // dd($collectionpenilaian[0]->nama,$datas);

    // $datas=$data;
    $tgl=date("YmdHis");
    $pdf = PDF::loadview('pages.bk.inputpenjurusan.cetakpersiswa',compact('datas'))->setPaper('a4', 'potrait');
    return $pdf->stream('minatbakat'.$tgl.'.pdf');
}
}
