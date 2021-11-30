<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class adminsettingscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin' && Auth::user()->tipeuser!='yayasan' && Auth::user()->tipeuser!='bk'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(){
        $pages='settings';
        $datas=DB::table('settings')->where('id',1)->first();
        return view('pages.admin.settings.index',compact('datas','pages'));
    }
    public function update(settings $id,Request $request){
        // dd($request,$id);
        settings::where('id',$id->id)
        ->update([
            'app_nama' => $request->app_nama,
            'app_namapendek' => $request->app_namapendek,
            'paginationjml' => $request->paginationjml,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
        return redirect()->route('settings')->with('status','Data berhasil diubah!')->with('tipe','success');
    }

    public function profile(){
        $pages='settings';
    $id=Auth::user()->id;
    // dd($id);
        $datas=User::where('id',$id)->first();
        return view('pages.admin.settings.profile',compact('datas','pages'));
    }


    public function updateprofile(User $id,Request $request)
    {

        if($request->username!==$id->username){

            $request->validate([
                'name' => "required",
            ],
            [
            ]);
        }

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'username'=>'required',
        ],
        [
            'name.required'=>'name harus diisi',
        ]);


        if($request->password!=null OR $request->password!=''){

        $request->validate([
            'password' => 'min:8|required_with:password2|same:password2',
            'password2' => 'min:8',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);
            User::where('id',$id->id)
            ->update([
                'name'     =>   $request->name,
                'username'     =>   $request->username,
                'email'     =>   $request->email,
                'password' => Hash::make($request->password),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }else{
            User::where('id',$id->id)
            ->update([
                'name'     =>   $request->name,
                'username'     =>   $request->username,
                'email'     =>   $request->email,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }


    return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }

}
