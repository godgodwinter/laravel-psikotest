<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\catatanpengembangandirisiswa;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class bkcatatanpengembangandirisiswacontroller extends Controller
{
    protected $cari;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'bk') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }

    public function index( Request $request)
    {
        $pages = 'bk-catatanpengembangandirisiswa';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;

        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
                        ->first();
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




                $periksadata=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();
        return view('pages.bk.catatanpengembangandirisiswa.index', compact('pages', 'request', 'datas','kelas','kelaspertama'));
    }
    public function detail(siswa $data, Request $request)
    {
        $pages = 'bk-catatanpengembangandirisiswa';

        $datas = catatanpengembangandirisiswa::with('siswa')
            ->where('siswa_id', $data->id)
            ->orderBy('tanggal', 'asc')
            ->paginate(Fungsi::paginationjml());
            // dd($datas);

        return view('pages.bk.catatanpengembangandirisiswa.detail', compact('pages', 'request', 'datas','data'));
    }

    public function cari( Request $request)
    {
        $pages = 'bk-catatanpengembangandirisiswa';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $this->cari=$request->kelas_id;
        $cari=null;
        $kelaspertama=kelas::where('sekolah_id',$sekolah_id)
                        ->first();
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




                $periksadata=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                ->count();


                // if($periksadata>0){
                //     $ambil=catatanpengembangandirisiswa::where('siswa_id',$d->id)
                //     ->first();
                //     $nilai=$ambil->nilai;
                // }else{
                //     $nilai=null;
                // }

            $dataakhir->push((object)[
                'id'=>$d->id,
                'nomerinduk'=>$d->nomerinduk,
                'nama'=>$d->nama,
                'siswa'=>$d,
                'jmldata'=>$periksadata,
            ]);
        }

        $datas=$dataakhir;
        $kelas=kelas::where('sekolah_id',$sekolah_id)->get();
        return view('pages.bk.catatanpengembangandirisiswa.index', compact('pages', 'request', 'datas','kelas','kelaspertama'));
    }
    public function caribackup( Request $request)
    {
        $cari = $request->cari;
        #WAJIB
        $pages = 'catatanpengembangandirisiswa';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $datas = catatanpengembangandirisiswa::with('siswa')
            ->where('sekolah_id', $sekolah_id)
            ->whereHas('siswa', function ($query) {
                global $request;
                $query->where('siswa.nama', 'like', "%" . $request->cari . "%");
            })
            ->orWhereHas('kelas', function ($query) {
                global $request;
                $query->where('kelas.nama', 'like', "%" . $request->cari . "%");
            })
            ->where('sekolah_id', $sekolah_id)
            ->orWhere('idedanimajinasi', 'like', "%" . $request->cari . "%")
            ->where('sekolah_id', $sekolah_id)
            ->paginate(Fungsi::paginationjml());
        // dd($datas,$cari);
        return view('pages.bk.catatanpengembangandirisiswa.index', compact('pages', 'request', 'datas'));
    }

    public function create( Request $request)
    {
        $pages = 'catatanpengembangandirisiswa';

        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $kelas = DB::table('kelas')->where('id', $sekolah_id)->get();
        $siswa = DB::table('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('nama', 'asc')->get();

            $ambildata=siswa::where('id',$request->siswa_id)->first();
        return view('pages.bk.catatanpengembangandirisiswa.create', compact('pages', 'siswa', 'kelas','request','ambildata'));
    }


    public function store( Request $request)
    {
        // dd($id,$request);
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $cek = DB::table('catatanpengembangandirisiswa')->whereNull('deleted_at')->where('id', $request->id)
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('nama', 'asc')
            ->count();
        // dd($cek);
        if ($cek > 0) {
            $request->validate(
                [
                    // 'nama'=>'required|unique:siswa,nama',
                    // 'nomerinduk'=>'required|unique:siswa,nomerinduk',

                ],
                [
                    // 'nomerinduk.unique'=>'Nomer Induk sudah digunakan',
                ]
            );
        }

        $request->validate(
            [],
            [
                'nama.nama' => 'Nama harus diisi',
            ]
        );


        $ambilsiswa = siswa::where('id', $request->siswa_id)
        ->first();
        //inser siswa
        DB::table('catatanpengembangandirisiswa')->insert(
            array(
                'siswa_id'  =>$request->siswa_id,
                // 'kelas_id'  =>$request->kelas_id,
                'tanggal'    =>$request->tanggal,
                'idedanimajinasi'    =>$request->idedanimajinasi,
                'ketrampilan'    =>$request->ketrampilan,
                'kreatif'    =>$request->kreatif,
                'organisasi'    =>$request->organisasi,
                'kelanjutanstudi'    =>$request->kelanjutanstudi,
                'hobi'    =>$request->hobi,
                'citacita'    =>$request->citacita,
                'kemampuankhusus'    =>$request->kemampuankhusus,
                'keterangan'    =>$request->keterangan,
                'sekolah_id'    =>$sekolah_id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ));

        return redirect()->route('bk.catatanpengembangandirisiswa.cari', ['kelas_id'=>$ambilsiswa->kelas_id])->with('status', 'Data berhasil ditambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit( catatanpengembangandirisiswa $data)
    {
        $pages = 'bk-catatanpengembangandirisiswa';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $datas = catatanpengembangandirisiswa::with('siswa')->whereNull('deleted_at')
            ->where('id', $data->id)
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('siswa_id', 'asc')
            ->first();

        $kelas = DB::table('kelas')->where('id', $sekolah_id)->get();
        $siswa = DB::table('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('nama', 'asc')->get();

        return view('pages.bk.catatanpengembangandirisiswa.edit', compact('pages', 'datas', 'siswa', 'kelas', 'data'));
    }
    public function update( catatanpengembangandirisiswa $data, Request $request)
    {
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        // dd($request,$data);
        if ($request->id !== $data->id) {

            $request->validate(
                [],
                []
            );
        }


        $request->validate(
            [
                // 'nama'=>'required',
                //'nomerinduk'=>'required',
            ],
            [
                // 'nama.required'=>'nama harus diisi',
                //'nomerinduk.required'=>'nomerinduk harus diisi',
            ]
        );

        catatanpengembangandirisiswa::where('id',$data->id)
        ->update([
            'siswa_id'  =>$request->siswa_id,
            // 'kelas_id'  =>$request->kelas_id,
            'tanggal'    =>$request->tanggal,
                'idedanimajinasi'    =>$request->idedanimajinasi,
                'ketrampilan'    =>$request->ketrampilan,
                'kreatif'    =>$request->kreatif,
                'organisasi'    =>$request->organisasi,
                'kelanjutanstudi'    =>$request->kelanjutanstudi,
                'hobi'    =>$request->hobi,
                'citacita'    =>$request->citacita,
                'kemampuankhusus'    =>$request->kemampuankhusus,
                'keterangan'    =>$request->keterangan,
                'sekolah_id'    =>$sekolah_id,

            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('bk.catatanpengembangandirisiswa')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy( catatanpengembangandirisiswa $data)
    {

        catatanpengembangandirisiswa::destroy($data->id);
        return redirect()->route('bk.catatanpengembangandirisiswa')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }


    public function multidel( Request $request)
    {

        $ids = $request->ids;
        catatanpengembangandirisiswa::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'bk-catatanpengembangandirisiswa';
        $users_id=Auth::user()->id;
        $pengguna=DB::table('pengguna')->where('users_id',$users_id)->first();
        $sekolah_id=$pengguna->sekolah_id;
        $datas = catatanpengembangandirisiswa::with('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('pages.bk.catatanpengembangandirisiswa.index', compact('pages', 'request', 'datas'));
    }
    public function cetakpersiswa(catatanpengembangandirisiswa $data,Request $request){

        // $datas = catatanpengembangandirisiswa::with('siswa')->where('id',$data->id)
        // ->where('sekolah_id',$sekolah_id)
        // ->orderBy('siswa_id','asc')
        // ->get();
        $datas=$data;
        // dd($datas);
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.bk.catatanpengembangandirisiswa.cetakpersiswa',compact('datas'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }

}
