<?php
namespace App\Helpers;

use App\Models\inputnilaipsikologi;
use App\Models\minatbakatdetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Fungsi {
    // public static function get_username($user_id) {
    //     $user = DB::table('users')->where('userid', $user_id)->first();
    //     return (isset($user->username) ? $user->username : '');
    // }

    public static function inputnilaipsikologis($sekolah_id,$masternilaipsikologi_singkatan,$siswa_nomerinduk,$nilai=0){

        $periksamaster=DB::table('masternilaipsikologi')->where('singkatan',$masternilaipsikologi_singkatan)->count();
        if($periksamaster>0){

        $ambil_idmaster=DB::table('masternilaipsikologi')->where('singkatan',$masternilaipsikologi_singkatan)->first();
        $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$siswa_nomerinduk)->where('sekolah_id',$sekolah_id)->first();

        $cekdatanilai=DB::table('inputnilaipsikologi')
        ->where('masternilaipsikologi_id',$ambil_idmaster->id)
        ->where('siswa_id',$ambil_idsiswa->id)
        ->where('sekolah_id',$sekolah_id)->count();

        if($cekdatanilai>0){
            // updaTe
                inputnilaipsikologi::where('masternilaipsikologi_id',$ambil_idmaster->id)
                ->where('siswa_id',$ambil_idsiswa->id)
                ->where('sekolah_id',$sekolah_id)
                ->update([
                    'nilai'     =>   $nilai,
                    'deleted_at'=>null,
                    'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
                ]);

        }else{

            DB::table('inputnilaipsikologi')->insert(
                array(
                    'siswa_id'     =>  $ambil_idsiswa->id,
                    'masternilaipsikologi_id'     =>  $ambil_idmaster->id,
                    'nilai'     =>   $nilai,
                    'deleted_at' => null,
                    'sekolah_id'     =>   $sekolah_id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ));

        }

        }
    }


    
    public static function inputminatbakat($sekolah_id,$minatbakat_nama,$siswa_nomerinduk,$nilai=0){

        $periksamaster=DB::table('minatbakat')->where('nama',$minatbakat_nama)->count();
        if($periksamaster>0){

        $ambil_idmaster=DB::table('minatbakat')->where('nama',$minatbakat_nama)->first();
        $ambil_idsiswa=DB::table('siswa')->where('nomerinduk',$siswa_nomerinduk)->where('sekolah_id',$sekolah_id)->first();

        $cekdatanilai=DB::table('minatbakatdetail')
        ->where('minatbakat_id',$ambil_idmaster->id)
        ->where('siswa_id',$ambil_idsiswa->id)
        ->where('sekolah_id',$sekolah_id)->count();

        if($cekdatanilai>0){
            // updaTe
                minatbakatdetail::where('minatbakat_id',$ambil_idmaster->id)
                ->where('siswa_id',$ambil_idsiswa->id)
                ->where('sekolah_id',$sekolah_id)
                ->update([
                    'nilai'     =>   $nilai,
                    'deleted_at'=>null,
                    'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
                ]);

        }else{

            DB::table('minatbakatdetail')->insert(
                array(
                    'siswa_id'     =>  $ambil_idsiswa->id,
                    'minatbakat_id'     =>  $ambil_idmaster->id,
                    'nilai'     =>   $nilai,
                    'deleted_at' => null,
                    'sekolah_id'     =>   $sekolah_id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ));

        }

        }
    }

    public static function tanggalgaringcreated($data){
        $data2=explode(" ",$data);

        $inputan=$data2[0];
        $bulanindo='Januari';
        $str=explode("-",$inputan);
        return $str[2]."/".$str[1]."/".$str[0];
    }
    public static function tanggalgaring($inputan){
        $bulanindo='Januari';
        $str=explode("-",$inputan);
        return $str[2]."/".$str[1]."/".$str[0];
    }

    public static function tanggalindocreated($data){
        $data2=explode(" ",$data);

        $inputan=$data2[0];

        $bulanindo='Januari';
        $str=explode("-",$inputan);
                if($str[1]=='01'){
                    $bulanindo='Januari';
                }elseif($str[1]=='02'){
                    $bulanindo='Februari';
                }elseif($str[1]=='03'){
                    $bulanindo='Maret';
                }elseif($str[1]=='04'){
                    $bulanindo='April';
                }elseif($str[1]=='05'){
                    $bulanindo='Mei';
                }elseif($str[1]=='06'){
                    $bulanindo='Juni';
                }elseif($str[1]=='07'){
                    $bulanindo='Juli';
                }elseif($str[1]=='08'){
                    $bulanindo='Agustus';
                }elseif($str[1]=='09'){
                    $bulanindo='September';
                }elseif($str[1]=='10'){
                    $bulanindo='Oktober';
                }elseif($str[1]=='11'){
                    $bulanindo='November';
                }else{
                    $bulanindo='Desember';
                }

        return $str[2]." ".$bulanindo." " .$str[0];
    }
    public static function tanggalindobln($inputan){
        $bulanindo='Januari';
        $str=explode("-",$inputan);
                if($str[1]=='01'){
                    $bulanindo='Januari';
                }elseif($str[1]=='02'){
                    $bulanindo='Februari';
                }elseif($str[1]=='03'){
                    $bulanindo='Maret';
                }elseif($str[1]=='04'){
                    $bulanindo='April';
                }elseif($str[1]=='05'){
                    $bulanindo='Mei';
                }elseif($str[1]=='06'){
                    $bulanindo='Juni';
                }elseif($str[1]=='07'){
                    $bulanindo='Juli';
                }elseif($str[1]=='08'){
                    $bulanindo='Agustus';
                }elseif($str[1]=='09'){
                    $bulanindo='September';
                }elseif($str[1]=='10'){
                    $bulanindo='Oktober';
                }elseif($str[1]=='11'){
                    $bulanindo='November';
                }else{
                    $bulanindo='Desember';
                }

        return $bulanindo." " .$str[0];
    }
    public static function tanggalindo($inputan){
        $bulanindo='Januari';
        $str=explode("-",$inputan);
                if($str[1]=='01'){
                    $bulanindo='Januari';
                }elseif($str[1]=='02'){
                    $bulanindo='Februari';
                }elseif($str[1]=='03'){
                    $bulanindo='Maret';
                }elseif($str[1]=='04'){
                    $bulanindo='April';
                }elseif($str[1]=='05'){
                    $bulanindo='Mei';
                }elseif($str[1]=='06'){
                    $bulanindo='Juni';
                }elseif($str[1]=='07'){
                    $bulanindo='Juli';
                }elseif($str[1]=='08'){
                    $bulanindo='Agustus';
                }elseif($str[1]=='09'){
                    $bulanindo='September';
                }elseif($str[1]=='10'){
                    $bulanindo='Oktober';
                }elseif($str[1]=='11'){
                    $bulanindo='November';
                }else{
                    $bulanindo='Desember';
                }

        return $str[2]." ".$bulanindo." " .$str[0];
    }
    public static function manipulasiTanggal($tgl,$jumlah=1,$format='days'){
        $currentDate = $tgl;
        return date('Y-m-d', strtotime($jumlah.' '.$format, strtotime($currentDate)));
    }

    public static function periksaarray($inputan){
        // $data=$inputan;
        $str=explode(",",$inputan);
        $jmlstr=count($str);

        return $jmlstr;
    }

    public static function rupiah($angka){

        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;

    }

    public static function paginationjml(){

        $settings = DB::table('settings')->first();
        $data=$settings->paginationjml;
        return $data;

    }

    public static function app_nama(){

        $settings = DB::table('settings')->first();
        $data=$settings->app_nama;
        return $data;

    }

    public static function app_namapendek(){

        $settings = DB::table('settings')->first();
        $data=$settings->app_namapendek;
        return $data;

    }



    // fungsi dari sisfokol
    //untuk mencegah si jahil #1
    public static function cegah($str)
        {
            $str = trim(htmlentities(htmlspecialchars($str)));
        $search = array ("'\''",
                            "'%'",
                            "'@'",
                            "'_'",
                            "'1=1'",
                            "'/'",
                            "'!'",
                            "'<'",
                            "'>'",
                            "'\('",
                            "'\)'",
                            "';'",
                            "'-'",
                            "'_'");

        $replace = array ("xpsijix",
                            "xpersenx",
                            "xtkeongx",
                            "xgwahx",
                            "x1smdgan1x",
                            "xgmringx",
                            "xpentungx",
                            "xkkirix",
                            "xkkananx",
                            "xkkurix",
                            "xkkurnanx",
                            "xkommax",
                            "xstrix",
                            "xstripbwhx");

        $str = preg_replace($search,$replace,$str);
        return $str;
        }



        //untuk mencegah si jahil #2
        public static function cegah2($str)
        {
            $str = trim($str);
        $search = array ("'\''",
                            "'%'",
                            "'@'",
                            "'_'",
                            "'1=1'",
                            "'/'",
                            "'!'",
                            "'<'",
                            "'>'",
                            "'\('",
                            "'\)'",
                            "';'",
                            "'-'",
                            "'_'");

        $replace = array ("xpsijix",
                            "xpersenx",
                            "xtkeongx",
                            "xgwahx",
                            "x1smdgan1x",
                            "xgmringx",
                            "xpentungx",
                            "xkkirix",
                            "xkkananx",
                            "xkkurix",
                            "xkkurnanx",
                            "xkommax",
                            "xstrix",
                            "xstripbwhx");

        $str = preg_replace($search,$replace,$str);
        return $str;
        }

        //balikino. . o . . .. o. . .. . balikin
        public static function balikin($str)
        {
        $search = array ("'xpsijix'",
                            "'xpersenx'",
                            "'xtkeongx'",
                            "'xgwahx'",
                            "'x1smdgan1x'",
                            "'xgmringx'",
                            "'xpentungx'",
                            "'xkkirix'",
                            "'xkkananx'",
                            "'xkkurix'",
                            "'xkkurnanx'",
                            "'xkommax'",
                            "'xstrix'",
                            "'xstripbwhx'");

        $replace = array ("'",
                            "%",
                            "@",
                            "_",
                            "1=1",
                            "/",
                            "!",
                            "<",
                            ">",
                            "(",
                            ")",
                            ";",
                            "-",
                            "_");

        $str = preg_replace($search,$replace,$str);

        return $str;
        }



        //balikin2
        public static function balikin2($str)
        {
        $search = array ("'xpsijix'",
                            "'xpersenx'",
                            "'xtkeongx'",
                            "'xgwahx'",
                            "'x1smdgan1x'",
                            "'xgmringx'",
                            "'xpentungx'",
                            "'xkkirix'",
                            "'xkkananx'",
                            "'xkkurix'",
                            "'xkkurnanx'",
                            "'xkommax'",
                            "'xstrix'",
                            "'xstripbwhx'");

        $replace = array ("'",
                            "%",
                            "@",
                            "_",
                            "1=1",
                            "/",
                            "!",
                            "<",
                            ">",
                            "(",
                            ")",
                            ";",
                            "-",
                            "_");

        $str = preg_replace($search,$replace,$str);
        return $str;
        }

}
