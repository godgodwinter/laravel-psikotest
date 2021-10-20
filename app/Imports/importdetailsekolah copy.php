<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importdetailsekolah implements ToModel
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

    public function model(array $rows)
    {
        $sekolah_id=$this->id;


        // DB::table('sekolah')->insert(
        //     array(
        //         'nama'     =>  'test123',
        //         'alamat'     =>  'zzz',
        //         'status'     =>  'aaa',
        //         'deleted_at' => null,
        //     ));

            // dd($rows,$sekolah_id);
        $no=0;
        dd($rows);
        foreach ($rows as $row)
        {
                $ceknamakelas=DB::table('kelas')->where('nama',$rows[1])->where('sekolah_id')->count();
                // dd($ceknamakelas,$rows[1],$row);
                if($ceknamakelas>0){
                    // updaTe
                        kelas::where('nama',$rows[1])->where('sekolah_id',$sekolah_id)
                        ->update([
                            'nama'     =>   $rows[1],
                            'sekolah_id'     =>   $sekolah_id,
                            'deleted_at'=>null,
                            'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                        ]);

                }else{
                    // dd('asd');

        DB::table('kelas')->insert(
            array(
                'nama'     =>  $rows[1],
                'sekolah_id'     =>   $sekolah_id,
                'walikelas_id'     =>   'asd',
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));


                    // kelas::create([
                    //     'nama'     =>  '1232',
                    //     'sekolah_id'     =>   $sekolah_id,
                    //     'walikelas_id'     =>   'asd',
                    //     'deleted_at' => null,
                    //     'created_at'=>date("Y-m-d H:i:s"),
                    //     'updated_at'=>date("Y-m-d H:i:s")
                    // ]);

                }
                // dd('testing',$row[1],$sekolah_id,$ceknamakelas);
                // $cek
                // 2 nomerinduk
                // 3 nama
                // 4 jk
                // 5 umur
    }
}

}
