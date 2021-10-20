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
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importdetailsekolah implements ToCollection
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

    public function collection(Collection $rows)
    {
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


                // dd('testing',$row[1],$sekolah_id,$ceknamakelas);
                // $cek
                // 2 nomerinduk

    $ceksiswa=DB::table('siswa')->where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)->count();
    if($ceksiswa>0){
        // updaTe
            siswa::where('nomerinduk',$row[2])->where('sekolah_id',$sekolah_id)
            ->update([
                'nama'     =>   $row[3],
                'sekolah_id'     =>   $sekolah_id,
                'deleted_at'=>null,
                'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
            ]);

    }else{

        DB::table('siswa')->insert(
            array(
                'nama'     =>  $row[3],
                'sekolah_id'     =>   $sekolah_id,
                'nomerinduk'     =>   $row[2],
                'deleted_at' => null,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ));

    }

    // INPUTNILAIPSIKOLOGI
    // dd($sekolah_id,'KB',$row[2],$row[6]);

    Fungsi::inputnilaipsikologis($sekolah_id,'KB',$row[2],$row[6]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KB%',$row[2],$row[7]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KBH',$row[2],$row[8]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LM',$row[2],$row[9]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LM%',$row[2],$row[10]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LMH',$row[2],$row[11]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KS',$row[2],$row[12]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KS%',$row[2],$row[13]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KM',$row[2],$row[14]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KM%',$row[2],$row[15]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KMH',$row[2],$row[16]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KK',$row[2],$row[17]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KK%',$row[2],$row[18]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KKH',$row[2],$row[19]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KI',$row[2],$row[20]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KI%',$row[2],$row[21]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KIH',$row[2],$row[22]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KA',$row[2],$row[23]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KA%',$row[2],$row[24]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KAH',$row[2],$row[25]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KN',$row[2],$row[26]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KN%',$row[2],$row[27]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KNH',$row[2],$row[28]);
    Fungsi::inputnilaipsikologis($sekolah_id,'TTL',$row[2],$row[29]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQ',$row[2],$row[30]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQ%',$row[2],$row[31]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQH',$row[2],$row[32]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EQ',$row[2],$row[33]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EQ%',$row[2],$row[34]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EQKET',$row[2],$row[35]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SQ%',$row[2],$row[36]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SQKET',$row[2],$row[37]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SCQ%',$row[2],$row[38]);
    Fungsi::inputnilaipsikologis($sekolah_id,'SCQ%KET',$row[2],$row[39]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KBH',$row[2],$row[40]);
    Fungsi::inputnilaipsikologis($sekolah_id,'LMH',$row[2],$row[41]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KSH',$row[2],$row[42]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KMH',$row[2],$row[43]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KKH',$row[2],$row[44]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KIH',$row[2],$row[45]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KAH',$row[2],$row[46]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KNH',$row[2],$row[47]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IQH',$row[2],$row[48]);
    Fungsi::inputnilaipsikologis($sekolah_id,'P1',$row[2],$row[49]);
    Fungsi::inputnilaipsikologis($sekolah_id,'P9',$row[2],$row[50]);
    Fungsi::inputnilaipsikologis($sekolah_id,'KR',$row[2],$row[51]);
    Fungsi::inputnilaipsikologis($sekolah_id,'A',$row[2],$row[52]);
    Fungsi::inputnilaipsikologis($sekolah_id,'APLUS%',$row[2],$row[53]);
    Fungsi::inputnilaipsikologis($sekolah_id,'APLUSKET',$row[2],$row[54]);
    Fungsi::inputnilaipsikologis($sekolah_id,'AMINUS%',$row[2],$row[55]);
    Fungsi::inputnilaipsikologis($sekolah_id,'AMINUSKET',$row[2],$row[56]);
    Fungsi::inputnilaipsikologis($sekolah_id,'C',$row[2],$row[57]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CPLUS%',$row[2],$row[58]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CPLUSKET',$row[2],$row[59]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CMINUS%',$row[2],$row[60]);
    Fungsi::inputnilaipsikologis($sekolah_id,'CMINUSKET',$row[2],$row[61]);
    Fungsi::inputnilaipsikologis($sekolah_id,'D',$row[2],$row[62]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DPLUS%',$row[2],$row[63]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DPLUSKET',$row[2],$row[64]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DMINUS%',$row[2],$row[65]);
    Fungsi::inputnilaipsikologis($sekolah_id,'DMINUSKET',$row[2],$row[66]);
    Fungsi::inputnilaipsikologis($sekolah_id,'E',$row[2],$row[67]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EPLUS%',$row[2],$row[68]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EPLUSKET',$row[2],$row[69]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EMINUS%',$row[2],$row[70]);
    Fungsi::inputnilaipsikologis($sekolah_id,'EMINUSKET',$row[2],$row[71]);
    Fungsi::inputnilaipsikologis($sekolah_id,'F',$row[2],$row[71]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FPLUS%',$row[2],$row[72]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FPLUSKET',$row[2],$row[73]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FMINUS%',$row[2],$row[74]);
    Fungsi::inputnilaipsikologis($sekolah_id,'FMINUSKET',$row[2],$row[75]);
    Fungsi::inputnilaipsikologis($sekolah_id,'G',$row[2],$row[76]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GPLUS%',$row[2],$row[77]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GPLUSKET',$row[2],$row[78]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GMINUS%',$row[2],$row[79]);
    Fungsi::inputnilaipsikologis($sekolah_id,'GMINUSKET',$row[2],$row[80]);
    Fungsi::inputnilaipsikologis($sekolah_id,'H',$row[2],$row[81]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HPLUS%',$row[2],$row[82]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HPLUSKET',$row[2],$row[83]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HMINUS%',$row[2],$row[84]);
    Fungsi::inputnilaipsikologis($sekolah_id,'HMINUSKET',$row[2],$row[85]);
    Fungsi::inputnilaipsikologis($sekolah_id,'I',$row[2],$row[86]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IPLUS%',$row[2],$row[87]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IPLUSKET',$row[2],$row[88]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IMINUS%',$row[2],$row[89]);
    Fungsi::inputnilaipsikologis($sekolah_id,'IMINUSKET',$row[2],$row[90]);
    Fungsi::inputnilaipsikologis($sekolah_id,'J',$row[2],$row[90]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JPLUS%',$row[2],$row[91]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JPLUSKET',$row[2],$row[92]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JMINUS%',$row[2],$row[93]);
    Fungsi::inputnilaipsikologis($sekolah_id,'JMINUSKET',$row[2],$row[94]);
    Fungsi::inputnilaipsikologis($sekolah_id,'O',$row[2],$row[95]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OPLUS%',$row[2],$row[96]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OPLUSKET',$row[2],$row[97]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OMINUS%',$row[2],$row[98]);
    Fungsi::inputnilaipsikologis($sekolah_id,'OMINUSKET',$row[2],$row[99]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2',$row[2],$row[100]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2%',$row[2],$row[101]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2KET%',$row[2],$row[102]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q2KET',$row[2],$row[103]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3',$row[2],$row[104]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3%',$row[2],$row[105]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3KET%',$row[2],$row[106]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q3KET',$row[2],$row[107]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4',$row[2],$row[108]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4%',$row[2],$row[109]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4KET%',$row[2],$row[110]);
    Fungsi::inputnilaipsikologis($sekolah_id,'Q4KET',$row[2],$row[111]);

    // // 1.ambil id master where KB
    // $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KB')->first();
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

    // 1.ambil id master where KB%
    // $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan','KB%')->first();
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
$no++;

    }

}

}
