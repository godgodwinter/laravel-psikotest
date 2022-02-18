<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\pengguna;
use App\Models\sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminpenggunacontroller extends Controller
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
    public function index(sekolah $id,Request $request)
    {
        $pages='pengguna';
        $datas = pengguna::with('users')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.pengguna_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='pengguna';

        return view('pages.admin.sekolah.pages.pengguna_create',compact('pages','id'));
    }

    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=DB::table('users')
        // ->whereNull('deleted_at')
        ->where('username',$request->username)
        ->orWhere('email',$request->email)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'username'=>'required|unique:users,username',
                    'email'=>'required|unique:users,email',
                    'password' => 'min:6|required_with:password2|same:password2',
                    'password2' => 'min:6',

                    ],
                    [
                        'username.unique'=>'username sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'username'=>'required',
                'password' => 'min:6|required_with:password2|same:password2',
                'password2' => 'min:6',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);

            DB::table('users')->insert(
                array(
                       'name'     =>   $request->nama,
                       'email'     =>   $request->email,
                       'username'     =>   $request->username,
                       'nomerinduk'     => date('YmdHis'),
                       'password' => Hash::make($request->password),
                       'tipeuser' => 'bk',
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

                $datausers=DB::table('users')->where('username',$request->username)->first();

        //inser pengguna
        DB::table('pengguna')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'users_id'     =>   $datausers->id,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah.pengguna',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id,pengguna $data)
    {
        $pages='pengguna';

        return view('pages.admin.sekolah.pages.pengguna_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,pengguna $data,Request $request)
    {

        if($request->nomerinduk!==$data->nomerinduk){

            $request->validate([
                'nama' => "required",
            ],
            [
            ]);
        }

        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'username'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);


        if($request->password!=null OR $request->password!=''){

        $request->validate([
            'password' => 'min:6|required_with:password2|same:password2',
            'password2' => 'min:6',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);
            User::where('id',$data->users_id)
            ->update([
                'name'     =>   $request->nama,
                'email'     =>   $request->email,
                'password' => Hash::make($request->password),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }else{
            User::where('id',$data->users_id)
            ->update([
                'name'     =>   $request->nama,
                'email'     =>   $request->email,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

        pengguna::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

    return redirect()->route('sekolah.pengguna',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,pengguna $data){

        pengguna::destroy($data->id);
        return redirect()->route('sekolah.pengguna',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function cari(sekolah $id,Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='pengguna';
        $datas = pengguna::with('users')

        ->where('sekolah_id',$id->id)
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.pengguna_index',compact('pages','id','request','datas'));
    }

    public function multidel(sekolah $id,Request $request)
    {

        $ids=$request->ids;
        pengguna::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='pengguna';
        $datas = pengguna::with('users')
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.pengguna_index',compact('pages','id','request','datas'));
    }
}
