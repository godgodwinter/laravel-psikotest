<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importdetailsekolah implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $id;

    function __construct($id) {
           $this->id = $id;
    }

    public function collection(Collection $rows)
    {
        $sekolah_id=$this->id;
        // DB::table('sekolah')->insert(
        //     array(
        //         'nama'     =>  'test123',
        //         'alamat'     =>  'zzz',
        //         'status'     =>  'aaa',
        //         'deleted_at' => null,
        //     ));
        // dd($rows);
    $no=0;
    foreach($rows as $row){
    if($no>0){

    $ceknamakelas=DB::table('kelas')->where('nama',$row[1])->where('sekolah_id',$sekolah_id)->count();
    if($ceknamakelas>0){
        // updaTe
            kelas::where('nama',$row[1])->where('sekolah_id',$sekolah_id)
            ->update([
                'nama'     =>   $row[1],
                'sekolah_id'     =>   $sekolah_id,
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('kelas')->insert(
            array(
                'nama'     =>  $row[1],
                'sekolah_id'     =>   $sekolah_id,
                'walikelas_id'     =>   null,
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }


                // dd('testing',$row[1],$sekolah_id,$ceknamakelas);
                // $cek
                // 2 nomerinduk

    $ceksiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->count();
    if($ceksiswa>0){
        // updaTe
            siswa::where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)
            ->update([
                'nama'     =>   $row[3],
                'sekolah_id'     =>   $sekolah_id,
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('siswa')->insert(
            array(
                'nama'     =>  $row[3],
                'sekolah_id'     =>   $sekolah_id,
                'nomerinduk'     =>   $row[2],
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }

    // INPUTNILAIPSIKOLOGI
    // 1.ambil id master where KB
    $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KB')->first();
    $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->first();

    $cekdatanilai=DB::table('inputnilaipsikologi')
    ->where('masternilaipsikologi_id',$ambil_idmaster->id)
    ->where('siswa_id',$ambil_idsiswa->id)
    ->where('sekolah_id',$sekolah_id)->count();

    if($cekdatanilai>0){
        // updaTe
            inputnilaipsikologi::where('masternilaipsikologi_id',$ambil_idmaster->id)
            ->where('siswa_id',$ambil_idsiswa->id)
            ->where('sekolah_id',$sekolah_id)
            ->update([
                'nilai'     =>   $row[6],
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('inputnilaipsikologi')->insert(
            array(
                'siswa_id'     =>  $ambil_idsiswa->id,
                'masternilaipsikologi_id'     =>  $ambil_idmaster->id,
                'nilai'     =>   $row[6],
                'deleted_at' => null,
                'sekolah_id'     =>   $sekolah_id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }

    // 1.ambil id master where KB%
    $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KB%')->first();
    $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->first();

    $cekdatanilai=DB::table('inputnilaipsikologi')
    ->where('masternilaipsikologi_id',$ambil_idmaster->id)
    ->where('siswa_id',$ambil_idsiswa->id)
    ->where('sekolah_id',$sekolah_id)->count();

    if($cekdatanilai>0){
        // updaTe
            inputnilaipsikologi::where('masternilaipsikologi_id',$ambil_idmaster->id)
            ->where('siswa_id',$ambil_idsiswa->id)
            ->where('sekolah_id',$sekolah_id)
            ->update([
                'nilai'     =>   $row[7],
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('inputnilaipsikologi')->insert(
            array(
                'siswa_id'     =>  $ambil_idsiswa->id,
                'masternilaipsikologi_id'     =>  $ambil_idmaster->id,
                'nilai'     =>   $row[7],
                'deleted_at' => null,
                'sekolah_id'     =>   $sekolah_id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }


}
$no++;

    }

}

}
