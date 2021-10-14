<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importusers implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $data)
    {
        $datas=DB::table('users')
        ->where('username',$data['username'])
        ->count();
        if($data['tipeuser']=='admin'){
            $password=Fungsi::passdefaultadmin();
        }else{
            $password=Fungsi::passdefaultpegawai();
        }
    if ($datas<1) {

       DB::table('users')->insert(
        array(
            'name'     =>  $data['name'],
            'tipeuser'     =>   $data['tipeuser'],
            'username'     =>   $data['username'],
            'email'     =>   $data['email'],
            'password' => Hash::make($password),
            'nomerinduk'     =>   date('YmdHis'),
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
        ));
        }else{

        // kelas::where('nama',$data['nama'])
        // ->where('kelas_nama',$data['kelas_nama'])
        // ->update([
        //     'nominaltagihan' => $nominal,
        //     'created_at' => $data['created_at'],
        //     'updated_at' => $data['updated_at'],
        // ]);

        }




    }


}
