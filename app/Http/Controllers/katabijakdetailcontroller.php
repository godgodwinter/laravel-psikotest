<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\katabijak;
use App\Models\katabijakdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class katabijakdetailcontroller extends Controller
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

    ///katabijak DETAIL
    public function index(Request $request, katabijak $katas)
    {
        $pages = 'katabijak';

        $kata = katabijak::where('id', $katas->id)->first();

        $datas = katabijakdetail::where('katabijak_id', $katas->id)
            ->orderBy('id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('katabijak.index_detail', compact('pages', 'request', 'datas', 'katas', 'kata'));
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
        $datas = katabijakdetail::whereNull('deleted_at')
            ->where('judul', 'like', "%" . $cari . "%")
            ->paginate(Fungsi::paginationjml());


        return view('katabijak.index_detail', compact('pages', 'request', 'datas'));
    }

    public function create(katabijak $katas)
    {
        $pages = 'katabijak';


        $kelas = katabijak::whereNull('deleted_at')

            ->get();
        return view('katabijak.create_detail', compact('pages', 'kelas', 'katas'));
    }

    public function store(Request $request, katabijak $katas)
    {
        // dd($katas, $request);


        $request->validate(
            [
                'penjelasan' => 'required',


            ],
            [
                'penjelasan.required' => 'Penjelasan harus diisi',
            ]
        );


        //inser siswa
        DB::table('katabijakdetail')->insert(
            array(
                'penjelasan'     =>   $request->penjelasan,
                'katabijak_id'     =>   $katas->id,


                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            )
        );

        return redirect()->route('katabijakdetail', $katas->id)->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(katabijak $katas, katabijakdetail $data)
    {
        $pages = 'katabijak';

        $data = katabijakdetail::where('id', $data->id)->first();
        // dd($data->kelas->nama);



        return view('katabijak.edit_detail', compact('pages', 'data', 'katas'));
    }

    public function update(katabijak $katas, katabijakdetail $data, Request $request)
    {


        $request->validate(
            [
                'penjelasan' => 'required',
            ],
            [
                'penjelasan.required' => 'penjelasan harus diisi',
            ]
        );

        katabijakdetail::where('id', $data->id)
            ->update([
                'penjelasan'     =>   $request->penjelasan,


                'updated_at' => date("Y-m-d H:i:s")

            ]);
        return redirect()->route('katabijakdetail', $katas->id)->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }


    public function destroy(katabijak $katas, katabijakdetail $data)
    {

        katabijakdetail::destroy($data->id);
        return redirect()->route('katabijakdetail', $katas->id)->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(katabijak $katas,  Request $request)
    {

        $ids = $request->ids;
        katabijakdetail::whereIn('id', $ids)->delete();


        // load ulang
        $pages = 'katabijak';

        $kata = katabijak::where('id', $katas->id)->first();

        $datas = katabijakdetail::where('katabijak_id', $katas->id)
            ->orderBy('id', 'asc')
            ->paginate(Fungsi::paginationjml());

        return view('katabijak.index_detail', compact('pages', 'request', 'datas', 'katas', 'kata'));
    }
}
