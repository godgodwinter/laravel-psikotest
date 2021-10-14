<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Importbuku implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $data)
    {
        $datas=DB::table('buku')
        ->where('kode',$data['kode'])
        ->count();
    
    if ($datas<1) {

       DB::table('buku')->insert(
        array(
                'kode' => $data['kode'],
                'isbn' => $data['isbn'],
                'nama' => $data['nama'],
                'pengarang' => $data['pengarang'],
                'tempatterbit' => $data['tempatterbit'],
                'penerbit' => $data['penerbit'],
                'tahunterbit' => $data['tahunterbit'],
                'bahasa' => $data['bahasa'],
                'bukukategori_nama' => $data['bukukategori_nama'],
                'bukukategori_ddc' => $data['bukukategori_ddc'],
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
