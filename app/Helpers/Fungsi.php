<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Fungsi {
    // public static function get_username($user_id) {
    //     $user = DB::table('users')->where('userid', $user_id)->first();
    //     return (isset($user->username) ? $user->username : '');
    // }

    public static function autokodepanggilbuku($inputan){
        // $data=$inputan;
        $mulai=$inputan;
        $kodebukubaru=$mulai;
        // $cekkodebuku = DB::table('buku')->where('kode',$mulai)->count();
        $hasilcek=Fungsi::cekkodepanggilbuku($mulai);
        //max integer value
        $akhir=2147483647;
        for($i=$mulai;$i<=$akhir+1;$i++){
             $hasilcek=Fungsi::cekkodepanggilbuku($i);
                if($hasilcek==='ready'){
                    $kodebukubaru=$i;
                    break;
                }else{
                    $hasilcek=Fungsi::cekkodepanggilbuku($i);
                }

                $kodebukubaru=$i;
        }

        if($kodebukubaru>$akhir){
            $kodebukubaru='kode enuh';
        }


        return $kodebukubaru;
    }
    public static function cekkodepanggilbuku($inputan){

        $cekkodebuku = DB::table('buku')->where('kode',$inputan)->count();
        if($cekkodebuku>0){
            $hasil='sudahdipakai';
        }else{
            $hasil='ready';
        }

        return $hasil;

    }
    public static function periksaterlambat($inputan){

        $hitungketerlambatan = strtotime($inputan)-strtotime(Carbon::now());
        $selisih = $hitungketerlambatan / 86400;
        // jika selisih negatif maka terlambat
        if($selisih<0){
        $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($inputan);
        $telat=$DeferenceInDays;
        }else{
            $telat=0;
        }

        return $telat;
    }
    public static function periksadenda($inputan){

        $hitungketerlambatan = strtotime($inputan)-strtotime(Carbon::now());
        $selisih = $hitungketerlambatan / 86400;
        // jika selisih negatif maka terlambat
        if($selisih<0){
        $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($inputan);
        $denda=$DeferenceInDays*Fungsi::defaultdenda();
        }else{
            $denda=0;
        }

        return $denda;
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
    public static function autokodebuku($inputan){
        // $data=$inputan;
        $str=explode("-",$inputan);
        $mulai=$str[0];
        $akhir=$str[1];
        $kodebukubaru=$mulai;
        // $cekkodebuku = DB::table('buku')->where('kode',$mulai)->count();
        $hasilcek=Fungsi::cekkodebuku($mulai);

        for($i=$mulai;$i<=$akhir+1;$i++){
             $hasilcek=Fungsi::cekkodebuku($i);
                if($hasilcek==='ready'){
                    $kodebukubaru=$i;
                    break;
                }else{
                    $hasilcek=Fungsi::cekkodebuku($i);
                }

                $kodebukubaru=$i;
        }

        if($kodebukubaru>$akhir){
            $kodebukubaru='penuh';
        }
        return $kodebukubaru;
    }
    public static function cekkodebuku($inputan){

        $cekkodebuku = DB::table('buku')->where('kode',$inputan)->count();
        if($cekkodebuku>0){
            $hasil='sudahdipakai';
        }else{
            $hasil='ready';
        }

        return $hasil;

    }
    public static function predikat($angka){
        if($angka>=90){
            $hasil='A';
        }elseif(($angka<90)&&($angka>=85)){
            $hasil='A-';
        }elseif(($angka<85)&&($angka>=80)){
            $hasil='B+';
        }elseif(($angka<80)&&($angka>=75)){
            $hasil='B-';
        }elseif(($angka<75)&&($angka>=70)){
            $hasil='C+';
        }elseif(($angka<70)&&($angka>=65)){
            $hasil='C-';
        }elseif($angka<65){
            $hasil='D';
        }
        return $hasil;
    }

    public static function periksasemester($datas) {
        $strex=explode(" ",$datas);
        // dd($strex);
    if(isset($datas)){
            $hasil='null';
        $cekambilkode = DB::table('kategori')->where('nama',$datas)->where('prefix','semester')->count();
        if($cekambilkode>0){
        $ambilkode = DB::table('kategori')->where('nama',$datas)->where('prefix','semester')->first();
        $hasil=$ambilkode->kode;
        }
        return $hasil;
    }

    return (isset($hasil) ? $hasil : '');
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

    public static function sekolahnama(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahnama;
        return $data;

    }

    public static function sekolahalamat(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahalamat;
        return $data;

    }


    public static function kop1(){

        $settings = DB::table('settings')->first();
        $data=$settings->kop1;
        return $data;

    }


    public static function kop2(){

        $settings = DB::table('settings')->first();
        $data=$settings->kop2;
        return $data;

    }


    public static function kop3(){

        $settings = DB::table('settings')->first();
        $data=$settings->kop3;
        return $data;

    }


    public static function kop4(){

        $settings = DB::table('settings')->first();
        $data=$settings->kop4;
        return $data;

    }

    public static function sekolahtelp(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahtelp;
        return $data;

    }

    public static function aplikasijudul(){

        $settings = DB::table('settings')->first();
        $data=$settings->aplikasijudul;
        return $data;

    }


    public static function aplikasijudulsingkat(){

        $settings = DB::table('settings')->first();
        $data=$settings->aplikasijudulsingkat;
        return $data;

    }

    public static function passdefaultadmin(){

        $settings = DB::table('settings')->first();
        $data=$settings->passdefaultadmin;
        return $data;

    }
    public static function passdefaultpegawai(){

        $settings = DB::table('settings')->first();
        $data=$settings->passdefaultpegawai;
        return $data;

    }
    public static function sekolahlogo(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahlogo;

        return $data;

    }
    public static function sekolahttd(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahttd;
        return $data;

    }
    public static function sekolahttd2(){

        $settings = DB::table('settings')->first();
        $data=$settings->sekolahttd2;
        return $data;

    }
    public static function defaultdenda(){

        $settings = DB::table('settings')->first();
        $data=$settings->defaultdenda;
        return $data;

    }
    public static function defaultminbayar(){

        $settings = DB::table('settings')->first();
        $data=$settings->defaultminbayar;
        return $data;

    }
    public static function defaultmaxbukupinjam(){

        $settings = DB::table('settings')->first();
        $data=$settings->defaultmaxbukupinjam;
        return $data;

    }

    public static function defaultmaxharipinjam(){

        $settings = DB::table('settings')->first();
        $data=$settings->defaultmaxharipinjam;
        return $data;

    }
    //naik tapel
    public static function naik_t($str)
        {
            $strex=explode("/",$str);
            $strex[0]=$strex[0]+1;
            $strex[1]=$strex[1]+1;

            $str=implode("/",$strex);

            return $str;
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
