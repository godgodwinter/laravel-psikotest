<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\referensi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminreferensicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        $pages='referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.referensi.index',compact('pages','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='referensi';

        return view('pages.admin.referensi.create',compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'tipe'=>'required',
            'file' => 'max:2000|mimes:pdf,png,jpeg,xml', //1MB
        ],
        [
            'nama.required'=>'Nama Harus diisi',

        ]);

        // $validator = Validator::make($request->all(), [
        //     'file' => 'max:5120', //5MB
        // ]);

        $files = $request->file('file');

        // dd($request);
        $namafileku=null;
        if($files!=null){
            // dd(!Input::hasFile('files'));
            // dd($files,'aaa');
            $namafilebaru=date('YmdHis');

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
                      // nama file
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';

                      // ekstensi file
            echo 'File Extension: '.$file->getClientOriginalExtension();
            // dd()
            echo '<br>';

                      // real path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

                      // ukuran file
            echo 'File Size: '.$file->getSize();
            echo '<br>';

                      // tipe mime
            echo 'File Mime Type: '.$file->getMimeType();

                      // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'referensi/';

                    // upload file
            $file->move($tujuan_upload,"referensi/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                $namafileku="referensi/".$namafilebaru.'.'.$file->getClientOriginalExtension();
            }

        DB::table('referensi')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'tipe'     =>   $request->tipe,
                   'link'     =>   $request->link,
                    'file' => $namafileku,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            return redirect()->route('referensi')->with('status','Data berhasil di tambahkan!')->with('tipe','success');

     }

    public function edit(referensi $data)
    {
        $pages='referensi';

        return view('pages.admin.referensi.edit',compact('pages','data'));
    }
    public function update(referensi $data,Request $request)
    {
        // dd($request);
        if($request->file!=null){
            $request->validate([
                'nama'=>'required',
                'tipe'=>'required',
                'file' => 'max:2000|mimes:pdf,png,jpeg,xml', //1MB
            ],
            [
                'nama.required'=>'Nama Harus diisi',

            ]);

            // $validator = Validator::make($request->all(), [
            //     'file' => 'max:5120', //5MB
            // ]);

            $files = $request->file('file');

            // dd($request);
            $namafileku=null;
            if($files!=null){
                // dd(!Input::hasFile('files'));
                // dd($files,'aaa');
                $namafilebaru=date('YmdHis');

                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('file');
                          // nama file
                echo 'File Name: '.$file->getClientOriginalName();
                echo '<br>';

                          // ekstensi file
                echo 'File Extension: '.$file->getClientOriginalExtension();
                // dd()
                echo '<br>';

                          // real path
                echo 'File Real Path: '.$file->getRealPath();
                echo '<br>';

                          // ukuran file
                echo 'File Size: '.$file->getSize();
                echo '<br>';

                          // tipe mime
                echo 'File Mime Type: '.$file->getMimeType();

                          // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'referensi/';

                        // upload file
                $file->move($tujuan_upload,"referensi/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                    $namafileku="referensi/".$namafilebaru.'.'.$file->getClientOriginalExtension();
                }


        referensi::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'tipe'     =>   $request->tipe,
            'link'     =>   $request->link,
             'file' => $namafileku,
            'updated_at'=>date("Y-m-d H:i:s")
        ]);
        }else{

            $request->validate([
                'nama'=>'required',
                'tipe'=>'required',
            ],
            [
                'nama.required'=>'Nama Harus diisi',

            ]);

        referensi::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'tipe'     =>   $request->tipe,
            'link'     =>   $request->link,
            'updated_at'=>date("Y-m-d H:i:s")
        ]);
        }


    return redirect()->route('referensi')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(referensi $data){

        referensi::destroy($data->id);
        return redirect()->route('referensi')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        Referensi::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='referensi';
        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.referensi.index',compact('pages','request','datas'));
    }
    public function cari(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        $cari=$request->cari;
        #WAJIB
        $pages='referensi';
        $datas=DB::table('referensi')
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.referensi.index',compact('datas','request','pages'));
    }
}
