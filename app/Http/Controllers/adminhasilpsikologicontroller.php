<?php

namespace App\Http\Controllers;

use App\Exports\exporthasilpsikologi;
use App\Helpers\Fungsi;
use App\Imports\importhasilpsikologi;
use App\Models\hasilpsikologi;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class adminhasilpsikologicontroller extends Controller
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
    public function index(sekolah $id,Request $request)
    {
        $pages='hasilpsikologi';
        // $datas=DB::table('kelas')->whereNull('deleted_at')
        // ->where('sekolah_id',$id->id)
        // // ->with('walikelas','nama')
        // ->orderBy('nama','asc')
        // ->paginate(Fungsi::paginationjml());

        $datas = hasilpsikologi::with('siswa')
        ->where('sekolah_id',$id->id)
        ->orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.sekolah.pages.hasilpsikologi.index',compact('pages','id','request','datas'));
    }
    public function create(sekolah $id)
    {
        $pages='hasilpsikologi';
        $siswa=siswa::where('sekolah_id',$id->id)->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();
        // dd($siswa);

        return view('pages.admin.sekolah.pages.hasilpsikologi.create',compact('pages','id','siswa'));
    }
    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=hasilpsikologi::where('siswa_id',$request->siswa_id)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([

                    ],
                    [
                    ]);

            }else{

        //inser kelas
        DB::table('hasilpsikologi')->insert(
            array(
                   'siswa_id'     =>   $request->siswa_id,
                //    'tipe'     =>   $request->tipe,
                   'nilai'     =>   $request->nilai,
                   'sekolah_id'     =>   $id->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            }




    return redirect()->route('sekolah.hasilpsikologi',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(sekolah $id,hasilpsikologi $data)
    {
        $pages='hasilpsikologi';
        $siswa=siswa::where('sekolah_id',$id->id)->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();

        return view('pages.admin.sekolah.pages.hasilpsikologi.edit',compact('pages','id','data','siswa'));
    }
    public function update(sekolah $id,hasilpsikologi $data,Request $request)
    {
        // dd($request);
    //     if($request->nama!==$data->nama){

    //         $request->validate([
    //             'nama' => "required|unique:kelas,nama,".$request->nama,
    //         ],
    //         [
    //             'nama.unique'=>'Nama sudah digunakan',
    //         ]);
    //     }


    //     $request->validate([
    //         'nama'=>'required',
    //     ],
    //     [
    //         'nama.required'=>'nama sudah digunakan',
    //     ]);

        hasilpsikologi::where('id',$data->id)
        ->update([
            'nilai'     =>   $request->nilai,
            'sekolah_id'     =>   $id->id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('sekolah.hasilpsikologi',$id->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(sekolah $id,hasilpsikologi $data){

        hasilpsikologi::destroy($data->id);
        return redirect()->route('sekolah.hasilpsikologi',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function export(sekolah $id,Request $request){
        // dd($request);
        $tgl=date("YmdHis");
		return Excel::download(new exporthasilpsikologi($id), 'psikotest-hasilpsikologi-'.$id->id.'-'.$tgl.'.xlsx');
    }

	public function import(sekolah $id,Request $request)
	{
		// dd($request,$id->id);
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);

		Excel::import(new importhasilpsikologi($id), public_path('/file_temp/'.$nama_file));

        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

	}

}
