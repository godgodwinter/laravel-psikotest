<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\klasifikasijabatan;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class bkklasifikasijabatancontroller extends Controller
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
        $pages='bk-klasifikasijabatan';
        $datas = klasifikasijabatan::orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.klasifikasijabatan.index',compact('pages','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='bk-klasifikasijabatan';

        return view('pages.bk.klasifikasijabatan.create',compact('pages'));
    }

    public function store(Request $request)
    {
        // dd('tambah');
        $request->validate([
            'bidang'=>'required',
            'pekerjaan'=>'required',
        ],
        [
            'bidang.required'=>'Bidang Harus diisi',

        ]);

        DB::table('klasifikasijabatan')->insert(
            array(
                   'bidang'     =>   $request->bidang,
                   'akademis'     =>   $request->akademis,
                   'pekerjaan'     =>   $request->pekerjaan,
                   'nilaistandart'     =>   $request->nilaistandart,
                   'iqstandart'     =>   $request->iqstandart,
                   'jurusan'     =>   $request->jurusan,
                   'bidangstudi'     =>   $request->bidangstudi,
                   'ket'     =>   $request->ket,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            return redirect()->route('klasifikasijabatan')->with('status','Data berhasil di tambahkan!')->with('tipe','success');

     }

    public function edit(klasifikasijabatan $data)
    {
        $pages='bk-klasifikasijabatan';

        return view('pages.bk.klasifikasijabatan.edit',compact('pages','data'));
    }
    public function update(klasifikasijabatan $data,Request $request)
    {
        // dd('update');
            $request->validate([
                'bidang'=>'required',
                'pekerjaan'=>'required',
            ],
            [
                'bidang.required'=>'bidang Harus diisi',

            ]);



        klasifikasijabatan::where('id',$data->id)
        ->update([
            'bidang'     =>   $request->bidang,
            'akademis'     =>   $request->akademis,
            'pekerjaan'     =>   $request->pekerjaan,
            'nilaistandart'     =>   $request->nilaistandart,
            'iqstandart'     =>   $request->iqstandart,
            'jurusan'     =>   $request->jurusan,
            'bidangstudi'     =>   $request->bidangstudi,
            'ket'     =>   $request->ket,
            'updated_at'=>date("Y-m-d H:i:s")
        ]);


    return redirect()->route('klasifikasijabatan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(klasifikasijabatan $data){

        klasifikasijabatan::destroy($data->id);
        return redirect()->route('klasifikasijabatan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        klasifikasijabatan::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='bk-klasifikasijabatan';
        $datas = klasifikasijabatan::orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.klasifikasijabatan.index',compact('pages','request','datas'));
    }
    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='bk-klasifikasijabatan';
        $datas=klasifikasijabatan::where('bidang','like',"%".$cari."%")
        ->orwhere('pekerjaan','like',"%".$cari."%")
        ->orwhere('nilaistandart','like',"%".$cari."%")
        ->orwhere('iqstandart','like',"%".$cari."%")
        ->orwhere('jurusan','like',"%".$cari."%")
        ->orwhere('bidangstudi','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.klasifikasijabatan.index',compact('pages','request','datas'));
    }
}
