<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use Illuminate\Http\Request;
use App\Helpers\Fungsi;
use App\Models\tahun;
use Illuminate\Support\Facades\DB;

class admintahunajarancontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='tahun';
        $datas=DB::table('tahun')->whereNull('deleted_at')->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.tahun_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='tahun';

        return view('pages.admin.sekolah.pages.tahun_create',compact('pages','id'));
    }
    
    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('tahun')->whereNull('deleted_at')->where('nama',$request->nama)->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:tahun,nama',

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
        DB::table('tahun')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.tahun',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
    
    public function edit(sekolah $id,tahun $data)
    {
        $pages='tahun';

        return view('pages.admin.sekolah.pages.tahun_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,tahun $data,Request $request)
    {

        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:tahun,nama,".$request->nama,
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

        tahun::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.tahun',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,tahun $data){

        tahun::destroy($data->id);
        return redirect()->route('sekolah.tahun',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
