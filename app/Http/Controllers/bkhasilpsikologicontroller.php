<?php

namespace App\Http\Controllers;

use App\Exports\exporthasilpsikologi;
use App\Helpers\Fungsi;
use App\Imports\importhasilpsikologi;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\apiprobk_sertifikat;
use App\Models\hasilpsikologi;
use App\Models\kelas;
use App\Models\masterdeteksi;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class bkhasilpsikologicontroller extends Controller
{
    protected $cari;
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
        $pages='bk-hasilpsikologi';
        $cari=null;
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
                        ->first();
        $pages='bk-hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->where('sekolah_id',$sekolah_id)
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
        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();

        return view('pages.bk.hasilpsikologi.index',compact('pages','request','datas','kelas','kelaspertama'));
    }


    public function cari(Request $request)
    {
        $this->cari=$request->kelas_id;
        $cari=null;
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
                        ->first();
        $pages='bk-hasilpsikologi';
        if($this->cari!=null){
            $cari=$this->cari;

        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
        ->where('id',$cari)
        ->first();
        }

        if($kelaspertama!=null){
            $kelas_id=$kelaspertama->id;
        }else{
            $kelas_id=0;
        }
        // dd($this->cari,$cari,$kelaspertama);
        $datasiswa=siswa::where('sekolah_id',$sekolah_id)
        ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$sekolah_id)
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
        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();
        // dd($datas);

        return view('pages.bk.hasilpsikologi.index',compact('pages','request','datas','kelas','kelaspertama'));
    }
    public function create(Request $request)
    {
        $siswa_id=$request->siswa_id;
        $siswaterpilih=siswa::where('id',$siswa_id)->first();
        $pages='bk-hasilpsikologi';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        // dd($siswa_id);
        $siswa=siswa::where('sekolah_id',$sekolah_id)->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')->get();
        // dd($siswaterpilih);

        return view('pages.bk.hasilpsikologi.create',compact('pages','siswa','siswaterpilih'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $cek=hasilpsikologi::where('siswa_id',$request->siswa_id)
        ->where('sekolah_id',$sekolah_id)
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
                   'sekolah_id'     =>   $sekolah_id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            }




    return redirect()->route('bk.hasilpsikologi',$sekolah_id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(hasilpsikologi $data)
    {
        $pages='bk-hasilpsikologi';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $siswa=siswa::where('sekolah_id',$sekolah_id)->where('sekolah_id',$sekolah_id)
        ->orderBy('nama','asc')->get();

        return view('pages.bk.hasilpsikologi.edit',compact('pages','id','data','siswa'));
    }
    public function update(hasilpsikologi $data,Request $request)
    {
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
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
            'sekolah_id'     =>   $sekolah_id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('bk.hasilpsikologi',$sekolah_id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(siswa $siswa){

        hasilpsikologi::where('siswa_id',$siswa->id)->delete();
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $id=$pengguna->sekolah_id;
        // dd('tes',$siswa->id);
        return redirect()->route('bk.hasilpsikologi',$id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function export(Request $request){
        // dd($request);
        $tgl=date("YmdHis");
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
		return Excel::download(new exporthasilpsikologi($sekolah_id), 'psikotest-hasilpsikologi-'.$sekolah_id.'-'.$tgl.'.xlsx');
    }

	public function import(Request $request)
	{
		// dd($request,$sekolah_id);
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
		Excel::import(new importhasilpsikologi($sekolah_id), public_path('/file_temp/'.$nama_file));

        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

	}
    public function deteksi_lihat_api (siswa $siswa,Request $request)
    {
        // dd($siswa);
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_deteksi_list::where('apiprobk_id',$siswa->apiprobk_id)
        ->where('nama',$request->nama)
        ->first();
        if($datas!=null){
            $status=true;
            $msg="Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);

    }
    public function deteksi_lihat(siswa $siswa,Request $request)
    {
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $id=$pengguna->sekolah_id;

        $getdatadeteksi=apiprobk_deteksi::where('apiprobk_id',$siswa->apiprobk_id)->get();
        foreach($getdatadeteksi as $item){
            $datas[$item->kunci]=$item->isi;
        }
        $deteksi_list=apiprobk_deteksi_list::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='bk-hasilpsikologi';
            $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
            $masterdeteksi=masterdeteksi::get();
        return view('pages.bk.hasilpsikologi.deteksi',compact('pages','id','datas','deteksi_list','datasiswa','masterdeteksi'));
    }
    public function deteksi_cetak(Request $request)
    {
        dd('cetak deteksi',json_decode($request->data),$request);
    }
    public function sertifikat_lihat(siswa $siswa,Request $request)
    {
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $id=$pengguna->sekolah_id;
        $getdatasertifikat=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        $pages='bk-hasilpsikologi';
        $datasiswa=siswa::with('sekolah')->where('id',$siswa->id)->first();
        $kelas=$datasiswa->kelas->nama;
        $filterkelas=Fungsi::filterkelas($kelas);
        $iskelas9='bukan';
        if(strpos($kelas,9) !== false || strpos($kelas,"IX") !== false){
            $iskelas9='ya';
         }
         $id=sekolah::where('id',$id)->first();
        // return view('pages.bk.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','filterkelas','datasiswa','iskelas9'));
        return view('pages.admin.sekolah.pages.hasilpsikologi.sertifikat',compact('pages','id','getdatasertifikat','filterkelas','datasiswa','iskelas9'));
    }
    public function sertifikat_lihatapi(sekolah $id,siswa $siswa,Request $request)
    {
        $datas=null;
        $status=false;
        $msg="Data gagal di muat!";

        $datas=apiprobk_sertifikat::where('apiprobk_id',$siswa->apiprobk_id)->get();
        if($datas!=null){
            $status=true;
            $msg="Ambil data berhasil";
        }

        return response()->json([
            'success' => $status,
            'message' => $msg,
            'data' => $datas,
        ], 200);

    }
    public function sertifikat_cetak(Request $request)
    {
        dd('cetak Sertifikat');
    }
}
