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

class bksettingpenggunacontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
     public function index(Request $request)
     {
         $pages='pengguna';

         $users_id=Auth::user()->id;
         $data=pengguna::with('users')->where('users_id',$users_id)->first();
         $sekolah_id=$data->sekolah_id;
         $id=DB::table('sekolah')->where('id',$sekolah_id)->first();



         return view('pages.bk.pengguna_setting',compact('pages','id','request','data'));
     }

    public function update(Request $request)
    {
        $users_id=Auth::user()->id;
         $data=pengguna::with('users')->where('users_id',$users_id)->first();
         $sekolah_id=$data->sekolah_id;
         $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

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
            'password' => 'min:8|required_with:password2|same:password2',
            'password2' => 'min:8',
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

    return redirect()->route('bk.beranda',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }



}
