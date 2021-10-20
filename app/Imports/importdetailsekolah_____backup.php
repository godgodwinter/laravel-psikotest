<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
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

        $cek=DB::table('kelas')->count();

        $insert=DB::table('kelas')->insert(
            array(
                'nama'     =>  'Kukuh Setya Nugraha',
                'sekolah_id'     =>   '4',
                'walikelas_id'     =>   '21',
                // 'deleted_at' => null,
                'created_at'=>'2021-10-20 08:36:08',
                'updated_at'=>'2021-10-20 08:36:08'
            ));


        dd($insert,$cek,'ads',$rows,$sekolah_id);
        // dd($this->id,$rows);
        // kelas::create([
        //     'nama'     =>  '1232',
        //     'sekolah_id'     =>   '4',
        //     'walikelas_id'     =>   '1',
        //     'deleted_at' => null,
        //     'created_at'=>date("Y-m-d H:i:s"),
        //     'updated_at'=>date("Y-m-d H:i:s")
        // ]);

        // dd('asd',$sekolah_id);

        DB::table('kelas')->insert(
            array(
                'nama'     =>  '123',
                'sekolah_id'     =>   $sekolah_id,
                'walikelas_id'     =>   'asd',
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));


        $no=0;
        foreach ($rows as $row)
        {


            if($no>0){

                // dd($row[1]);
                // 1 nama kelas
                $ceknamakelas=DB::table('kelas')->where('nama',$row[1])->where('sekolah_id')->count();
                // dd($ceknamakelas);
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
                    // dd('asd');

                    DB::table('kelas')->insert(
                        array(
                            'nama'     =>  '123',
                            'sekolah_id'     =>   $sekolah_id,
                            'walikelas_id'     =>   'asd',
                            'deleted_at' => null,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ));

                    kelas::create([
                        'nama'     =>  '1232',
                        'sekolah_id'     =>   $sekolah_id,
                        'walikelas_id'     =>   'asd',
                        'deleted_at' => null,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]);

                }
                // dd('testing',$row[1],$sekolah_id,$ceknamakelas);
                // $cek
                // 2 nomerinduk
                // 3 nama
                // 4 jk
                // 5 umur
            }
            $no++;
        }
        // DB::table('kelas')->insert(
        //     array(
        //         'nama'     =>  '123',
        //         'sekolah_id'     =>   $sekolah_id,
        //         'walikelas_id'     =>   'asd',
        //         'deleted_at' => null,
        //         'created_at'=>date("Y-m-d H:i:s"),
        //         'updated_at'=>date("Y-m-d H:i:s")
        //     ));
        dd('testetstes');
    }



    // public function model(array $data)
    // {
    //     dd($data['nama']);

    // //     $datas=DB::table('sekolah')
    // //     ->where('nama',$data['nama'])
    // //     ->count();

    // //     $is_deleted=DB::table('sekolah')->whereNotNull('deleted_at')
    // //     ->where('nama',$data['nama'])
    // //     ->count();

    // // if($is_deleted>0){

    // //     $is_deleted=sekolah::withTrashed()
    // //     ->where('nama',$data['nama'])
    // //     ->restore();
    // // }

    // // if ($datas<1) {

    // //     DB::table('sekolah')->insert(
    // //         array(
    // //             'nama'     =>  $data['nama'],
    // //             'alamat'     =>  $data['alamat'],
    // //             'status'     =>  $data['status'],
    // //             'deleted_at' => null,
    // //         ));
    // //     }else{

    // //         sekolah::where('nama',$data['nama'])
    // //         ->update([
    // //             'alamat'     =>  $data['alamat'],
    // //             'status'     =>  $data['status'],
    // //         ]);

    //     // }






    // }


}
