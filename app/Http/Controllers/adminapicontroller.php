<?php

namespace App\Http\Controllers;

use App\Models\apiprobk_sertifikat;
use App\Models\inputnilaipsikologi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class adminapicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin' && Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }

    public function apiprobk_sertifikat(Request $request,$apiprobk_id){
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_sertifikat::select('*')
        ->where('apiprobk_id',$apiprobk_id)
        ->get();
        if($datas!=null){
            $status=true;
            $msg="Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);

    }
public function apiprobk_sertifikat_isi(Request $request,$apiprobk_id,$kunci){
    $datas=null;
    $status=false;
    $msg="Data gagal di muat!";

    $getdatas=apiprobk_sertifikat::select('*')
    ->where('apiprobk_id',$apiprobk_id)
    ->where('kunci',$kunci)
    ->first();
    if($getdatas!=null){
        $status=true;
        $msg="Ambil data berhasil";
        $datas=$getdatas->isi;
    }

    return response()->json([
        'success' => $status,
        'message' => $msg,
        'data' => $datas,
    ], 200);

}
    public function inputnilaipsikologi (Request $request){
        $output='';
        $datas='';
        $warna='';
        $first='';
        $cek='';
        $alldatas=$request->ids;
        // $output.=$request->nilai.$request->nis.$request->dm;
        // dd($request);
        $nilai=0;
        $nilai=$request->nilai;
        $siswa=$request->siswa;
        $master=$request->master;

        $ambildatamaster=DB::table('masternilaipsikologi')
        ->where('id',$master)
        ->first();


        $ambildatasiswa=DB::table('siswa')
        ->where('id',$siswa)
        // ->where('sekolah_id',$id->id)
        // ->orderBy('nama','asc')
        ->first();
        $ceksiswa=DB::table('siswa')
        ->where('id',$siswa)
        // ->where('sekolah_id',$id->id)
        // ->orderBy('nama','asc')
        ->count();
        $siswa_nama=$ambildatasiswa?$ambildatasiswa->nama:'Data tidak ditemukan';

        if($ceksiswa>0){
        $cek=DB::table('inputnilaipsikologi')
        ->where('siswa_id',$siswa)
        ->where('masternilaipsikologi_id',$ambildatamaster->id)
        ->count();
        // dd($request,$cek);
        // jika belum maka insert
        if($cek>0){
            DB::table('inputnilaipsikologi')->insert(
             array(
                    'siswa_id'     =>   $siswa,
                    'masternilaipsikologi_id'     =>   $ambildatamaster->id,
                    'nilai'     =>   $nilai,
                    'sekolah_id'     =>   $ambildatasiswa->sekolah_id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
             ));

        }else{
            // jika sudah maka update

            inputnilaipsikologi::where('siswa_id',$ambildatasiswa->id)
            ->where('masternilaipsikologi_id',$ambildatamaster->id)
                ->update([
                    'nilai'     =>   $nilai,
                ]);

        }
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'output' => 'berhasildi upadate',
            // 'status' => $data->status,
            'warna' => $warna,
            'datas' => $cek,
            'first' => $first
        ], 200);


    }


    public function inputnilaipsikologibk (Request $request){
        $output='';
        $datas='';
        $warna='';
        $first='';
        $cek='';
        $alldatas=$request->ids;

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
$nomer=0;
        foreach($collectionpenilaian as $data){
        $nomer++;
            $output.='<tr>
            <td class="text-center">'.$nomer.'</td>
            <td>'.$data->nama.'</td>';
            foreach($data->master as $m){
                $output.='
                <td class="text-center">'.$m->nilai.'</td>';
            }
            $output.='
            </tr>';
        }
        return response()->json([
            'success' => true,
            'message' => 'success',
            'output' => 'berhasildi upadate',
            // 'status' => $data->status,
            'warna' => $alldatas,
            'datas' => $output,
            'first' => $alldatas
        ], 200);


    }


    public function updatestatusskolah(Request $request,sekolah $id){
        $output='';
        $datas='';
        $warna='';
        $first='';
        $cek='';

        $ambildata=sekolah::where('id',$id->id)->first();
        $status=$ambildata->status;

        if($status=='Aktif'){
            $statusbaru='Nonaktif';
            $warna='btn btn-danger';
        }else{
            $statusbaru='Aktif';
            $warna='btn btn-success';
        }

        sekolah::where('id',$id->id)
        ->update([
             'status'     =>   $statusbaru,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);




        return response()->json([
            'success' => true,
            'message' => 'success',
            'output' => $statusbaru,
            // 'status' => $data->status,
            'warna' => $warna,
            'datas' => $id,
            'first' => $output
        ], 200);


    }
}
