<?php

namespace App\Http\Controllers;

use App\Exports\exporthasilpsikologi;
use App\Helpers\Fungsi;
use App\Imports\importhasilpsikologi;
use App\Models\hasilpsikologi;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class adminhasilpsikologicontroller extends Controller
{
    protected $cari;
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
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        $pages='hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=hasilpsikologi::where('siswa_id',$d->id)
                ->count();

                if($periksadata>0){
                    $ambil=hasilpsikologi::where('siswa_id',$d->id)
                    ->first();
                    $nilai=$ambil->nilai;
                }else{
                    $nilai=null;
                }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'nilai'=>$nilai,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();

        return view('pages.admin.sekolah.pages.hasilpsikologi.index',compact('pages','id','request','datas','kelas','kelaspertama'));
    }


    public function cari(sekolah $id,Request $request)
    {
        $this->cari=$request->kelas_id;
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$id->id)
                        ->first();
        $pages='hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$id->id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$id->id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')
        ->get();


            $dataakhir = new Collection();

        foreach($datasiswa as $d){




                $periksadata=DB::table('hasilpsikologi')
                ->where('siswa_id',$d->id)
                ->count();

                if($periksadata>0){
                    $ambil=DB::table('hasilpsikologi')
                    ->where('siswa_id',$d->id)
                    ->first();
                    $nilai=$ambil->nilai;
                }else{
                    $nilai=null;
                }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'nilai'=>$nilai,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$id->id)->get();
        // dd($datas);

        return view('pages.admin.sekolah.pages.hasilpsikologi.index',compact('pages','id','request','datas','kelas','kelaspertama'));
    }
    public function create(sekolah $id,Request $request)
    {
        $siswa_id=$request->siswa_id;
        $siswaterpilih=siswa::where('id',$siswa_id)->first();
        $pages='hasilpsikologi';
        // dd($siswa_id);
        $siswa=siswa::where('sekolah_id',$id->id)->where('sekolah_id',$id->id)
        ->orderBy('nama','asc')->get();
        // dd($siswaterpilih);

        return view('pages.admin.sekolah.pages.hasilpsikologi.create',compact('pages','id','siswa','siswaterpilih'));
    }
    public function store(sekolah $id,Request $request)
    {
        // dd($request);
        $cek=hasilpsikologi::where('siswa_id',$request->siswa_id)
        ->where('sekolah_id',$id->id)
        ->count();
        // dd($cek);
            if($cek>0){

        hasilpsikologi::where('siswa_id',$request->siswa_id)
        ->update([
            'nilai'     =>   $request->nilai,
           'updated_at'=>date("Y-m-d H:i:s")
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
    public function destroy(sekolah $id,siswa $siswa){

        hasilpsikologi::where('siswa_id',$siswa->id)->delete();
        // dd('tes',$siswa->id);
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
