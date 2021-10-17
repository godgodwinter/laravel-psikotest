<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\masternilaibidangstudi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminmasternilaibidangstudicontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='masternilaibidangstudi';
        // $datas=DB::table('masternilaibidangstudi')->whereNull('deleted_at')
        // ->where('sekolah_id',$id->id)
        // // ->with('walimasternilaibidangstudi','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = DB::table('masternilaibidangstudi')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.sekolah.pages.masternilaibidangstudi.index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='masternilaibidangstudi';

        return view('pages.admin.sekolah.pages.masternilaibidangstudi.create',compact('pages','id'));
    }

    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('masternilaibidangstudi')->whereNull('deleted_at')->where('nama',$request->nama)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:masternilaibidangstudi,nama',

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


        //inser masternilaibidangstudi
        DB::table('masternilaibidangstudi')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'singkatan'     =>   $request->singkatan,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.masternilaibidangstudi',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id,masternilaibidangstudi $data)
    {
        $pages='masternilaibidangstudi';

        return view('pages.admin.sekolah.pages.masternilaibidangstudi.edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,masternilaibidangstudi $data,Request $request)
    {
        // dd($request);
        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:masternilaibidangstudi,nama,".$request->nama,
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

        masternilaibidangstudi::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'singkatan'     =>   $request->singkatan,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.masternilaibidangstudi',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,masternilaibidangstudi $data){

        masternilaibidangstudi::destroy($data->id);
        return redirect()->route('sekolah.masternilaibidangstudi',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
