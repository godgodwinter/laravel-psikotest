<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importanggota implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $data)
    {
        $datas=DB::table('anggota')
        ->where('nomeridentitas',$data['nomeridentitas'])
        ->count();
    
    if ($datas<1) {

       DB::table('anggota')->insert(
        array(
                'nama' => $data['nama'],
                'nomeridentitas' => $data['nomeridentitas'],
                'agama' => $data['agama'],
                'tempatlahir' => $data['tempatlahir'],
                'tgllahir' => $data['tgllahir'],
                'alamat' => $data['alamat'],
                'jk' => $data['jk'],
                'tipe' => $data['tipe'],
                'sekolahasal' => $data['sekolahasal'],
                'telp' => $data['telp'],
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
