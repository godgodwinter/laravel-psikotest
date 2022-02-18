<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\minatbakat;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminminatbakatcontroller extends Controller
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
        $pages='minatbakat';
        $datas = DB::table('minatbakat')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.minatbakat.index',compact('pages','request','datas'));
    }

    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas=DB::table('minatbakat')
        ->whereNull('deleted_at')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('kategori','like',"%".$cari."%")->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.minatbakat.index',compact('pages','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='minatbakat';

        return view('pages.admin.minatbakat.create',compact('pages'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $cek=DB::table('minatbakat')->whereNull('deleted_at')->where('nama',$request->nama)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:minatbakat,nama',

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


        //inser minatbakat
        DB::table('minatbakat')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'kategori'     =>   $request->kategori,

                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('minatbakat')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(minatbakat $data)
    {
        $pages='minatbakat';

        return view('pages.admin.minatbakat.edit',compact('pages','data'));
    }
    public function update(minatbakat $data,Request $request)
    {
        // dd($request);
        if($request->nama!==$data->nama){

            $request->validate([
                'nama' => "required|unique:minatbakat,nama,".$request->nama,
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

        minatbakat::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'kategori'     =>   $request->kategori,

           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('minatbakat')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(minatbakat $data){

        minatbakat::destroy($data->id);
        return redirect()->route('minatbakat')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        minatbakat::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='minatbakat';
        $datas = DB::table('minatbakat')->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.minatbakat.index',compact('pages','request','datas'));
    }
}
