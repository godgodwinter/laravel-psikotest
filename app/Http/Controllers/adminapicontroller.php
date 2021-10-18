<?php

namespace App\Http\Controllers;

use App\Models\inputnilaipsikologi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminapicontroller extends Controller
{
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
        ->first();
        $siswa_nama=$ambildatasiswa->nama;

        $cek=DB::table('inputnilaipsikologi')
        ->where('siswa_id',$siswa)
        ->where('masternilaipsikologi_id',$ambildatamaster->id)
        ->count();
        // dd($request,$cek);
        // jika belum maka insert
        if($cek<1){
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
}
