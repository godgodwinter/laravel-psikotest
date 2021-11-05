<?php

namespace App\Imports;

use App\Helpers\Fungsi;
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

class importdetailsekolah implements ToCollection,WithCalculatedFormulas
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

    $ceknamakelas=DB::table('kelas')->where('nama',$row[1])->where('sekolah_id',$sekolah_id)->count();
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

        DB::table('kelas')->insert(
            array(
                'nama'     =>  $row[1],
                'sekolah_id'     =>   $sekolah_id,
                'walikelas_id'     =>   null,
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }

    $ambilkelas=kelas::where('nama',$row[1])->where('sekolah_id',$sekolah_id)->first();
    $ambilkelas_id=$ambilkelas->id;

    // dd($ambilkelas_id);


                // dd('testing',$row[1],$sekolah_id,$ceknamakelas);
                // $cek
                // 2 nomerinduk

    $ceksiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->count();
    if($ceksiswa>0){
        $ambilsiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->first();

        // updaTe
        siswa::where('id',$ambilsiswa->id)
        ->update(
            [
                'nama'=>$row[3],
                'sekolah_id'     =>   $sekolah_id,
                'kelas_id'     =>   $ambilkelas_id,
                    'deleted_at'=>null,
                    'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]);
            // siswa::where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)
            // ->update([
            //     'nama'     =>   $row[3],
            //     'sekolah_id'     =>   $sekolah_id,
            // //     'deleted_at'=>null,
            // //     'created_at'=>date("Y-m-d H:i:s"),
            // // 'updated_at'=>date("Y-m-d H:i:s")
            // ]);

    }else{

        DB::table('siswa')->insert(
            array(
                'nama'     =>  $row[3],
                'sekolah_id'     =>   $sekolah_id,
                'nomerinduk'     =>   $row[2],
                'kelas_id'     =>   $ambilkelas_id,
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }

    // INPUTNILAIPSIKOLOGI
    // dd($sekolah_id,'KB',$row[2],$row[6]);

    Fungsi::inputnilaipsikologis($sekolah_id,'KBH%',$row[2],$row[6]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KBH',$row[2],$row[7]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LMH%',$row[2],$row[8]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LMH',$row[2],$row[9]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KSH%',$row[2],$row[10]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KSH',$row[2],$row[11]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KMH%',$row[2],$row[12]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KMH',$row[2],$row[13]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KKH%',$row[2],$row[14]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KKH',$row[2],$row[15]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KIH%',$row[2],$row[16]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KIH',$row[2],$row[17]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KAH%',$row[2],$row[18]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KAH',$row[2],$row[19]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KNH%',$row[2],$row[20]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KNH',$row[2],$row[21]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQ',$row[2],$row[22]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQ.%',$row[2],$row[23]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQH',$row[2],$row[24]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EQ%',$row[2],$row[25]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EQ.KET',$row[2],$row[26]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SQ%',$row[2],$row[27]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SQ.KET',$row[2],$row[28]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SC.Q%',$row[2],$row[29]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SC.Q.KET',$row[2],$row[30]);
    Fungsi::inputnilaipsikologis($sekolah_id,'APLUS%',$row[2],$row[31]);
    Fungsi::inputnilaipsikologis($sekolah_id,'APLUSKET',$row[2],$row[32]);
    Fungsi::inputnilaipsikologis($sekolah_id,'AMINUS%',$row[2],$row[33]);
    Fungsi::inputnilaipsikologis($sekolah_id,'AMINUSKET',$row[2],$row[34]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CPLUS%',$row[2],$row[35]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CPLUSKET',$row[2],$row[36]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CMINUS%',$row[2],$row[37]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CMINUSKET',$row[2],$row[38]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DPLUS%',$row[2],$row[39]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DPLUSKET',$row[2],$row[40]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DMINUS%',$row[2],$row[41]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DMINUSKET',$row[2],$row[42]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EPLUS%',$row[2],$row[43]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EPLUSKET',$row[2],$row[44]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EMINUS%',$row[2],$row[45]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EMINUSKET',$row[2],$row[46]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FPLUS%',$row[2],$row[47]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FPLUSKET',$row[2],$row[48]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FMINUS%',$row[2],$row[49]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FMINUSKET',$row[2],$row[50]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GPLUS%',$row[2],$row[51]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GPLUSKET',$row[2],$row[52]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GMINUS%',$row[2],$row[53]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GMINUSKET',$row[2],$row[54]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HPLUS%',$row[2],$row[55]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HPLUSKET',$row[2],$row[56]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HMINUS%',$row[2],$row[57]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HMINUSKET',$row[2],$row[58]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IPLUS%',$row[2],$row[59]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IPLUSKET',$row[2],$row[60]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IMINUS%',$row[2],$row[61]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IMINUSKET',$row[2],$row[62]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JPLUS%',$row[2],$row[63]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JPLUSKET',$row[2],$row[64]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JMINUS%',$row[2],$row[65]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JMINUSKET',$row[2],$row[66]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OPLUS%',$row[2],$row[67]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OPLUSKET',$row[2],$row[68]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OMINUS%',$row[2],$row[69]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OMINUSKET',$row[2],$row[70]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2PLUS%',$row[2],$row[71]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2PLUSKET',$row[2],$row[72]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2MINUS%',$row[2],$row[73]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2MINUSKET',$row[2],$row[74]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3PLUS%',$row[2],$row[75]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3PLUSKET',$row[2],$row[76]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3MINUS%',$row[2],$row[77]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3MINUSKET',$row[2],$row[78]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4PLUS%',$row[2],$row[79]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4PLUSKET',$row[2],$row[80]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4MINUS%',$row[2],$row[81]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4MINUSKET',$row[2],$row[82]);


    Fungsi::inputnilaipsikologis($sekolah_id,'A.Keprib. Terkuat.Rk..1',$row[2],$row[83]);
    Fungsi::inputnilaipsikologis($sekolah_id,'A.Keprib. Terkuat.Rk..2',$row[2],$row[84]);
    Fungsi::inputnilaipsikologis($sekolah_id,'A.Keprib. Terkuat.Rk..3',$row[2],$row[85]);
    Fungsi::inputnilaipsikologis($sekolah_id,'A.Keprib. Terkuat.Rk..4',$row[2],$row[86]);
    Fungsi::inputnilaipsikologis($sekolah_id,'A.Keprib. Terkuat.Rk..5',$row[2],$row[87]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Positif.rank.1',$row[2],$row[88]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Positif.rank.2',$row[2],$row[89]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Positif.rank.3',$row[2],$row[90]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Positif.rank.4',$row[2],$row[91]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Positif.rank.5',$row[2],$row[92]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Negatif.rank.1',$row[2],$row[93]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Negatif.rank.2',$row[2],$row[94]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Negatif.rank.3',$row[2],$row[95]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Negatif.rank.4',$row[2],$row[96]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Negatif.rank.5',$row[2],$row[97]);
    Fungsi::inputnilaipsikologis($sekolah_id,'M1%',$row[2],$row[98]);
    Fungsi::inputnilaipsikologis($sekolah_id,'M2%',$row[2],$row[99]);
    Fungsi::inputnilaipsikologis($sekolah_id,'M3%',$row[2],$row[100]);


    Fungsi::inputminatbakat($sekolah_id,'CITA.1/Minat.1',$row[2],$row[101]);
    Fungsi::inputminatbakat($sekolah_id,'Tipe Bakat.1',$row[2],$row[102]);
    Fungsi::inputminatbakat($sekolah_id,'CITA.2/Minat.2',$row[2],$row[103]);
    Fungsi::inputminatbakat($sekolah_id,'Tipe Bakat.2',$row[2],$row[104]);
    Fungsi::inputminatbakat($sekolah_id,'CITA.3/Minat.3',$row[2],$row[105]);
    Fungsi::inputminatbakat($sekolah_id,'Tipe Bakat.3',$row[2],$row[106]);
    Fungsi::inputminatbakat($sekolah_id,'Tambahan CITA_CITA_1',$row[2],$row[107]);
    Fungsi::inputminatbakat($sekolah_id,'Tambahan CITA_CITA_2',$row[2],$row[108]);
    Fungsi::inputminatbakat($sekolah_id,'Tambahan CITA_CITA_3',$row[2],$row[109]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMP',$row[2],$row[110]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMA_SMK_1_FAKULTAS',$row[2],$row[111]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMA_SMK_1_PRODI',$row[2],$row[112]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMA_SMK_2_FAKULTAS',$row[2],$row[113]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMA_SMK_2_PRODI',$row[2],$row[114]);
    Fungsi::inputminatbakat($sekolah_id,'STUDI_LANJUT_SMA_SMK_KEDINASAN',$row[2],$row[115]);
    Fungsi::inputminatbakat($sekolah_id,'JURUSAN_LANJUT_SMA/MA',$row[2],$row[116]);
    Fungsi::inputminatbakat($sekolah_id,'JURUSAN_LANJUT_SMK1',$row[2],$row[117]);
    Fungsi::inputminatbakat($sekolah_id,'JURUSAN_LANJUT_SMK2',$row[2],$row[118]);
    Fungsi::inputminatbakat($sekolah_id,'JURUSAN_LANJUT_SMK3',$row[2],$row[119]);
    Fungsi::inputminatbakat($sekolah_id,'Disarankan studi SMA/MA/SMK',$row[2],$row[120]);
    Fungsi::inputminatbakat($sekolah_id,'Jurusan SMA/MA',$row[2],$row[121]);
    Fungsi::inputminatbakat($sekolah_id,'Jur SMK(BK/Bidg keahlian)',$row[2],$row[122]);
    Fungsi::inputminatbakat($sekolah_id,'SMK (PK/Program keahlian)',$row[2],$row[123]);
    Fungsi::inputminatbakat($sekolah_id,'Jur.Disarankan SMA/MA',$row[2],$row[124]);
    Fungsi::inputminatbakat($sekolah_id,'Jur.Dipertimbangkan SMA/MA',$row[2],$row[125]);
    Fungsi::inputminatbakat($sekolah_id,'Jur.Tdk.Disarankan SMA/MA',$row[2],$row[126]);
    Fungsi::inputminatbakat($sekolah_id,'D / S.1 Disarankan Fakultas',$row[2],$row[127]);
    Fungsi::inputminatbakat($sekolah_id,'D / S.1 Disarankan Prodi',$row[2],$row[128]);

    // // 1.ambil id master where KBH%
    // $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KBH%')->first();
    // $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->first();

    // $cekdatanilai=DB::table('inputnilaipsikologi')
    // ->where('masternilaipsikologi_id',$ambil_idmaster->id)
    // ->where('siswa_id',$ambil_idsiswa->id)
    // ->where('sekolah_id',$sekolah_id)->count();

    // if($cekdatanilai>0){
    //     // updaTe
    //         inputnilaipsikologi::where('masternilaipsikologi_id',$ambil_idmaster->id)
    //         ->where('siswa_id',$ambil_idsiswa->id)
    //         ->where('sekolah_id',$sekolah_id)
    //         ->update([
    //             'nilai'     =>   $row[6],
    //             'deleted_at'=>null,
    //             'created_at'=>date("Y-m-d H:i:s"),
    //         'updated_at'=>date("Y-m-d H:i:s")
    //         ]);

    // }else{

    //     DB::table('inputnilaipsikologi')->insert(
    //         array(
    //             'siswa_id'     =>  $ambil_idsiswa->id,
    //             'masternilaipsikologi_id'     =>  $ambil_idmaster->id,
    //             'nilai'     =>   $row[6],
    //             'deleted_at' => null,
    //             'sekolah_id'     =>   $sekolah_id,
    //             'created_at'=>date("Y-m-d H:i:s"),
    //             'updated_at'=>date("Y-m-d H:i:s")
    //         ));

    // }

    // 1.ambil id master where KBH
    // $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KBH')->first();
    // $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->first();

    // $cekdatanilai=DB::table('inputnilaipsikologi')
    // ->where('masternilaipsikologi_id',$ambil_idmaster->id)
    // ->where('siswa_id',$ambil_idsiswa->id)
    // ->where('sekolah_id',$sekolah_id)->count();

    // if($cekdatanilai>0){
    //     // updaTe
    //         inputnilaipsikologi::where('masternilaipsikologi_id',$ambil_idmaster->id)
    //         ->where('siswa_id',$ambil_idsiswa->id)
    //         ->where('sekolah_id',$sekolah_id)
    //         ->update([
    //             'nilai'     =>   $row[7],
    //             'deleted_at'=>null,
    //             'created_at'=>date("Y-m-d H:i:s"),
    //         'updated_at'=>date("Y-m-d H:i:s")
    //         ]);

    // }else{

    //     DB::table('inputnilaipsikologi')->insert(
    //         array(
    //             'siswa_id'     =>  $ambil_idsiswa->id,
    //             'masternilaipsikologi_id'     =>  $ambil_idmaster->id,
    //             'nilai'     =>   $row[7],
    //             'deleted_at' => null,
    //             'sekolah_id'     =>   $sekolah_id,
    //             'created_at'=>date("Y-m-d H:i:s"),
    //             'updated_at'=>date("Y-m-d H:i:s")
    //         ));

    // }


}
}
$no++;

    }

}

}
