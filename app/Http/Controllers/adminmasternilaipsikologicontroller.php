<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\masternilaipsikologi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminmasternilaipsikologicontroller extends Controller
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
        $pages='masternilaipsikologi';
        $datas = DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.masternilaipsikologi.index',compact('pages','request','datas'));
    }

    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas=DB::table('masternilaipsikologi')
        ->whereNull('deleted_at')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('singkatan','like',"%".$cari."%")->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

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
        masternilaipsikologi::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='masternilaipsikologi';
        $datas = DB::table('masternilaipsikologi')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.masternilaipsikologi.index',compact('pages','request','datas'));
    }
}
