<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\penjelasan_faktorkepribadian;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;

class apihasilpsikologicontroller extends Controller
{
    public function sertifikat_lihatapi(sekolah $id,siswa $siswa,Request $request)
    {
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
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


    public function deteksi_lihat_api (siswa $siswa,Request $request)
    {
        // dd($siswa);
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_deteksi_list::where('apiprobk_id',$siswa->apiprobk_id)
        ->where('nama',$request->nama)
        ->first();
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

    public function penjelasan_faktorkepribadian_api (Request $request)
    {
        // dd($siswa);
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=penjelasan_faktorkepribadian::where('namakarakter',$request->namakarakter)
        ->first();
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

}
