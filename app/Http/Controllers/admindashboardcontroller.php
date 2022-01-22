<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\pengguna;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\User;
use App\Models\yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function yayasan(){
        // dd("re");
        $pages='dashboard';
        $data=yayasan::where('users_id',Auth::user()->id)->first();
        return view('pages.admin.dashboard.yayasan',compact('pages','data'));
    }
    public function yayasanstore(Request $request)
    {


        $data=yayasan::where('users_id',Auth::user()->id)->first();
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            // 'username'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);


        if($request->password!=null OR $request->password!=''){

        $request->validate([
            'password' => 'min:6|required_with:password2|same:password2',
            'password2' => 'min:6',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);
            User::where('id',$data->users_id)
            ->update([
                'name'     =>   $request->nama,
                'email'     =>   $request->email,
                'password' => Hash::make($request->password),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }else{
            User::where('id',$data->users_id)
            ->update([
                'name'     =>   $request->nama,
                'email'     =>   $request->email,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

        yayasan::where('id',$data->id)
        ->update([
            'nama'     =>   $request->nama,
            'kepala'     =>   $request->kepala,
            'telp'     =>   $request->telp,
            'alamat'     =>   $request->alamat,
            // 'status'     =>   $request->status,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        $id=$data;
        $imagesDir=public_path().'/storage';

        $yayasan_id=$data->id;
        $files = $request->file('yayasan_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->yayasan_photo)AND($id->yayasan_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->yayasan_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->yayasan_photo);
            $file = $request->file('yayasan_photo');
            $tujuan_upload = 'storage/yayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'yayasan_photo' => "yayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }


        $files = $request->file('kepala_photo');
        if($files!=null){

            if (file_exists( public_path().'/storage'.'/'.$id->kepala_photo)AND($id->kepala_photo!=null)){
                chmod($imagesDir, 0777);
                $image_path = public_path().'/storage'.'/'.$id->kepala_photo;
                unlink($image_path);
            }
            // dd('storage'.'/'.$id->kepala_photo);
            $file = $request->file('kepala_photo');
            $tujuan_upload = 'storage/kepalayayasan';
            // upload file
            $file->move($tujuan_upload,$yayasan_id.".jpg");
            yayasan::where('id',$yayasan_id)
            ->update([
                'kepala_photo' => "kepalayayasan/".$yayasan_id.".jpg",
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

    return redirect()->back()->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
}
