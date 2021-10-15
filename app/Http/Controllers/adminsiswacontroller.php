<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminsiswacontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='siswa';
        $datas=DB::table('siswa')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.siswa_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='siswa';

        return view('pages.admin.sekolah.pages.siswa_create',compact('pages','id'));
    }
    
    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('siswa')->whereNull('deleted_at')->where('nama',$request->nama)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:siswa,nama',

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


        //inser siswa
        DB::table('siswa')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.siswa',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
    
    public function edit(sekolah $id,siswa $data)
    {
        $pages='siswa';

        return view('pages.admin.sekolah.pages.siswa_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,siswa $data,Request $request)
    {

        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:siswa,nama,".$request->nama,
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

        siswa::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.siswa',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,siswa $data){

        siswa::destroy($data->id);
        return redirect()->route('sekolah.siswa',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
