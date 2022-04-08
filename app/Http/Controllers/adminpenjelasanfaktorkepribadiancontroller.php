<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\penjelasan_faktorkepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminpenjelasanfaktorkepribadiancontroller extends Controller
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
        $pages='penjelasan_faktorkepribadian';
        $datas = DB::table('penjelasan_faktorkepribadian')->whereNull('deleted_at')
        ->orderBy('namakarakter','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.penjelasan_faktorkepribadian.index',compact('pages','request','datas'));
    }

    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='penjelasan_faktorkepribadian';
        $datas=DB::table('penjelasan_faktorkepribadian')
        ->whereNull('deleted_at')
        ->where('namakarakter','like',"%".$cari."%")
        ->orWhere('pemahaman','like',"%".$cari."%")
        ->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.penjelasan_faktorkepribadian.index',compact('pages','request','datas'));
    }
    public function create()
    {
        $pages='penjelasan_faktorkepribadian';

        return view('pages.admin.penjelasan_faktorkepribadian.create',compact('pages'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $cek=DB::table('penjelasan_faktorkepribadian')->whereNull('deleted_at')->where('namakarakter',$request->namakarakter)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'namakarakter'=>'required|unique:penjelasan_faktorkepribadian,namakarakter',

                    ],
                    [
                        'namakarakter.unique'=>'Nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'namakarakter'=>'required',

            ],
            [
                'namakarakter.nama'=>'Nama harus diisi',
            ]);


        //inser penjelasan_faktorkepribadian
        DB::table('penjelasan_faktorkepribadian')->insert(
            array(
                   'namakarakter'     =>   $request->namakarakter,
                   'pemahaman'     =>   $request->pemahaman,
                   'pembiasaansikap'     =>   $request->pembiasaansikap,
                   'tujuandanmanfaat'     =>   $request->tujuandanmanfaat,
                   'tipekarakter'     =>  $request->tipekarakter?$request->tipekarakter:'Positif',
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('penjelasanfaktorkepribadian')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(penjelasan_faktorkepribadian $data)
    {
        $pages='penjelasan_faktorkepribadian';

        return view('pages.admin.penjelasan_faktorkepribadian.edit',compact('pages','data'));
    }
    public function update(penjelasan_faktorkepribadian $data,Request $request)
    {
        // dd($request);
        if($request->namakarakter!==$data->namakarakter){

            $request->validate([
                'namakarakter' => "required|unique:penjelasan_faktorkepribadian,namakarakter,".$request->namakarakter,
            ],
            [
                'namakarakter.unique'=>'Nama sudah digunakan',
            ]);
        }


        $request->validate([
            'namakarakter'=>'required',
        ],
        [
            'namakarakter.required'=>'nama sudah digunakan',
        ]);

        penjelasan_faktorkepribadian::where('id',$data->id)
        ->update([
            'namakarakter'     =>   $request->namakarakter,
            'pemahaman'     =>   $request->pemahaman,
            'pembiasaansikap'     =>   $request->pembiasaansikap,
            'tujuandanmanfaat'     =>   $request->tujuandanmanfaat,
            'tipekarakter'     =>   $request->tipekarakter?$request->tipekarakter:'Positif',

           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('penjelasanfaktorkepribadian')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(penjelasan_faktorkepribadian $data){

        penjelasan_faktorkepribadian::destroy($data->id);
        return redirect()->route('penjelasanfaktorkepribadian')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        penjelasan_faktorkepribadian::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='penjelasan_faktorkepribadian';
        $datas = DB::table('penjelasan_faktorkepribadian')->whereNull('deleted_at')
        ->orderBy('namakarakter','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.penjelasan_faktorkepribadian.index',compact('pages','request','datas'));
    }
}
