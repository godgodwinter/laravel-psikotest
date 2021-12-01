<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminyayasandetailcontroller extends Controller
{
    protected $yayasanid;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(yayasan $yayasan,Request $request)
    {
        $pages='yayasan';

        $datas = yayasandetail::with('sekolah')->
        where('yayasan_id',$yayasan->id)
        ->orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasandetail.index',compact('pages','yayasan','request','datas'));
    }
    public function create(yayasan $yayasan)
    {
        $this->yayasanid=$yayasan->id;
        $pages='yayasan';
        $sekolah=sekolah::whereNotIn('id',function($query){
            $query->select('sekolah_id')->from('yayasandetail')->where('yayasan_id',$this->yayasanid)->where('deleted_at',null);
        })->get();

        return view('pages.admin.yayasandetail.create',compact('pages','yayasan','sekolah'));
    }

    public function store(yayasan $yayasan,Request $request)
    {
        // dd($request);
        $cek=yayasandetail::where('yayasan_id',$yayasan->id)
        ->where('sekolah_id',$request->sekolah_id)
        ->count();
        // dd($cek);
            if($cek>0){
                return redirect()->back()->with('status','Sekolah sudah tambahkan!')->with('tipe','warning')->with('icon','fas fa-feather');
            }
            $request->validate([
                'sekolah_id'=>'required',

            ],
            [
                'sekolah_id.required'=>'Nama harus diisi',
            ]);


        //inser yayasandetail
        DB::table('yayasandetail')->insert(
            array(
                   'sekolah_id'     =>   $request->sekolah_id,
                   'yayasan_id'     =>   $yayasan->id,
                   'status'     =>   'Aktif',
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

    return redirect()->route('yayasandetail',$yayasan->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(yayasan $yayasan,yayasandetail $data)
    {
        $pages='yayasan';
        $sekolah=sekolah::get();

        return view('pages.admin.yayasandetail.edit',compact('pages','yayasan','sekolah','data'));
    }
    public function update(yayasan $yayasan,yayasandetail $data,Request $request)
    {



        $request->validate([
            'sekolah_id'=>'required',
        ],
        [
            'sekolah_id.required'=>'sekolah_id sudah digunakan',
        ]);

        yayasandetail::where('id',$data->id)
        ->update([
            'sekolah_id'     =>   $request->sekolah_id,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
    return redirect()->route('yayasandetail',$yayasan->id)->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(yayasan $yayasan,yayasandetail $data){

        yayasandetail::destroy($data->id);
        return redirect()->route('yayasandetail',$yayasan->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function cari(yayasan $yayasan,Request $request)
    {


        $cari=$request->cari;
        #WAJIB
        $pages='yayasan';
        $datas = yayasandetail::with('waliyayasandetail')
        ->where('yayasan_id',$yayasan->id)
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        // $datas = yayasandetail::with('sekolah')->
        // where('yayasan_id',$yayasan->id)
        // ->orderBy('id','asc')
        // ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasandetail.index',compact('pages','yayasan','request','datas'));
    }

    public function multidel(yayasan $yayasan,Request $request)
    {

        $ids=$request->ids;
        yayasandetail::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='yayasan';

        $datas = yayasandetail::with('sekolah')->
        where('yayasan_id',$yayasan->id)
        ->orderBy('id','asc')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.yayasandetail.index',compact('pages','yayasan','request','datas'));
    }
}
