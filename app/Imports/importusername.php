<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
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

class importusername implements ToCollection, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection(Collection $rows, $calculateFormulas = false)
    {
        // $rows->calculate(false);
        ini_set('max_execution_time', 3000);
        $sekolah_id = $this->id;
        // DB::table('sekolah')->insert(
        //     array(
        //         'nama'     =>  'test123',
        //         'alamat'     =>  'zzz',
        //         'status'     =>  'aaa',
        //         'deleted_at' => null,
        //     ));
        // dd($rows);
        $no = 0;
        foreach ($rows as $row) {
            if ($no > 0) {
                // dd($row[0]);
                if (($row[0] != null) and ($row[0] != '')) {

                    $periksadata = apiprobk::where('username', $row[0])->count();
                    if ($periksadata > 0) {
                        // updaTe
                        // kelas::where('nama',$row[1])->where('sekolah_id',$sekolah_id)
                        // ->update([
                        //     'nama'     =>   $row[1],
                        //     'sekolah_id'     =>   $sekolah_id,
                        //     'deleted_at'=>null,
                        //     'created_at'=>date("Y-m-d H:i:s"),
                        // 'updated_at'=>date("Y-m-d H:i:s")
                        // ]);

                    } else {

                        DB::table('apiprobk')->insert(
                            array(
                                'username'     =>  $row[0],
                                'sertifikat'     =>   'belum',
                                'sertifikat_tgl'     =>   null,
                                'deteksi'     =>   'belum',
                                'deteksi_tgl'     =>   null,
                                'deleted_at' => null,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            )
                        );
                    }
                }
            }
            $no++;
        }
    }
}
