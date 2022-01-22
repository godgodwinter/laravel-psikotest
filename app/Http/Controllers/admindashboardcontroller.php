<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\pengguna;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admindashboardcontroller extends Controller
{
    public function index(){
        if(Auth::user()->tipeuser=='bk'){
            return redirect()->route('bk.beranda');

        }
        if(Auth::user()->tipeuser=='siswa'){
            return redirect()->route('dashboard.siswa');

        }
        if(Auth::user()->tipeuser=='yayasan'){
            return redirect()->route('dashboard.yayasan');

        }
        $jmlsekolah=sekolah::count();
        $jmlyayasan=yayasan::count();
        $jmlbk=sekolah::count();
        $pages='dashboard';
        return view('pages.admin.dashboard.index',compact('pages','jmlsekolah','jmlbk','jmlyayasan'));
    }

    public function siswa(){
        $pages='dashboard';
        $data=siswa::with('kelas')->where('users_id',Auth::user()->id)->first();
        $id=sekolah::where('id',$data->sekolah_id)->first();
        $kelas=kelas::where('sekolah_id',$data->sekolah_id)->first();
        // $id=$getdatasiswa
        return view('pages.admin.dashboard.siswa',compact('pages','id','data','kelas'));

    }
    public function siswastore(Request $request){
        $data=siswa::with('kelas')->where('users_id',Auth::user()->id)->first();
        if($request->nomerinduk!==$data->nomerinduk){

            $request->validate([
                'nama' => "required",
                // 'nomerinduk' => "required|unique:siswa,nomerinduk,".$request->nomerinduk,
            ],
            [
                // 'nomerinduk.unique'=>'Nomer induk sudah digunakan',
            ]);
        }


        $request->validate([
            'nama'=>'required',
            //'nomerinduk'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
            //'nomerinduk.required'=>'nomerinduk harus diisi',
        ]);


        siswa::where('id',$data->id)
        ->update([
            // 'nama'     =>   $request->nama,
            // 'nomerinduk'     =>   $request->nomerinduk,
            // 'sekolah_id'     =>   $request->sekolah_id,
           'updated_at'=>date("Y-m-d H:i:s"),
        //    'jeniskelamin'   =>   $request->jeniskelamin,
                   'tempatlahir'    =>   $request->tempatlahir,
                   'tanggallahir'   =>   $request->tanggallahir,
                   'usia'           =>   $request->usia,
                   'warganegara'    =>   $request->warganegara,
                   'agama'          =>   $request->agama,
                   'anak'           =>   $request->anak,
                   'kandung'        =>   $request->kandung,
                   'angkat'         =>   $request->angkat,
                   'tiri'           =>   $request->tiri,
                   'statusanak'     =>   $request->statusanak,
                   'bahasa'         =>   $request->bahasa,
                   'nohp'           =>   $request->nohp,
                   'tinggal'        =>   $request->tinggal,
                   'jarak'          =>   $request->jarak,
                   'goldar'         =>   $request->goldar,
                   'kelainan'       =>   $request->kelainan,
                   'tinggibadan'    =>   $request->tinggibadan,
                   'beratbadan'     =>   $request->beratbadan,
                   'tamatan'        =>   $request->tamatan,
                   'ijazah'         =>   $request->ijazah,
                   'lamabelajar'    =>   $request->lamabelajar,
                   'pindahan'       =>   $request->pindahan,
                   'alasan'         =>   $request->alasan,
                   'namaayah'       =>   $request->namaayah,
                   'tempatayah'     =>   $request->tempatayah,
                   'tanggallahirayah'=>   $request->tanggallahirayah,
                   'agamaayah'      =>   $request->agamaayah,
                   'warganegaraayah'=>   $request->warganegaraayah,
                   'pendidikanayah' =>   $request->pendidikanayah,
                   'pekerjaanayah'  =>   $request->pekerjaanayah,
                   'alamatayah'     =>   $request->alamatayah,
                   'nomorayah'      =>   $request->nomorayah,
                   'statusayah'     =>   $request->statusayah,
                   'namaibu'        =>   $request->namaibu,
                   'tempatibu'      =>   $request->tempatibu,
                   'tanggallahiribu'=>   $request->tanggallahiribu,
                   'agamaibu'       =>   $request->agamaibu,
                   'warganegaraibu' =>   $request->warganegaraibu,
                   'pendidikanibu'  =>   $request->pendidikanibu,
                   'pekerjaanibu'   =>   $request->pekerjaanibu,
                   'penghasilanibu' =>   $request->penghasilanibu,
                   'alamatibu'      =>   $request->alamatibu,
                   'nomoribu'       =>   $request->nomoribu,
                   'statusibu'      =>   $request->statusibu,
                   'namawali'       =>   $request->namawali,
                   'tempatwali'     =>   $request->tempatwali,
                   'tanggallahirwali'=>   $request->tanggallahirwali,
                   'agamawali'      =>   $request->agamawali,
                   'warganegarawali'=>   $request->warganegarawali,
                   'pendidikanwali' =>   $request->pendidikanwali,
                   'pekerjaanwali'  =>   $request->pekerjaanwali,
                   'penghasilanwali'=>   $request->penghasilanwali,
                   'alamatwali'     =>   $request->alamatwali,
                   'nomorwali'      =>   $request->nomorwali,
                   'statuswali'     =>   $request->statuswali,
                   'hobi'           =>   $request->hobi,
                   'organisasi'     =>   $request->organisasi,
                   'setelahlulus'   =>   $request->setelahlulus,
                //    'kelas_id'       =>   $request->kelas_id

        ]);
    return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');

    }
}
