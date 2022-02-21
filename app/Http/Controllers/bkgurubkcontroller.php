<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\gurubk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkgurubkcontroller extends Controller
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
                $pages='bk-gurubk';
                $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

                $datas = gurubk::whereNull('deleted_at')
                ->where('sekolah_id',$id->id)
                ->orderBy('nama','asc')
                ->paginate(Fungsi::paginationjml());

                return view('pages.bk.gurubk.index',compact('pages','id','request','datas'));
        }
        public function cari(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk-gurubk';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = gurubk::whereNull('deleted_at')
            ->where('sekolah_id',$id->id)
            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.gurubk.index',compact('pages','id','request','datas'));
        }

        public function create()
        {
            $pages='bk-gurubk';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            return view('pages.bk.gurubk.create',compact('pages','id'));
        }

        public function store(Request $request)
        {
            // dd($request);
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();
            $cek=DB::table('gurubk')->whereNull('deleted_at')->where('nomerinduk',$request->nomerinduk)
            ->where('sekolah_id',$id->id)
            ->count();
            // dd($cek);
                if($cek>0){
                        $request->validate([
                        // 'nama'=>'required|unique:gurubk,nama',
                        'nomerinduk'=>'required|unique:gurubk,nomerinduk',

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


            //inser gurubk
            DB::table('gurubk')->insert(
                array(
                       'nama'     =>   $request->nama,
                       'nomerinduk'     =>   $request->nomerinduk,
                       'sekolah_id'     =>   $id->id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

        return redirect()->route('bk.gurubk',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

        }

        public function edit(gurubk $data)
        {
            $pages='bk-gurubk';

                $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        $gurubk=DB::table('gurubk')->whereNull('deleted_at')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();

            return view('pages.bk.gurubk.edit',compact('pages','id','data'));
        }
        public function update(gurubk $data,Request $request)
        {

        $users_id=Auth::user()->id;
                $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
                $sekolah_id=$pengguna->sekolah_id;
                $id=DB::table('sekolah')->where('id',$sekolah_id)->first();



            if($request->nomerinduk!==$data->nomerinduk){

                $request->validate([
                    'nama' => "required",
                    'nomerinduk' => "required|unique:gurubk,nomerinduk,".$request->nomerinduk,
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

            gurubk::where('id',$data->id)
            ->update([
                'nama'     =>   $request->nama,
                'nomerinduk'     =>   $request->nomerinduk,
                'sekolah_id'     =>   $id->id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
        return redirect()->route('bk.gurubk',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
        }
        public function destroy(gurubk $data){
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            gurubk::destroy($data->id);
            return redirect()->route('bk.gurubk',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

        }


        public function multidel( Request $request)
        {

            $ids=$request->ids;
            gurubk::whereIn('id',$ids)->delete();

            // load ulang
            #WAJIB
            $pages='bk-gurubk';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas=DB::table('gurubk')->whereNull('deleted_at')
            ->where('sekolah_id',$id->id)
            ->orderBy('nama','asc')
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.gurubk.index',compact('pages','id','request','datas'));

        }
}
