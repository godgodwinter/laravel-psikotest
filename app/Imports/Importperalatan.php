<?php

namespace App\Imports;

use App\Models\pemasukan;
use App\Models\peralatan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Importperalatan implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $data)
    {
        $datas=DB::table('peralatan')
        ->where('nama',$data['nama'])
        ->where('tgl_masuk',$data['tgl_masuk'])
        ->where('kondisi',$data['kondisi'])
        ->count();
        // $isnumber=is_numeric($var_num);
    
    if ($datas<1) {

       DB::table('peralatan')->insert(
        array(
                'nama' => $data['nama'],
                'tgl_masuk' => $data['tgl_masuk'], 
                'kategori_nama' => $data['kategori_nama'], 
                'kondisi' => $data['kondisi'], 
                'created_at' => $data['created_at'], 
                'updated_at' => $data['updated_at'], 
        ));
        }else{

        peralatan::where('nama',$data['nama'])
        ->where('tgl_masuk',$data['tgl_masuk'])
        ->where('kondisi',$data['kondisi'])
        ->update([
            'tgl_masuk' => $data['tgl_masuk'], 
            'kategori_nama' => $data['kategori_nama'], 
            'kondisi' => $data['kondisi'], 
            'created_at' => $data['created_at'], 
            'updated_at' => $data['updated_at'], 
        ]);

        }



         
    }

        
}
