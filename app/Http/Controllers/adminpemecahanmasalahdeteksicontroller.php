<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\masterdeteksi;
use App\Models\masterdeteksi_pemecahanmasalah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminpemecahanmasalahdeteksicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'  && Auth::user()->tipeuser!='owner'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        $pages='pemecahanmasalahdeteksi';
        $datas = masterdeteksi::orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.pemecahanmasalahdeteksi.index',compact('pages','request','datas'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pemecahanmasalahdeteksi';
        $datas=
        masterdeteksi::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.pemecahanmasalahdeteksi.index',compact('pages','request','datas'));
    }
    public function edit(masterdeteksi $data)
    {
        $pages='pemecahanmasalahdeteksi';

        return view('pages.admin.pemecahanmasalahdeteksi.edit',compact('pages','data'));
    }
    public function update(Request $request,masterdeteksi $data)
    {
        // dd($request);
            masterdeteksi_pemecahanmasalah::updateOrCreate(
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>54.50,
                    'batasatas'=>70.00,],
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>54.50,
                    'batasatas'=>70.00,
                    'keterangan' => $request->ket1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );


            masterdeteksi_pemecahanmasalah::updateOrCreate(
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>71.00,
                    'batasatas'=>80.00,],
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>71.00,
                    'batasatas'=>80.00,
                    'keterangan' => $request->ket2,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );


            masterdeteksi_pemecahanmasalah::updateOrCreate(
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>81.00,
                    'batasatas'=>99.00,],
                [
                    'masterdeteksi_id'=>$data->id,
                    'batasbawah'=>81.00,
                    'batasatas'=>99.00,
                    'keterangan' => $request->ket3,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

        return redirect()->route('pemecahanmasalahdeteksi')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
}
