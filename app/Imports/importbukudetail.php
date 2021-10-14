<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importbukudetail implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $data)
    {
    //     $datas=DB::table('bukudetail')
    //     ->where('created_at',$data['created_at'])
    //     ->where('status',$data['status'])
    //     ->where('kondisi',$data['kondisi'])
    //     ->where('buku_kode',$data['buku_kode'])
    //     ->where('buku_nama',$data['buku_nama'])
    //     ->count();
    
    // if ($datas<1) {

       DB::table('bukudetail')->insert(
        array(
                'buku_kode' => $data['buku_kode'],
                'buku_isbn' => $data['buku_isbn'],
                'buku_nama' => $data['buku_nama'],
                'buku_pengarang' => $data['buku_pengarang'],
                'buku_tempatterbit' => $data['buku_tempatterbit'],
                'buku_penerbit' => $data['buku_penerbit'],
                'buku_tahunterbit' => $data['buku_tahunterbit'],
                'buku_bahasa' => $data['buku_bahasa'],
                'bukukategori_nama' => $data['bukukategori_nama'],
                'bukukategori_ddc' => $data['bukukategori_ddc'],
                'kondisi' => $data['kondisi'], 
                'status' => $data['status'], 
                'created_at' => $data['created_at'], 
                'updated_at' => $data['updated_at'], 
        ));
        // }else{

        // // kelas::where('nama',$data['nama'])
        // // ->where('kelas_nama',$data['kelas_nama'])
        // // ->update([
        // //     'nominaltagihan' => $nominal, 
        // //     'created_at' => $data['created_at'], 
        // //     'updated_at' => $data['updated_at'], 
        // // ]);

        // }



         
    }

        
}
