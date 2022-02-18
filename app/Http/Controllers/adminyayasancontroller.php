<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\yayasan;
use App\Models\User;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class adminyayasancontroller extends Controller
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
        $pages='yayasan';
        $datas=yayasan::orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasan.index',compact('pages','request','datas'));
    }
    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas=yayasan::
        whereNull('deleted_at')
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasan.index',compact('pages','request','datas'));
    }
    public function create()
    {
        $pages='yayasan';

        return view('pages.admin.yayasan.create',compact('pages'));
    }

    public function store(Request $request)
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

            $users_id=DB::table('users')->insertGetId(
                array(
                       'name'     =>   $request->nama,
                       'email'     =>   $request->email,
                       'username'     =>   $request->username,
                       'nomerinduk'     => date('YmdHis'),
                       'password' => Hash::make($request->password),
                       'tipeuser' => 'yayasan',
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

        //inser pengguna
        $yayasan_id=DB::table('yayasan')->insertGetId(
            array(
                   'nama'     =>   $request->nama,
                   'kepala'     =>   $request->kepala,
                   'telp'     =>   $request->telp,
                   'alamat'     =>   $request->alamat,
                   'status'     =>   $request->status,
                   'users_id'     =>   $users_id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));


        $id=yayasan::where('id',$yayasan_id)->first();
        $imagesDir=public_path().'/storage';

        $files = $request->file('yayasan_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->yayasan_photo)AND($id->yayasan_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->yayasan_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->yayasan_photo);
            $file = $request->file('yayasan_photo');
            $tujuan_upload = 'storage/yayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'yayasan_photo' => "yayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }


        $files = $request->file('kepala_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->kepala_photo)AND($id->kepala_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->kepala_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->kepala_photo);
            $file = $request->file('kepala_photo');
            $tujuan_upload = 'storage/kepalayayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'kepala_photo' => "kepalayayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

    return redirect()->route('yayasan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(yayasan $data)
    {
        $pages='yayasan';

        return view('pages.admin.yayasan.edit',compact('pages','data'));
    }
    public function update(yayasan $data,Request $request)
    {


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

        yayasan::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'kepala'     =>   $request->kepala,
            'telp'     =>   $request->telp,
            'alamat'     =>   $request->alamat,
            'status'     =>   $request->status,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        $id=$data;
        $imagesDir=public_path().'/storage';

        $yayasan_id=$data->id;
        $files = $request->file('yayasan_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->yayasan_photo)AND($id->yayasan_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->yayasan_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->yayasan_photo);
            $file = $request->file('yayasan_photo');
            $tujuan_upload = 'storage/yayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'yayasan_photo' => "yayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }


        $files = $request->file('kepala_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->kepala_photo)AND($id->kepala_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->kepala_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->kepala_photo);
            $file = $request->file('kepala_photo');
            $tujuan_upload = 'storage/kepalayayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'kepala_photo' => "kepalayayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

    return redirect()->route('yayasan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(yayasan $data){

        yayasan::destroy($data->id);
        yayasandetail::where('yayasan_id',$data->id)->delete();
        User::destroy($data->users_id);
        return redirect()->route('yayasan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        // $ambildatayayasan=yayasan::where('id',$ids)->first();
        // $usersid=$ambildatayayasan->users_id;
        // User::destroy($data->usersid);
        yayasandetail::whereIn('yayasan_id',$ids)->delete();
        yayasan::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='yayasan';
        $datas=yayasan::orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasan.index',compact('pages','request','datas'));
    }
}
