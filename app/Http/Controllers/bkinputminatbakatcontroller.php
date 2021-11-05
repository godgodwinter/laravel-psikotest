<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class bkinputminatbakatcontroller extends Controller
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
        $pages='bk-inputminatbakat';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->first();
        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        $datas=DB::table('siswa')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=minatbakat::where('kategori','Minat dan Bakat')
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

        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();
        // dd($collectionpenilaian);
        return view('pages.bk.inputminatbakat.index',compact('pages','request','datas','id','collectionpenilaian','master','kelas','kelaspertama'));
    }
    public function cari(Request $request,sekolah $id)
    {
        // dd('cari',$request);
        $pages='inputminatbakat';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;

        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)->where('id',$request->kelas_id)->first();
        $kelas_id=$kelaspertama->id;
        $datas=DB::table('siswa')
        ->where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        ->get();

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=minatbakat::where('kategori','Minat dan Bakat')
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

        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();
        // dd($collectionpenilaian);
        return view('pages.bk.inputminatbakat.index',compact('pages','request','datas','id','collectionpenilaian','master','kelas','kelaspertama'));
    }
    public function edit(Request $request, siswa $siswa){
        // dd('edit');
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        //$id=DB::table('siswa')->where('id',$siswa->siswa_id)->first();

        $data=siswa::where('sekolah_id',$sekolah_id)->where('nomerinduk',$siswa->nomerinduk)->first();

        $master=minatbakat::where('kategori','Minat dan Bakat')->where('menukhusus','bk')
        ->orderBy('id','asc')
        ->get();
        // dd($data,$siswa);
        $pages='bk-inputminatbakat';
        return view('pages.bk.inputminatbakat.edit',compact('pages','request','siswa','sekolah_id','data','master'));

    }
    public function update(Request $request, siswa $siswa){

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        //$id=DB::table('siswa')->where('id',$siswa->id)->first();

        $master=minatbakat::where('kategori','Minat dan Bakat')->where('menukhusus','bk')
        ->orderBy('id','asc')
        ->get();

        // dd($request['1']);
        foreach($master as $m){
            if($request[$m->id]!=null){
                $periksadetail=minatbakatdetail::where('minatbakat_id',$m->id)
                ->where('sekolah_id',$sekolah_id)
                ->where('siswa_id',$siswa->id)
                ->count();

                if($periksadetail>0){

                    minatbakatdetail::where('minatbakat_id',$m->id)
                    ->where('sekolah_id',$sekolah_id)
                    ->where('siswa_id',$siswa->id)
                    ->update([
                        'nilai'     =>   $request[$m->id],
                       'updated_at'=>date("Y-m-d H:i:s")
                    ]);

                }else{
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
        return redirect()->route('bk.inputminatbakat',$m->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');

    }
}
