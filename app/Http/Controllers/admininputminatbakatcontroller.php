<?php

namespace App\Http\Controllers;

use App\Exports\exportminatbakat;
use App\Models\apiprobk_sertifikat;
use App\Models\kelas;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        $master=minatbakat::where('kategori','Minat dan Bakat')
        ->orderBy('id','asc')
        ->get();

            $collectionpenilaian = new Collection();

        foreach($datas as $d){

            $collectionmaster = new Collection();

            foreach($master as $m){



                $periksadata=apiprobk_sertifikat::where('kunci',$m->nama)
                ->where('apiprobk_id',$d->apiprobk_id)->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->isi;
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

        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputminatbakat.index',compact('pages','request','datas','id','collectionpenilaian','master','kelas','kelaspertama'));
    }
    public function cari(Request $request,sekolah $id)
    {
        // dd('cari',$request);
        $pages='inputminatbakat';
        $kelaspertama=kelas::where('sekolah_id',$id->id)->where('id',$request->kelas_id)->first();
        $kelas_id=$kelaspertama->id;
        $datas=DB::table('siswa')
        ->where('sekolah_id',$id->id)
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


                // $periksadata=DB::table('minatbakatdetail')
                // ->where('siswa_id',$d->id)
                // // ->where('id','2')
                // ->where('minatbakat_id',$m->id)
                // ->get();

                $periksadata=apiprobk_sertifikat::where('kunci',$m->nama)
                ->where('apiprobk_id',$d->apiprobk_id)->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->isi;
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

        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($collectionpenilaian);
        return view('pages.admin.sekolah.pages.inputminatbakat.index',compact('pages','request','datas','id','collectionpenilaian','master','kelas','kelaspertama'));
    }
    public function edit(Request $request,sekolah $id,$siswa){
        // dd('edit');
        $data=siswa::where('sekolah_id',$id->id)->where('id',$siswa)->first();

        $master=minatbakat::where('kategori','Minat dan Bakat')
        ->orderBy('id','asc')
        ->get();
        // dd($data,$siswa);
        $pages='inputminatbakat';
        return view('pages.admin.sekolah.pages.inputminatbakat.edit',compact('pages','request','siswa','id','data','master'));

    }
    public function update(Request $request,sekolah $id,siswa $siswa){
        // dd('edit');
        $master=minatbakat::where('kategori','Minat dan Bakat')
        ->orderBy('id','asc')
        ->get();

        // dd($request['1']);
        foreach($master as $m){
            if($request[$m->id]!=null){
                $periksadetail=minatbakatdetail::where('minatbakat_id',$m->id)
                ->where('sekolah_id',$id->id)
                ->where('siswa_id',$siswa->id)
                ->count();

                if($periksadetail>0){

                    minatbakatdetail::where('minatbakat_id',$m->id)
                    ->where('sekolah_id',$id->id)
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
                               'sekolah_id'     =>   $id->id,
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
    public function export(sekolah $id,Request $request){
        // dd($request);
        $tgl=date("YmdHis");
		return Excel::download(new exportminatbakat($id), 'psikotest-minatbakat-'.$id->id.'-'.$tgl.'.xlsx');
    }

    public function cetakpersiswa(sekolah $id,siswa $siswa,Request $request){

        // dd($siswa);

        $periksadetail=minatbakatdetail::
        where('sekolah_id',$id->id)
        ->where('siswa_id',$siswa->id)
        ->count();
        if($periksadetail<1){
            return redirect()->back()->with('status','Data tidak ditemukan atau belum diisi!')->with('tipe','error')->with('icon','fas fa-feather');
        }


        $master=minatbakat::where('kategori','Minat dan Bakat')
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
                // $arr2= ['nilai'.$m->nama => $nilai];
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
        $pdf = PDF::loadview('pages.admin.sekolah.pages.inputminatbakat.cetakpersiswa',compact('datas'))->setPaper('a4', 'potrait');
        return $pdf->stream('minatbakat'.$tgl.'.pdf');
    }
}
