<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
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



    public function collection(Collection $rows)
    {
        dd($rows);
        foreach ($rows as $row) 
        {
                dd($row);
        }
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
