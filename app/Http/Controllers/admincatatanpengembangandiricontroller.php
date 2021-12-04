<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\catatanpengembangandirisiswa;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class admincatatanpengembangandiricontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'admin') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }

    public function index(sekolah $id, Request $request)
    {
        $pages = 'catatanpengembangandiri';

        $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.catatanpengembangandiri.index', compact('pages', 'id', 'request', 'datas'));
    }
    public function cari(sekolah $id, Request $request)
    {
        $cari = $request->cari;
        #WAJIB
        $pages = 'catatanpengembangandirisiswa';

        $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')
            ->where('sekolah_id', $id->id)
            ->whereHas('siswa', function ($query) {
                global $request;
                $query->where('siswa.nama', 'like', "%" . $request->cari . "%");
            })
            ->orWhereHas('kelas', function ($query) {
                global $request;
                $query->where('kelas.nama', 'like', "%" . $request->cari . "%");
            })
            ->where('sekolah_id', $id->id)
            ->orWhere('idedanimajinasi', 'like', "%" . $request->cari . "%")
            ->where('sekolah_id', $id->id)
            ->paginate(Fungsi::paginationjml());
        // dd($datas,$cari);
        return view('pages.admin.sekolah.pages.catatanpengembangandiri.index', compact('pages', 'id', 'request', 'datas'));
    }

    public function create(sekolah $id)
    {
        $pages = 'catatanpengembangandirisiswa';
        $kelas = DB::table('kelas')->where('id', $id->id)->get();
        $siswa = DB::table('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('nama', 'asc')->get();

        return view('pages.admin.sekolah.pages.catatanpengembangandiri.create', compact('pages', 'id', 'siswa', 'kelas'));
    }


    public function store(sekolah $id, Request $request)
    {
        // dd($id,$request);
        $cek = DB::table('catatanpengembangandirisiswa')->whereNull('deleted_at')->where('id', $request->id)
            ->where('sekolah_id', $id->id)
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
                'sekolah_id'    =>$id->id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ));

        return redirect()->route('sekolah.catatanpengembangandiri', $id->id)->with('status', 'Data berhasil ditambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(sekolah $id, catatanpengembangandirisiswa $data)
    {
        $pages = 'catatanpengembangandirisiswa';
        $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
            ->where('id', $data->id)
            ->where('sekolah_id', $id->id)
            ->orderBy('siswa_id', 'asc')
            ->first();

        $kelas = DB::table('kelas')->where('id', $id->id)->get();
        $siswa = DB::table('siswa')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('nama', 'asc')->get();

        return view('pages.admin.sekolah.pages.catatanpengembangandiri.edit', compact('pages', 'datas', 'siswa', 'kelas', 'data', 'id'));
    }
    public function update(sekolah $id, catatanpengembangandirisiswa $data, Request $request)
    {

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
                'sekolah_id'    =>$id->id,

            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('sekolah.catatanpengembangandiri', $id->id)->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(sekolah $id, catatanpengembangandirisiswa $data)
    {

        catatanpengembangandirisiswa::destroy($data->id);
        return redirect()->route('sekolah.catatanpengembangandiri', $id->id)->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }


    public function multidel(sekolah $id, Request $request)
    {

        $ids = $request->ids;
        catatanpengembangandirisiswa::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'catatanpengembangandiri';

        $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('siswa_id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.sekolah.pages.catatanpengembangandiri.index', compact('pages', 'id', 'request', 'datas'));
    }
    public function cetakpersiswa(sekolah $id,catatanpengembangandirisiswa $data,Request $request){

        // $datas = catatanpengembangandirisiswa::with('siswa')->with('kelas')->where('id',$data->id)
        // ->where('sekolah_id',$id->id)
        // ->orderBy('siswa_id','asc')
        // ->get();
        $datas=$data;
        // dd($datas);
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.sekolah.pages.catatanpengembangandiri.cetakpersiswa',compact('datas'))->setPaper('a4', 'potrait');
        return $pdf->stream('catatan'.$tgl.'.pdf');
    }

}
