<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bkberandacontroller extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            if((Auth::user()->tipeuser!='bk')){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan')->with('tipe','danger');
            }elseif((Auth::user()->tipeuser=='bk') and ($id->status=='Tidak Aktif')){
                return redirect()->route('bk.non')->with('status','Sekolah nonaktif')->with('tipe','danger');

            }

        return $next($request);
        });
    }

    public function index(Request $request)
    {
        $pages='bk-beranda';
        $datas=DB::table('tahun')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

        return view('pages.bk.beranda.index',compact('pages','id','request','datas'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $id=DB::table('sekolah')->where('id',$sekolah_id)->first();
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
             
            'kepsek_nama'     =>   $request->kepsek_nama,
            'tahunajaran_nama'     =>   $request->tahunajaran_nama,
            'semester_nama'     =>   $request->semester_nama,
            'provinsi'     =>   $request->provinsi_nama,
            'kabupaten'     =>   $request->kabupaten_nama,
            'kecamatan'     =>   $request->kecamatan_nama,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);




           
            $imagesDir=public_path().'/storage';

            $files = $request->file('sekolah_logo');
            if($files!=null){

                if (file_exists( public_path().'/storage'.'/'.$id->sekolah_logo)AND($id->sekolah_logo!=null)){
                    chmod($imagesDir, 0777);
                    $image_path = public_path().'/storage'.'/'.$id->sekolah_logo;
                    unlink($image_path);
                }
                // dd('storage'.'/'.$id->sekolah_logo);
                $file = $request->file('sekolah_logo');
                $tujuan_upload = 'storage/sekolah';
                // upload file
                $file->move($tujuan_upload,$sekolah_id.".jpg");
                sekolah::where('id',$sekolah_id)
                ->update([
                    'sekolah_logo' => "sekolah/".$sekolah_id.".jpg",
                'updated_at'=>date("Y-m-d H:i:s")
                ]);

            }


            $files = $request->file('kepsek_photo');
            if($files!=null){

                if (file_exists( public_path().'/storage'.'/'.$id->kepsek_photo)AND($id->kepsek_photo!=null)){
                    chmod($imagesDir, 0777);
                    $image_path = public_path().'/storage'.'/'.$id->kepsek_photo;
                    unlink($image_path);
                }
                // dd('storage'.'/'.$id->kepsek_photo);
                $file = $request->file('kepsek_photo');
                $tujuan_upload = 'storage/kepsek';
                // upload file
                $file->move($tujuan_upload,$sekolah_id.".jpg");
                sekolah::where('id',$sekolah_id)
                ->update([
                    'kepsek_photo' => "kepsek/".$sekolah_id.".jpg",
                'updated_at'=>date("Y-m-d H:i:s")
                ]);


            }


    return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }

    public function referensi(Request $request)
    {
        $pages='bk-referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.referensi.index',compact('pages','request','datas'));
    }
    public function cari_ref(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk_referensi';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = DB::table('referensi')

            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.referensi.index',compact('pages','request','datas'));
        }
    public function informasipsikologi(Request $request)
    {
        $pages='bk-informasipsikologi';
        $datas = DB::table('informasipsikologi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.bk.informasipsikologi.index',compact('pages','request','datas'));
    }
    public function cari_infp(Request $request)
        {
            $cari=$request->cari;
            #WAJIB
            $pages='bk_informasipsikologi';
            $users_id=Auth::user()->id;
            $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
            $sekolah_id=$pengguna->sekolah_id;
            $id=DB::table('sekolah')->where('id',$sekolah_id)->first();

            $datas = DB::table('referensi')

            ->where('nama','like',"%".$cari."%")
            ->paginate(Fungsi::paginationjml());

            return view('pages.bk.informasipsikologi.index',compact('pages','request','datas'));
        }

}
