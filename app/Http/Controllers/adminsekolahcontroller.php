<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminsekolahcontroller extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $pages='sekolah';
        // dd(Auth::user()->tipeuser);
        #WAJIB
        $datas=DB::table('sekolah')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='sekolah';

        return view('pages.admin.sekolah.create',compact('pages'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('sekolah')->whereNull('deleted_at')->where('nama',$request->nama)->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:sekolah,nama',

                    ],
                    [
                        'nama.unique'=>'Nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'status'=>'required',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);


        //inser siswa
        DB::table('sekolah')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'alamat'     =>   $request->alamat,
                   'status'     =>   $request->nama,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id)
    {
        $pages='sekolah';

        return view('pages.admin.sekolah.edit',compact('pages','id'));
    }
    public function update(sekolah $id,Request $request)
    {

        if($request->nama!==$id->nama){

            $request->validate([
                'nama' => "required|unique:sekolah,nama,".$request->nama,
            ],
            [
                'nama.unique'=>'Nama sudah digunakan',
            ]);
        }


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'nama sudah digunakan',
        ]);

        sekolah::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'alamat'     =>   $request->alamat,
            'status'     =>   $request->status,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id){

        sekolah::destroy($id->id);
        return redirect()->route('sekolah')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
