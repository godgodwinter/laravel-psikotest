<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminwalikelascontroller extends Controller
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
    public function index(sekolah $id,Request $request)
    {
        $pages='walikelas';
        $datas=DB::table('walikelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.walikelas_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='walikelas';

        return view('pages.admin.sekolah.pages.walikelas_create',compact('pages','id'));
    }

    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('walikelas')->whereNull('deleted_at')->where('nomerinduk',$request->nomerinduk)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    // 'nama'=>'required|unique:walikelas,nama',
                    'nomerinduk'=>'required|unique:walikelas,nomerinduk',

                    ],
                    [
                        'nomerinduk.unique'=>'Nomer Induk sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'nomerinduk'=>'required',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);


        //inser walikelas
        DB::table('walikelas')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'nomerinduk'     =>   $request->nomerinduk,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.walikelas',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id,walikelas $data)
    {
        $pages='walikelas';

        return view('pages.admin.sekolah.pages.walikelas_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,walikelas $data,Request $request)
    {

        if($request->nomerinduk!==$data->nomerinduk){

            $request->validate([
                'nama' => "required",
                'nomerinduk' => "required|unique:walikelas,nomerinduk,".$request->nomerinduk,
            ],
            [
                'nomerinduk.unique'=>'Nomer induk sudah digunakan',
            ]);
        }


        $request->validate([
            'nama'=>'required',
            'nomerinduk'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
            'nomerinduk.required'=>'nomerinduk harus diisi',
        ]);

        walikelas::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'nomerinduk'     =>   $request->nomerinduk,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.walikelas',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,walikelas $data){

        walikelas::destroy($data->id);
        return redirect()->route('sekolah.walikelas',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function cari(sekolah $id, Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='walikelas';
        $datas=DB::table('walikelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.walikelas_index',compact('pages','id','request','datas'));

    }

    public function multidel(sekolah $id, Request $request)
    {

        $ids=$request->ids;
        walikelas::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='walikelas';
        $datas=DB::table('walikelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.walikelas_index',compact('pages','id','request','datas'));

    }
}
