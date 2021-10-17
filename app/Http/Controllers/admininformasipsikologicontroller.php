<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\informasipsikologi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admininformasipsikologicontroller extends Controller
{
    public function index(Request $request)
    {
        $pages='informasipsikologi';
        // $datas=DB::table('informasipsikologi')->whereNull('deleted_at')
        // ->where('informasipsikologi_id',$id->id)
        // // ->with('waliinformasipsikologi','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = DB::table('informasipsikologi')
        ->whereNull('deleted_at')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.informasipsikologi.index',compact('pages','request','datas'));
    }
    public function create(informasipsikologi $id)
    {
        $pages='informasipsikologi';

        return view('pages.admin.informasipsikologi.create',compact('pages'));
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
            $tujuan_upload = 'informasipsikologi/';

                    // upload file
            $file->move($tujuan_upload,"informasipsikologi/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                $namafileku="informasipsikologi/".$namafilebaru.'.'.$file->getClientOriginalExtension();
            }

        DB::table('informasipsikologi')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'tipe'     =>   $request->tipe,
                   'link'     =>   $request->link,
                    'file' => $namafileku,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            return redirect()->route('informasipsikologi')->with('status','Data berhasil di tambahkan!')->with('tipe','success');

     }

    public function edit(informasipsikologi $data)
    {
        $pages='informasipsikologi';

        return view('pages.admin.informasipsikologi.edit',compact('pages','data'));
    }
    public function update(informasipsikologi $data,Request $request)
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
                $tujuan_upload = 'informasipsikologi/';

                        // upload file
                $file->move($tujuan_upload,"informasipsikologi/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                    $namafileku="informasipsikologi/".$namafilebaru.'.'.$file->getClientOriginalExtension();
                }


        informasipsikologi::where('id',$data->id)
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

        informasipsikologi::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'tipe'     =>   $request->tipe,
            'link'     =>   $request->link,
            'updated_at'=>date("Y-m-d H:i:s")
        ]);
        }


    return redirect()->route('informasipsikologi')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(informasipsikologi $data){

        informasipsikologi::destroy($data->id);
        return redirect()->route('informasipsikologi')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        informasipsikologi::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='informasipsikologi';
        $datas=DB::table('informasipsikologi')->whereNull('deleted_at')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.informasipsikologi.index',compact('datas','request','pages'))->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
