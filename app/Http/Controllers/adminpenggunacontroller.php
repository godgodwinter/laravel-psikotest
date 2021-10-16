<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\pengguna;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminpenggunacontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='pengguna';
        $datas = pengguna::with('users')
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
                    'password' => 'min:8|required_with:password2|same:password2',
                    'password2' => 'min:8',

                    ],
                    [
                        'username.unique'=>'username sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'username'=>'required',
                'password' => 'min:8|required_with:password2|same:password2',
                'password2' => 'min:8',

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
                'nomerinduk' => "required|unique:pengguna,nomerinduk,".$request->nomerinduk,
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

        pengguna::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'nomerinduk'     =>   $request->nomerinduk,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.pengguna',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,pengguna $data){

        pengguna::destroy($data->id);
        return redirect()->route('sekolah.pengguna',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
