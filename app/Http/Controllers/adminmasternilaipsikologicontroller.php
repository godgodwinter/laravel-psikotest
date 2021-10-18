<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\masternilaipsikologi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminmasternilaipsikologicontroller extends Controller
{
    public function index(Request $request)
    {
        $pages='masternilaipsikologi';
        // $datas=DB::table('masternilaipsikologi')->whereNull('deleted_at')
        // 
        // // ->with('walimasternilaipsikologi','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.masternilaipsikologi.index',compact('pages','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='masternilaipsikologi';

        return view('pages.admin.masternilaipsikologi.create',compact('pages'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $cek=DB::table('masternilaipsikologi')->whereNull('deleted_at')->where('nama',$request->nama)
        
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:masternilaipsikologi,nama',

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


        //inser masternilaipsikologi
        DB::table('masternilaipsikologi')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'singkatan'     =>   $request->singkatan,
                   
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('masternilaipsikologi')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(masternilaipsikologi $data)
    {
        $pages='masternilaipsikologi';

        return view('pages.admin.masternilaipsikologi.edit',compact('pages','data'));
    }
    public function update(masternilaipsikologi $data,Request $request)
    {
        // dd($request);
        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:masternilaipsikologi,nama,".$request->nama,
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

        masternilaipsikologi::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'singkatan'     =>   $request->singkatan,
            
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('masternilaipsikologi')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(masternilaipsikologi $data){

        masternilaipsikologi::destroy($data->id);
        return redirect()->route('masternilaipsikologi')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
