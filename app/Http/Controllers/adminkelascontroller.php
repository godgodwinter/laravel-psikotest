<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Http\Resources\kelasindexresource;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminkelascontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='kelas';
        // $datas=DB::table('kelas')->whereNull('deleted_at')
        // ->where('sekolah_id',$id->id)
        // // ->with('walikelas','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = kelas::with('walikelas')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.sekolah.pages.kelas_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='kelas';
        $walikelas=DB::table('walikelas')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();

        return view('pages.admin.sekolah.pages.kelas_create',compact('pages','id','walikelas'));
    }

    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('kelas')->whereNull('deleted_at')->where('nama',$request->nama)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:kelas,nama',

                    ],
                    [
                        'nama.unique'=>'Nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);


        //inser kelas
        DB::table('kelas')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'tipe'     =>   $request->tipe,
                   'walikelas_id'     =>   $request->walikelas_id,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.kelas',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id,kelas $data)
    {
        $pages='kelas';

        return view('pages.admin.sekolah.pages.kelas_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,kelas $data,Request $request)
    {

        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:kelas,nama,".$request->nama,
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

        kelas::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'tipe'     =>   $request->tipe,
            'walikelas_id'     =>   $request->walikelas_id,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.kelas',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,kelas $data){

        kelas::destroy($data->id);
        return redirect()->route('sekolah.kelas',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        sekolah::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='sekolah';
        $datas=DB::table('sekolah')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.index',compact('datas','request','pages'))->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
