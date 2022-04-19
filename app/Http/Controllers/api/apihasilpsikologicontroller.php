<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\masterdeteksi;
use App\Models\masterdeteksi_pemecahanmasalah;
use App\Models\penjelasan_faktorkepribadian;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use PDF;

class apihasilpsikologicontroller extends Controller
{
    public function sertifikat_lihatapi(sekolah $id, siswa $siswa, Request $request)
    {
        $datas = null;
        $status = false;
        $msg = "Data gagal di muat!";

        $datas = apiprobk_sertifikat::where('apiprobk_id', $siswa->apiprobk_id)->get();
        if ($datas != null) {
            $status = true;
            $msg = "Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);
    }


    public function deteksi_lihat_api(siswa $siswa, Request $request)
    {
        // dd($siswa);
        $datas = null;
        $status = false;
        $msg = "Data gagal di muat!";

        $datas = apiprobk_deteksi_list::where('apiprobk_id', $siswa->apiprobk_id)
            ->where('nama', $request->nama)
            ->first();
        if ($datas != null) {
            $status = true;
            $msg = "Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);
    }

    public function penjelasan_faktorkepribadian_api(Request $request)
    {
        // dd($siswa);
        $datas = null;
        $status = false;
        $msg = "Data gagal di muat!";
        // $list=penjelasan_faktorkepribadian::query();
        // $list->where('namakarakter','like',"%".$request->namakarakter."%");
        // $list->whereRaw('namakarakter', 'LIKE', '% ' . strtolower($request->namakarakter) . '%');
        $datas = penjelasan_faktorkepribadian::where('namakarakter', 'like', "" . $request->namakarakter . "")
            // $datas=penjelasan_faktorkepribadian::where('namakarakter',$request->namakarakter)
            ->orderBy('created_at', 'desc')
            ->first();
        // $list->first();
        if ($datas != null) {
            $status = true;
            $msg = "Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas
        ], 200);
    }

    public function deteksi_lihat_api_pemecahanmasalah(Request $request)
    {
        // dd($siswa);
        $datas = null;
        $status = false;
        $msg = "Data gagal di muat!";

        $datas = masterdeteksi_pemecahanmasalah::where('batasatas', $request->batasatas)
            ->where('batasbawah', $request->batasbawah)
            ->where('masterdeteksi_id', $request->id)
            ->first();
        if ($datas != null) {
            $status = true;
            $msg = "Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas ? $datas->keterangan : null,
        ], 200);
    }

    public function cetakPenangananDeteksiMasalah(Request $request)
    {

        // dd($request, $request->data[0]);
        $tgl = date("YmdHis");
        $data = $request->data;
        $siswa = $request->siswa;
        $totalData = $request->totalData;

        $pdf = PDF::loadview('pages.admin.cetak.cetakpenanganandeteksimasalah', compact('tgl', 'siswa', 'data', 'totalData'))->setPaper('a4', 'potrait');
        return $pdf->stream('penanganandeteksimasalah' . $tgl . '-pdf');
        dd($request, $request->data[0]);
        // dd($request);
    }
    public function cetakPenjelasanFaktorKepribadian(Request $request)
    {

        // // dd($request, $request->data[0]);
        // $tgl = date("YmdHis");
        // $data = $request->data;
        // $siswa = $request->siswa;
        // $totalData = $request->totalData;

        // $pdf = PDF::loadview('pages.admin.cetak.cetakpenanganandeteksimasalah', compact('tgl', 'siswa', 'data', 'totalData'))->setPaper('a4', 'potrait');
        // return $pdf->stream('penanganandeteksimasalah' . $tgl . '-pdf');
        // dd($request, $request->data[0]);
        // dd($request, json_decode($request->data[0]['detailData']));
        dd($request);
    }
}
