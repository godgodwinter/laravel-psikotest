<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\catatanpengembangandirisiswa;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class bkcatatanpengembangandirisiswacontroller extends Controller
{

    protected $projects;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }
        return $next($request);
        });
    }
        public function index(Request $request){
                $pages='bk-catatanpengembangandirisiswa';
                $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

                $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
                ->where('sekolah_id',$id->id)
                ->orderBy('siswa_id','asc')
                ->paginate(Fungsi::paginationjml());

                return view('pages.bk.catatanpengembangandirisiswa.index',compact('pages','id','request','datas'));
        }
        public function cari(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk_catatanpengembangandirisiswa';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas=catatanpengembangandirisiswa::join('siswa','catatanpengembangandirisiswa.siswa_id','=','siswa.id')
            ->where('siswa.nama','like',"%".$cari."%")
            ->where('catatanpengembangandirisiswa.sekolah_id',$sekolah_id)
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.catatanpengembangandirisiswa.index',compact('pages','id','request','datas'));
        }

        public function create(sekolah $id)
        {
            $pages='bk-catatanpengembangandirisiswa';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();
            $kelas=DB::table('kelas')->where('id',$sekolah_id)->get();
            $siswa=DB::table('siswa')->whereNull('deleted_at')
            ->where('sekolah_id',$id->id)
            ->orderBy('nama','asc')->get();

            return view('pages.bk.catatanpengembangandirisiswa.create',compact('pages','id','siswa','kelas'));
        }


        public function store(sekolah $id,Request $request)
    {
        // dd($id,$request);
        $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
        $cek=DB::table('catatanpengembangandirisiswa')->whereNull('deleted_at')->where('id',$request->id)
        ->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    // 'nama'=>'required|unique:siswa,nama',
                    // 'nomerinduk'=>'required|unique:siswa,nomerinduk',

                    ],
                    [
                        // 'nomerinduk.unique'=>'Nomer Induk sudah digunakan',
                    ]);

            }

            $request->validate([


            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);


        //inser siswa
        DB::table('catatanpengembangandirisiswa')->insert(
            array(
                'siswa_id'  =>$request->siswa_id,
                'kelas_id'  =>$request->kelas_id,
                'tanggal'    =>$request->tanggal,
                'idedanimajinasi'    =>$request->idedanimajinasi,
                'ketrampilan'    =>$request->ketrampilan,
                'kreatif'    =>$request->kreatif,
                'oraganisasi'    =>$request->organisasi,
                'kelanjutanstudi'    =>$request->kelanjutanstudi,
                'hobi'    =>$request->hobi,
                'citacita'    =>$request->citacita,
                'kemampuankhusus'    =>$request->kemampuankhusus,
                'keterangan'    =>$request->keterangan,
                'sekolah_id'    =>$sekolah_id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ));

            return redirect()->route('bk.catatanpengembangandirisiswa',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');


    }

    public function edit(sekolah $id,catatanpengembangandirisiswa $data)
    {
        $pages='bk-catatanpengembangandirisiswa';

        $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

                $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
                ->where('id',$data->id)
                ->where('sekolah_id',$id->id)
                ->orderBy('siswa_id','asc')
                ->first();

              $kelas=DB::table('kelas')->where('id',$sekolah_id)->get();
              $siswa=DB::table('siswa')->whereNull('deleted_at')
              ->where('sekolah_id',$id->id)
              ->orderBy('nama','asc')->get();

        return view('pages.bk.catatanpengembangandirisiswa.edit',compact('pages','id','datas','data','siswa','kelas'));
    }
    public function update(catatanpengembangandirisiswa $data,Request $request)
    {
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;

        if($request->id!==$data->id){

            $request->validate([

            ],
            [

            ]);
        }


        $request->validate([
            'nama'=>'required',
            //'nomerinduk'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
            //'nomerinduk.required'=>'nomerinduk harus diisi',
        ]);

        catatanpengembangandirisiswa::where('id',$data->id)
        ->update([
            'siswa_id'  =>$request->siswa_id,
            'kelas_id'  =>$request->kelas_id,
            'kasus' =>$request->kasus,
            'tanggal' => $request->tanggal,
            'pengambilandata'   =>$request->pengambilandata,
            'sumberkasus'   =>$request->sumberkasus,
            'golkasus'  =>$request->golkasus,
            'penyebabtimbulkasus'   =>$request->peyebabtimbulkasus,
            'teknikkonseling'   =>$request->teknikkonseling,
            'keberhasilanpenanganankasus'   =>$request->keberhasilanpenanganankasus,
            'keterangan'    =>$request->keterangan,


            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
        return redirect()->route('bk.catatanpengembangandirisiswa',$data->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(catatanpengembangandirisiswa $id){

        catatanpengembangandirisiswa::destroy($id->id);
        return redirect()->route('bk.catatanpengembangandirisiswa',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }


    public function multidel(sekolah $id,Request $request)
    {

        $ids=$request->ids;
        catatanpengembangandirisiswa::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='bk-catatanpengembangandirisiswa';
                $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

                $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
                ->where('sekolah_id',$id->id)
                ->orderBy('siswa_id','asc')
                ->paginate(Fungsi::paginationjml());

                return view('pages.bk.catatanpengembangandirisiswa.index',compact('pages','id','request','datas'));
    }
    }

