<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\katabijak;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class katabijakcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'admin' && Auth::user()->tipeuser != 'yayasan' && Auth::user()->tipeuser != 'bk'  && Auth::user()->tipeuser != 'siswa'  && Auth::user()->tipeuser != 'owner') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }

    //katabijak
    public function index(Request $request)
    {
        $pages = 'katabijak';

        $datas = katabijak::whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('katabijak.index', compact('pages', 'request', 'datas'));
    }
    public function cari(Request $request)
    {
        if ($this->checkauth('admin') === '404') {
            return redirect(URL::to('/') . '/404')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger')->with('icon', 'fas fa-trash');
        }
        //dd($request);
        $cari = $request->cari;
        #WAJIB

        $pages = 'katabijak';
        $datas = katabijak::whereNull('deleted_at')
            ->where('judul', 'like', "%" . $cari . "%")
            ->paginate(Fungsi::paginationjml());


        return view('katabijak.index', compact('pages', 'request', 'datas'));
    }

    public function create()
    {
        $pages = 'katabijak';


        $kelas = katabijak::whereNull('deleted_at')

            ->get();
        return view('katabijak.create', compact('pages', 'kelas'));
    }

    public function store(Request $request)
    {
        // dd($id,$request);

        $cek = katabijak::whereNull('deleted_at')->where('judul', $request->judul)

            ->orderBy('judul', 'asc')
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
            [
                'judul' => 'required',


            ],
            [
                'judul.judul' => 'Judul harus diisi',
            ]
        );


        //inser siswa
        DB::table('katabijak')->insert(
            array(
                'judul'     =>   $request->judul,
                'status'     =>   $request->status,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            )
        );

        return redirect()->route('katabijak')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(katabijak $data)
    {
        $pages = 'katabijak';

        $data = katabijak::where('id', $data->id)->first();
        // dd($data->kelas->nama);



        return view('katabijak.edit', compact('pages', 'data'));
    }
    public function update(katabijak $data, Request $request)
    {

        if ($request->judul !== $data->judul) {

            $request->validate(
                [
                    'judul' => "required|unique:katabijak,judul," . $request->judul,
                ],
                [
                    'judul.unique' => 'Judul sudah digunakan',
                ]
            );
        }


        $request->validate(
            [
                'judul' => 'required',
                //'nomerinduk'=>'required',
            ],
            [
                'judul.required' => 'judul harus diisi',
                //'nomerinduk.required'=>'nomerinduk harus diisi',
            ]
        );

        katabijak::where('id', $data->id)
            ->update([
                'judul'     =>   $request->judul,

                'status'     =>   $request->status,
                'updated_at' => date("Y-m-d H:i:s")

            ]);
        return redirect()->route('katabijak', $data->id)->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }


    public function destroy(katabijak $data)
    {

        katabijak::destroy($data->id);
        return redirect()->route('katabijak')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        katabijak::whereIn('id', $ids)->delete();


        // load ulang
        #WAJIB
        $pages = 'katabijak';

        $datas = katabijak::whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('katabijak.index', compact('pages', 'request', 'datas'));
    }




    // ----------------------------------------------------------------------------------------------------------



}
