<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminwalikelascontroller extends Controller
{
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
