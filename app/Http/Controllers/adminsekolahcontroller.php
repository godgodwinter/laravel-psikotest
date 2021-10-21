<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class adminsekolahcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        });
    }
    public function index(Request $request)
    {
        // if($this->checkauth('admin')==='404'){
        //     return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        // }

        #WAJIB
        $pages='sekolah';
        $datas=DB::table('sekolah')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        // if($this->checkauth('admin')==='404'){
        //     return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        // }

        $cari=$request->cari;
        #WAJIB
        $pages='sekolah';
        $datas=DB::table('sekolah')
        ->whereNull('deleted_at')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('alamat','like',"%".$cari."%")->whereNull('deleted_at')
        ->orWhere('status',$cari)->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='sekolah';

        return view('pages.admin.sekolah.create',compact('pages'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('sekolah')->whereNull('deleted_at')->where('nama',$request->nama)->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:sekolah,nama',

                    ],
                    [
                        'nama.unique'=>'Nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'status'=>'required',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);


        //inser siswa
        DB::table('sekolah')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'alamat'     =>   $request->alamat,
                   'status'     =>   $request->status,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('sekolah')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id)
    {

        $pages='sekolah';

        return view('pages.admin.sekolah.edit',compact('pages','id'));
    }
    public function update(sekolah $id,Request $request)
    {
        // dd($request);
        if($request->nama!==$id->nama){

            $request->validate([
                'nama' => "required|unique:sekolah,nama,".$request->nama,
            ],
            [
                'nama.unique'=>'Nama sudah digunakan',
            ]);
        }


        $request->validate([
            'nama'=>'required',
            // 'sekolah_logo' => 'require|image',
        ],
        [
            'nama.required'=>'nama sudah digunakan',
        ]);



        sekolah::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'alamat'     =>   $request->alamat,
            // 'status'     =>   $request->status,
            'kepsek_nama'     =>   $request->kepsek_nama,
            'tahunajaran_nama'     =>   $request->tahunajaran_nama,
            'semester_nama'     =>   $request->semester_nama,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);



        $files = $request->file('sekolah_logo');

        $imagesDir=public_path().'/storage';
        // dd($request);
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->sekolah_logo)AND($id->sekolah_logo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->sekolah_logo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->sekolah_logo);
            $namafilebaru=$id->id;
            $file = $request->file('sekolah_logo');
            $tujuan_upload = 'storage/logo';
                    // upload file
            $file->move($tujuan_upload,"logo/".$namafilebaru.".jpg");
            sekolah::where('id',$id->id)
            ->update([
                'sekolah_logo' => "logo/".$namafilebaru.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }


        $files = $request->file('kepsek_photo');

        // dd($request);
        if($files!=null){
            if (file_exists( public_path().'/storage'.'/'.$id->kepsek_photo)AND($id->kepsek_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->kepsek_photo;
                unlink($image_path);
            }

            $namafilebaru=$id->id;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('kepsek_photo');
            $tujuan_upload = 'storage/kepsek';
                    // upload file
            $file->move($tujuan_upload,"kepsek/".$namafilebaru.".jpg");
            sekolah::where('id',$id->id)
            ->update([
                'kepsek_photo' => "kepsek/".$namafilebaru.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

    return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id){

        sekolah::destroy($id->id);
        return redirect()->route('sekolah')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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

    //DETAILSEKOLAH
    public function show(sekolah $id,Request $request)
    {
        $pages='sekolah';
        $datas=DB::table('tahun')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.show',compact('pages','id','request','datas'));
    }
}
