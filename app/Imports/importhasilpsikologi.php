<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\hasilpsikologi;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importhasilpsikologi implements ToCollection,WithCalculatedFormulas
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

    public function collection(Collection $rows, $calculateFormulas = false)
    {
        // $rows->calculate(false);
        ini_set('max_execution_time', 3000);
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
        if(($row[2]!=null) AND ($row[2]!='')){
            $ambilsiswa=siswa::where('nomerinduk',$row[1])->first();
            if($ambilsiswa!=null){
                $cekdatas=DB::table('hasilpsikologi')->where('siswa_id',$ambilsiswa->id)->where('sekolah_id',$this->id->id)->count();

    if($cekdatas>0){
        hasilpsikologi::withTrashed()->where('siswa_id',$ambilsiswa->id)->where('sekolah_id',$this->id->id)->restore();
        // updaTe
            hasilpsikologi::where('siswa_id',$ambilsiswa->id)->where('sekolah_id',$this->id->id)
            ->update([
                'nilai'     =>   $row[3],
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('hasilpsikologi')->insert(
            array(
                'siswa_id'     =>   $ambilsiswa->id,
                'nilai'     =>   $row[3],
                'sekolah_id'     =>   $this->id->id,
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }
            }


}
}
$no++;

    }

}

}
