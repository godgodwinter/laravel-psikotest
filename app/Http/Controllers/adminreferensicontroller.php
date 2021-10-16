<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\referensi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminreferensicontroller extends Controller
{
    public function index(sekolah $id,Request $request)
    {
        $pages='referensi';
        // $datas=DB::table('referensi')->whereNull('deleted_at')
        // ->where('sekolah_id',$id->id)
        // // ->with('walireferensi','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = DB::table('referensi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.sekolah.pages.referensi_index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='referensi';

        return view('pages.admin.sekolah.pages.referensi_create',compact('pages','id'));
    }

    public function store(sekolah $id,Request $request)
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
                   'sekolah_id'     =>   $id->id,
                    'file' => $namafileku,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            return redirect()->route('sekolah.referensi',$id->id)->with('status','Data berhasil di tambahkan!')->with('tipe','success');

     }

    public function edit(sekolah $id,referensi $data)
    {
        $pages='referensi';

        return view('pages.admin.sekolah.pages.referensi_edit',compact('pages','id','data'));
    }
    public function update(sekolah $id,referensi $data,Request $request)
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
            'sekolah_id'     =>   $id->id,
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
            'sekolah_id'     =>   $id->id,
            'updated_at'=>date("Y-m-d H:i:s")
        ]);
        }


    return redirect()->route('sekolah.referensi',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,referensi $data){

        referensi::destroy($data->id);
        return redirect()->route('sekolah.referensi',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

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
