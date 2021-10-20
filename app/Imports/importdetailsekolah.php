<?php

namespace App\Imports;

use App\Helpers\Fungsi;
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

}
$no++;

    }

}

}
