<?php

namespace App\Http\Controllers;

use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
use App\Models\masterdeteksi;
use App\Models\masternilaibidangstudi;
use App\Models\masternilaipsikologi;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\pengguna;
use App\Models\referensi;
use App\Models\sekolah;
use App\Models\semester;
use App\Models\siswa;
use App\Models\tahun;
use App\Models\walikelas;
use App\Models\yayasan;
use App\Models\yayasandetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class adminseedercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function sekolah(Request $request){
        // dd('seeder');
        $jmlseeder=10;
        // 1. insert data sekolah

        $faker = Faker::create('id_ID');
        $pre=$faker->randomElement(['SMPN','SMAN']);
        $num=$faker->numberBetween(1,20);
        $city=$faker->unique()->city;
        DB::table('sekolah')->insert([
            'nama' => $pre.' '.$num.' '.$city,
            'alamat' => $faker->unique()->address,
            'status' => 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 2. ambil id dari last insert
        $ambil=DB::table('sekolah')->orderBy('id','desc')->first();
        $id=$ambil->id;

        // 3 . input tapel dan semester

        DB::table('tahun')->insert([
            'nama' => '2021',
            'sekolah_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('semester')->insert([
            'nama' => '1',
            'sekolah_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // 4. input walikelas, kelas,  pengguna referensi , bidang studi , siswa

        for($i=0;$i<$jmlseeder;$i++){
            // 3. insert data siswa


                $nama=$faker->unique()->name;
                // $nomerinduk=$faker->unique()->creditCardNumber;
                $nomerinduk=$faker->unique()->isbn10;
                DB::table('walikelas')->insert([
                    'nama' => $nama,
                    'nomerinduk' => $nomerinduk,
                    'sekolah_id' => $id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $ambilwali=DB::table('walikelas')->orderBy('id','desc')->where('sekolah_id',$id)
                ->inRandomOrder()
                ->first();


                $nama=$faker->unique()->company;
                DB::table('kelas')->insert([
                    'nama' => $nama,
                    // 'tipe' => $faker->randomElement(['Umum', 'Khusus']),
                    'walikelas_id' => $ambilwali->id,
                    'sekolah_id' => $id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $ambilkelas=DB::table('kelas')->orderBy('id','desc')->where('sekolah_id',$id)
                ->inRandomOrder()
                ->first();

                $nama=$faker->unique()->name;
                $nomerinduk=$faker->unique()->ean8;
                DB::table('siswa')->insert([
                    'nama' => $nama,
                    'nomerinduk' => $nomerinduk,
                    'kelas_id' => $ambilkelas->id,
                    'sekolah_id' => $id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $nama=$faker->unique()->name;
                $nomerinduk=$faker->unique()->ean8;
                DB::table('siswa')->insert([
                    'nama' => $nama,
                    'nomerinduk' => $nomerinduk,
                    'kelas_id' => $ambilkelas->id,
                    'sekolah_id' => $id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $nama=$faker->unique()->name;
                $nomerinduk=$faker->unique()->ean8;
                DB::table('siswa')->insert([
                    'nama' => $nama,
                    'nomerinduk' => $nomerinduk,
                    'kelas_id' => $ambilkelas->id,
                    'sekolah_id' => $id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

     }
     $sekolah=$pre.' '.$num.' '.$city;
     DB::table('users')->insert([
        'name' =>  $sekolah,
        'email' => $faker->unique()->email,
        'username'=>$faker->unique()->username,
        'nomerinduk'=>$faker->unique()->username,
        'password' => Hash::make('123'),
        'tipeuser' => 'bk',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);

    $ambiluser=DB::table('users')->orderBy('id','desc')->first();

     DB::table('pengguna')->insert([
         'nama' =>  $pre.' '.$num.' '.$city,
         'users_id' => $ambiluser->id,
         'sekolah_id' => $id,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now()
     ]);



        return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }

    public function masternilaipsikologi(Request $request){

        masternilaipsikologi::truncate();
        $dataku = collect([
            [
                'nama' => 'kb_persen',
                'singkatan' => 'kb_persen',
            ],
            [
                'nama' => 'kbh',
                'singkatan' => 'kbh',
            ],
            [
                'nama' => 'lm_persen',
                'singkatan' => 'lm_persen',
            ],
            [
                'nama' => 'lmh',
                'singkatan' => 'lmh',
            ],
            [
                'nama' => 'ks_persen',
                'singkatan' => 'ks_persen',
            ],
            [
                'nama' => 'ksh',
                'singkatan' => 'ksh',
            ],
            [
                'nama' => 'km_persen',
                'singkatan' => 'km_persen',
            ],
            [
                'nama' => 'kmh',
                'singkatan' => 'kmh',
            ],
            [
                'nama' => 'kk_persen',
                'singkatan' => 'kk_persen',
            ],
            [
                'nama' => 'kkh',
                'singkatan' => 'kkh',
            ],
            [
                'nama' => 'ki_persen',
                'singkatan' => 'ki_persen',
            ],
            [
                'nama' => 'kih',
                'singkatan' => 'kih',
            ],
            [
                'nama' => 'ka_persen',
                'singkatan' => 'ka_persen',
            ],
            [
                'nama' => 'kah',
                'singkatan' => 'kah',
            ],
            [
                'nama' => 'kn_persen',
                'singkatan' => 'kn_persen',
            ],
            [
                'nama' => 'knh',
                'singkatan' => 'knh',
            ],
            [
                'nama' => 'iq',
                'singkatan' => 'iq',
            ],
            [
                'nama' => 'iq_persen',
                'singkatan' => 'iq_persen',
            ],
            [
                'nama' => 'iqh',
                'singkatan' => 'iqh',
            ],
            [
                'nama' => 'eq_persen',
                'singkatan' => 'eq_persen',
            ],
            [
                'nama' => 'eq_persen_keterangan',
                'singkatan' => 'eq_persen_keterangan',
            ],
            [
                'nama' => 'sq_persen',
                'singkatan' => 'sq_persen',
            ],
            [
                'nama' => 'sq_persen_keterangan',
                'singkatan' => 'sq_persen_keterangan',
            ],
            [
                'nama' => 'scq_persen',
                'singkatan' => 'scq_persen',
            ],
            [
                'nama' => 'scq_persen_keterangan',
                'singkatan' => 'scq_persen_keterangan',
            ],
            [
                'nama' => 'hspq_a_kn_persen',
                'singkatan' => 'hspq_a_kn_persen',
            ],
            [
                'nama' => 'hspq_a_kn_keterangan',
                'singkatan' => 'hspq_a_kn_keterangan',
            ],
            [
                'nama' => 'hspq_a_kr_persen',
                'singkatan' => 'hspq_a_kr_persen',
            ],
            [
                'nama' => 'hspq_a_kr_keterangan',
                'singkatan' => 'hspq_a_kr_keterangan',
            ],
            [
                'nama' => 'hspq_c_kn_persen',
                'singkatan' => 'hspq_c_kn_persen',
            ],
            [
                'nama' => 'hspq_c_kn_keterangan',
                'singkatan' => 'hspq_c_kn_keterangan',
            ],
            [
                'nama' => 'hspq_c_kr_persen',
                'singkatan' => 'hspq_c_kr_persen',
            ],
            [
                'nama' => 'hspq_c_kr_keterangan',
                'singkatan' => 'hspq_c_kr_keterangan',
            ],
            [
                'nama' => 'hspq_d_kn_persen',
                'singkatan' => 'hspq_d_kn_persen',
            ],
            [
                'nama' => 'hspq_d_kn_keterangan',
                'singkatan' => 'hspq_d_kn_keterangan',
            ],
            [
                'nama' => 'hspq_d_kr_persen',
                'singkatan' => 'hspq_d_kr_persen',
            ],
            [
                'nama' => 'hspq_d_kr_keterangan',
                'singkatan' => 'hspq_d_kr_keterangan',
            ],
            [
                'nama' => 'hspq_e_kn_persen',
                'singkatan' => 'hspq_e_kn_persen',
            ],
            [
                'nama' => 'hspq_e_kn_keterangan',
                'singkatan' => 'hspq_e_kn_keterangan',
            ],
            [
                'nama' => 'hspq_e_kr_persen',
                'singkatan' => 'hspq_e_kr_persen',
            ],
            [
                'nama' => 'hspq_e_kr_keterangan',
                'singkatan' => 'hspq_e_kr_keterangan',
            ],
            [
                'nama' => 'hspq_f_kn_persen',
                'singkatan' => 'hspq_f_kn_persen',
            ],
            [
                'nama' => 'hspq_f_kn_keterangan',
                'singkatan' => 'hspq_f_kn_keterangan',
            ],
            [
                'nama' => 'hspq_f_kr_persen',
                'singkatan' => 'hspq_f_kr_persen',
            ],
            [
                'nama' => 'hspq_f_kr_keterangan',
                'singkatan' => 'hspq_f_kr_keterangan',
            ],
            [
                'nama' => 'hspq_g_kn_persen',
                'singkatan' => 'hspq_g_kn_persen',
            ],
            [
                'nama' => 'hspq_g_kn_keterangan',
                'singkatan' => 'hspq_g_kn_keterangan',
            ],
            [
                'nama' => 'hspq_g_kr_persen',
                'singkatan' => 'hspq_g_kr_persen',
            ],
            [
                'nama' => 'hspq_g_kr_keterangan',
                'singkatan' => 'hspq_g_kr_keterangan',
            ],
            [
                'nama' => 'hspq_h_kn_persen',
                'singkatan' => 'hspq_h_kn_persen',
            ],
            [
                'nama' => 'hspq_h_kn_keterangan',
                'singkatan' => 'hspq_h_kn_keterangan',
            ],
            [
                'nama' => 'hspq_h_kr_persen',
                'singkatan' => 'hspq_h_kr_persen',
            ],
            [
                'nama' => 'hspq_h_kr_keterangan',
                'singkatan' => 'hspq_h_kr_keterangan',
            ],
            [
                'nama' => 'hspq_i_kn_persen',
                'singkatan' => 'hspq_i_kn_persen',
            ],
            [
                'nama' => 'hspq_i_kn_keterangan',
                'singkatan' => 'hspq_i_kn_keterangan',
            ],
            [
                'nama' => 'hspq_i_kr_persen',
                'singkatan' => 'hspq_i_kr_persen',
            ],
            [
                'nama' => 'hspq_i_kr_keterangan',
                'singkatan' => 'hspq_i_kr_keterangan',
            ],
            [
                'nama' => 'hspq_j_kn_persen',
                'singkatan' => 'hspq_j_kn_persen',
            ],
            [
                'nama' => 'hspq_j_kn_keterangan',
                'singkatan' => 'hspq_j_kn_keterangan',
            ],
            [
                'nama' => 'hspq_j_kr_persen',
                'singkatan' => 'hspq_j_kr_persen',
            ],
            [
                'nama' => 'hspq_j_kr_keterangan',
                'singkatan' => 'hspq_j_kr_keterangan',
            ],
            [
                'nama' => 'hspq_o_kn_persen',
                'singkatan' => 'hspq_o_kn_persen',
            ],
            [
                'nama' => 'hspq_o_kn_keterangan',
                'singkatan' => 'hspq_o_kn_keterangan',
            ],
            [
                'nama' => 'hspq_o_kr_persen',
                'singkatan' => 'hspq_o_kr_persen',
            ],
            [
                'nama' => 'hspq_o_kr_keterangan',
                'singkatan' => 'hspq_o_kr_keterangan',
            ],
            [
                'nama' => 'hspq_q2_kn_persen',
                'singkatan' => 'hspq_q2_kn_persen',
            ],
            [
                'nama' => 'hspq_q2_kn_keterangan',
                'singkatan' => 'hspq_q2_kn_keterangan',
            ],
            [
                'nama' => 'hspq_q2_kr_persen',
                'singkatan' => 'hspq_q2_kr_persen',
            ],
            [
                'nama' => 'hspq_q2_kr_keterangan',
                'singkatan' => 'hspq_q2_kr_keterangan',
            ],
            [
                'nama' => 'hspq_q3_kn_persen',
                'singkatan' => 'hspq_q3_kn_persen',
            ],
            [
                'nama' => 'hspq_q3_kn_keterangan',
                'singkatan' => 'hspq_q3_kn_keterangan',
            ],
            [
                'nama' => 'hspq_q3_kr_persen',
                'singkatan' => 'hspq_q3_kr_persen',
            ],
            [
                'nama' => 'hspq_q3_kr_keterangan',
                'singkatan' => 'hspq_q3_kr_keterangan',
            ],
            [
                'nama' => 'hspq_q4_kn_persen',
                'singkatan' => 'hspq_q4_kn_persen',
            ],
            [
                'nama' => 'hspq_q4_kn_keterangan',
                'singkatan' => 'hspq_q4_kn_keterangan',
            ],
            [
                'nama' => 'hspq_q4_kr_persen',
                'singkatan' => 'hspq_q4_kr_persen',
            ],
            [
                'nama' => 'hspq_q4_kr_keterangan',
                'singkatan' => 'hspq_q4_kr_keterangan',
            ],
            [
                'nama' => 'hspq_rank_1',
                'singkatan' => 'hspq_rank_1',
            ],
            [
                'nama' => 'hspq_rank_2',
                'singkatan' => 'hspq_rank_2',
            ],
            [
                'nama' => 'hspq_rank_3',
                'singkatan' => 'hspq_rank_3',
            ],
            [
                'nama' => 'hspq_rank_4',
                'singkatan' => 'hspq_rank_4',
            ],
            [
                'nama' => 'hspq_rank_5',
                'singkatan' => 'hspq_rank_5',
            ],
            [
                'nama' => 'hspq_rank_1_positif',
                'singkatan' => 'hspq_rank_1_positif',
            ],
            [
                'nama' => 'hspq_rank_2_positif',
                'singkatan' => 'hspq_rank_2_positif',
            ],
            [
                'nama' => 'hspq_rank_3_positif',
                'singkatan' => 'hspq_rank_3_positif',
            ],
            [
                'nama' => 'hspq_rank_4_positif',
                'singkatan' => 'hspq_rank_4_positif',
            ],
            [
                'nama' => 'hspq_rank_5_positif',
                'singkatan' => 'hspq_rank_5_positif',
            ],
            [
                'nama' => 'hspq_rank_1_negatif',
                'singkatan' => 'hspq_rank_1_negatif',
            ],
            [
                'nama' => 'hspq_rank_2_negatif',
                'singkatan' => 'hspq_rank_2_negatif',
            ],
            [
                'nama' => 'hspq_rank_3_negatif',
                'singkatan' => 'hspq_rank_3_negatif',
            ],
            [
                'nama' => 'hspq_rank_4_negatif',
                'singkatan' => 'hspq_rank_4_negatif',
            ],
            [
                'nama' => 'hspq_rank_5_negatif',
                'singkatan' => 'hspq_rank_5_negatif',
            ],
            [
                'nama' => 'minat_pekerjaan_1_persen',
                'singkatan' => 'minat_pekerjaan_1_persen',
            ],
            [
                'nama' => 'minat_pekerjaan_2_persen',
                'singkatan' => 'minat_pekerjaan_2_persen',
            ],
            [
                'nama' => 'minat_pekerjaan_3_persen',
                'singkatan' => 'minat_pekerjaan_3_persen',
            ],
        ]);


        foreach($dataku as $data){
            // dd($data['nama']);
            DB::table('masternilaipsikologi')->insert([
                'nama' => $data['nama'],
                'singkatan' => $data['singkatan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }



        minatbakat::truncate();
        $dataku = collect([
            [
                'nama' => 'minat_pekerjaan_1',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'minat_pekerjaan_2',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'minat_pekerjaan_3',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'mnt_cita2_1',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'mnt_cita2_2',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'mnt_cita2_3',
                'kategori' => 'Minat dan Bakat',
            ],
            //diisi bk
            [
                'nama' => 'Hobi',
                'kategori' => 'Minat dan Bakat',
                'menukhusus' => 'bk',
            ],
            [
                'nama' => 'Pekerjaan Bapak',
                'kategori' => 'Minat dan Bakat',
                'menukhusus' => 'bk',
            ],
            [
                'nama' => 'Pekerjaan Ibu',
                'kategori' => 'Minat dan Bakat',
                'menukhusus' => 'bk',
            ],
            [
                'nama' => 'Pekerjaan Kakek',
                'kategori' => 'Minat dan Bakat',
                'menukhusus' => 'bk',
            ],
            [
                'nama' => 'Analisa Pekerjaan',
                'kategori' => 'Minat dan Bakat',
                'menukhusus' => 'bk',
            ],
            [
                'nama' => 'tipe_bakat_1',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'tipe_bakat_2',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'tipe_bakat_3',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_smp',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_sma_smk_1_fakultas',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_sma_smk_1_prodi',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_sma_smk_2_fakultas',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_sma_smk_2_prodi',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_studi_lanjut_sma_smk_kedinasan',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_jurusan_lanjut_sma',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_jurusan_lanjut_smk_1',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_jurusan_lanjut_smk_2',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'mnt_jurusan_lanjut_smk_3',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'sekolah_lanjutan',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'sekolah_jurusan',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'saran_fakultas_1',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'saran_fakultas_1_prodi',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'saran_fakultas_2',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'saran_fakultas_2_prodi',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Keterangan',
                'kategori' => 'Bakat dan Penjurusan',
                'menukhusus' => 'bk',
            ],
        ]);


        foreach($dataku as $data){
            // dd($data['nama']);
            if(isset($data['menukhusus'])){
                $menukhusus=$data['menukhusus'];
            }else{
                $menukhusus=null;
            }
            DB::table('minatbakat')->insert([
                'nama' => $data['nama'],
                'kategori' => $data['kategori'],
                'menukhusus' => $menukhusus,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }





        return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
    public function masterdeteksi(Request $request){
        masterdeteksi::truncate();
        $dataku = collect([
            [
                'nama' => 'AGRESIF',
                'singkatan' => 'AGRESIF',
            ],
            [
                'nama' => 'MELAMUN',
                'singkatan' => 'MELAMUN',
            ],
            [
                'nama' => 'MALAS',
                'singkatan' => 'MALAS',
            ],
            [
                'nama' => 'MEMBANGKANG',
                'singkatan' => 'MEMBANGKANG',
            ],
            [
                'nama' => 'DEPRESI',
                'singkatan' => 'DEPRESI',
            ],
            [
                'nama' => 'FOBIA',
                'singkatan' => 'FOBIA',
            ],
            [
                'nama' => 'INDIVIDUALIS',
                'singkatan' => 'INDIVIDUALIS',
            ],
            [
                'nama' => 'KAKU',
                'singkatan' => 'KAKU',
            ],
            [
                'nama' => 'KECEMASAN',
                'singkatan' => 'KECEMASAN',
            ],
            [
                'nama' => 'KERAS KEPALA',
                'singkatan' => 'KERAS KEPALA',
            ],
            [
                'nama' => 'KERJA KURANG SERIUS',
                'singkatan' => 'KERJA KURANG SERIUS',
            ],
            [
                'nama' => 'KURANG DIANDALKAN DALAM BEKERJA',
                'singkatan' => 'KURANG DIANDALKAN DALAM BEKERJA',
            ],
            [
                'nama' => 'KURANG DISIPLIN ',
                'singkatan' => 'KURANG DISIPLIN ',
            ],
            [
                'nama' => 'KURANG ENERGIK',
                'singkatan' => 'KURANG ENERGIK',
            ],
            [
                'nama' => 'KURANG KOMUNIKASI',
                'singkatan' => 'KURANG KOMUNIKASI',
            ],
            [
                'nama' => 'KURANG PENGENDALIAN DIRI',
                'singkatan' => 'KURANG PENGENDALIAN DIRI',
            ],
            [
                'nama' => 'KURANG PUNYA IDE',
                'singkatan' => 'KURANG PUNYA IDE',
            ],
            [
                'nama' => 'KURANG RAPI',
                'singkatan' => 'KURANG RAPI',
            ],
            [
                'nama' => 'KURANG TERATUR',
                'singkatan' => 'KURANG TERATUR',
            ],
            [
                'nama' => 'LAMBAT ATAU LAMBAN',
                'singkatan' => 'LAMBAT ATAU LAMBAN',
            ],
            [
                'nama' => 'MENUNTUT DAN MEMAKSA',
                'singkatan' => 'MENUNTUT DAN MEMAKSA',
            ],
            [
                'nama' => 'MINAT KURANG DAN LEMAH',
                'singkatan' => 'MINAT KURANG DAN LEMAH',
            ],
            [
                'nama' => 'MUDAH BOSAN DAN JENUH',
                'singkatan' => 'MUDAH BOSAN DAN JENUH',
            ],
            [
                'nama' => 'MOTIVASI DAN DORONGAN LEMAH',
                'singkatan' => 'MOTIVASI DAN DORONGAN LEMAH',
            ],
            [
                'nama' => 'MUDAH MENGELUH',
                'singkatan' => 'MUDAH MENGELUH',
            ],
            [
                'nama' => 'SEDIKIT TEMAN',
                'singkatan' => 'SEDIKIT TEMAN',
            ],
            [
                'nama' => 'SIKAP ACUH TAK ACUH',
                'singkatan' => 'SIKAP ACUH TAK ACUH',
            ],
            [
                'nama' => 'SIKAP ANTI SOSIAL ATAU KURANG SOSIALISASI',
                'singkatan' => 'SIKAP ANTI SOSIAL ATAU KURANG SOSIALISASI',
            ],
            [
                'nama' => 'SIKAP CEMBERUT',
                'singkatan' => 'SIKAP CEMBERUT',
            ],
            [
                'nama' => 'SIKAP CEMBURU',
                'singkatan' => 'SIKAP CEMBURU',
            ],
            [
                'nama' => 'SIKAP CENDERUNG DINGIN',
                'singkatan' => 'SIKAP CENDERUNG DINGIN',
            ],
            [
                'nama' => 'SIKAP CENDERUNG KASAR',
                'singkatan' => 'SIKAP CENDERUNG KASAR',
            ],
            [
                'nama' => 'SIKAP CENDERUNG KURANG RAMAH',
                'singkatan' => 'SIKAP CENDERUNG KURANG RAMAH',
            ],
            [
                'nama' => 'SIKAP CENDERUNG MEMUSUHI',
                'singkatan' => 'SIKAP CENDERUNG MEMUSUHI',
            ],
            [
                'nama' => 'SIKAP CENDERUNG SINIS',
                'singkatan' => 'SIKAP CENDERUNG SINIS',
            ],
            [
                'nama' => 'SIKAP CENDERUNG SOMBONG',
                'singkatan' => 'SIKAP CENDERUNG SOMBONG',
            ],
            [
                'nama' => 'SIKAP CENDERUNG TEGANG',
                'singkatan' => 'SIKAP CENDERUNG TEGANG',
            ],
            [
                'nama' => 'SIKAP CEROBOH DAN SEMBRONO',
                'singkatan' => 'SIKAP CEROBOH DAN SEMBRONO',
            ],
            [
                'nama' => 'SIKAP DENDAM',
                'singkatan' => 'SIKAP DENDAM',
            ],
            [
                'nama' => 'SIKAP EGOIS',
                'singkatan' => 'SIKAP EGOIS',
            ],
            [
                'nama' => 'SIKAP FRUSTASI DAN PUTUS ASA',
                'singkatan' => 'SIKAP FRUSTASI DAN PUTUS ASA',
            ],
            [
                'nama' => 'SIKAP IRI HATI',
                'singkatan' => 'SIKAP IRI HATI',
            ],
            [
                'nama' => 'SIKAP JENGKEL',
                'singkatan' => 'SIKAP JENGKEL',
            ],
            [
                'nama' => 'SIKAP KHAWATIR',
                'singkatan' => 'SIKAP KHAWATIR',
            ],
            [
                'nama' => 'SIKAP KERAS',
                'singkatan' => 'SIKAP KERAS',
            ],
            [
                'nama' => 'SIKAP KERJA KURANG KONSENTRASI',
                'singkatan' => 'SIKAP KERJA KURANG KONSENTRASI',
            ],
            [
                'nama' => 'SIKAP KERJA KURANG TELITI',
                'singkatan' => 'SIKAP KERJA KURANG TELITI',
            ],
            [
                'nama' => 'SIKAP SEENAKNYA',
                'singkatan' => 'SIKAP SEENAKNYA',
            ],
            [
                'nama' => 'SIKAP KETAKUTAN',
                'singkatan' => 'SIKAP KETAKUTAN',
            ],
            [
                'nama' => 'SIKAP KURANG BERANI',
                'singkatan' => 'SIKAP KURANG BERANI',
            ],
            [
                'nama' => 'SIKAP KURANG MANDIRI ATAU BERGANTUNG',
                'singkatan' => 'SIKAP KURANG MANDIRI ATAU BERGANTUNG',
            ],
            [
                'nama' => 'SIKAP KURANG PERCAYA DIRI',
                'singkatan' => 'SIKAP KURANG PERCAYA DIRI',
            ],
            [
                'nama' => 'SIKAP KURANG TANGGUNG JAWAB',
                'singkatan' => 'SIKAP KURANG TANGGUNG JAWAB',
            ],
            [
                'nama' => 'SIKAP KURANG TEGAS',
                'singkatan' => 'SIKAP KURANG TEGAS',
            ],
            [
                'nama' => 'SIKAP KURANG TERBUKA',
                'singkatan' => 'SIKAP KURANG TERBUKA',
            ],
            [
                'nama' => 'SIKAP KURANG ATAU TIDAK SETIA',
                'singkatan' => 'SIKAP KURANG ATAU TIDAK SETIA',
            ],
            [
                'nama' => 'SIKAP MARAH',
                'singkatan' => 'SIKAP MARAH',
            ],
            [
                'nama' => 'SIKAP MEMBATASI TUGAS',
                'singkatan' => 'SIKAP MEMBATASI TUGAS',
            ],
            [
                'nama' => 'SIKAP MENYALAHKAN DIRI SENDIRI',
                'singkatan' => 'SIKAP MENYALAHKAN DIRI SENDIRI',
            ],
            [
                'nama' => 'SIKAP MERASA KESEPIAN',
                'singkatan' => 'SIKAP MERASA KESEPIAN',
            ],
            [
                'nama' => 'SIKAP MINDER DAN MENARIK DIRI',
                'singkatan' => 'SIKAP MINDER DAN MENARIK DIRI',
            ],
            [
                'nama' => 'SIKAP MUDAH BIMBANG DAN RAGU-RAGU',
                'singkatan' => 'SIKAP MUDAH BIMBANG DAN RAGU-RAGU',
            ],
            [
                'nama' => 'SIKAP MUDAH BINGUNG',
                'singkatan' => 'SIKAP MUDAH BINGUNG',
            ],
            [
                'nama' => 'SIKAP MUDAH GUGUP DAN TERGESA-GESA',
                'singkatan' => 'SIKAP MUDAH GUGUP DAN TERGESA-GESA',
            ],
            [
                'nama' => 'SIKAP MUDAH SEDIH',
                'singkatan' => 'SIKAP MUDAH SEDIH',
            ],
            [
                'nama' => 'SIKAP MUDAH TERHARU',
                'singkatan' => 'SIKAP MUDAH TERHARU',
            ],
            [
                'nama' => 'SIKAP PEMALU',
                'singkatan' => 'SIKAP PEMALU',
            ],
            [
                'nama' => 'SIKAP PENDIAM',
                'singkatan' => 'SIKAP PENDIAM',
            ],
            [
                'nama' => 'SIKAP PESIMIS',
                'singkatan' => 'SIKAP PESIMIS',
            ],
            [
                'nama' => 'SIKAP SOK BERKUASA',
                'singkatan' => 'SIKAP SOK BERKUASA',
            ],
            [
                'nama' => 'SIKAP SUKA BERONTAK',
                'singkatan' => 'SIKAP SUKA BERONTAK',
            ],
            [
                'nama' => 'SIKAP BERSAING DAN PAMER',
                'singkatan' => 'SIKAP BERSAING DAN PAMER',
            ],
            [
                'nama' => 'SIKAP SUKA MENYENDIRI',
                'singkatan' => 'SIKAP SUKA MENYENDIRI',
            ],
            [
                'nama' => 'SIKAP SULIT ADAPTASI',
                'singkatan' => 'SIKAP SULIT ADAPTASI',
            ],
            [
                'nama' => 'SIKAP TIDAK SABAR',
                'singkatan' => 'SIKAP TIDAK SABAR',
            ],
            [
                'nama' => 'SIKAP LUNAK DAN TERUS MENGALAH',
                'singkatan' => 'SIKAP LUNAK DAN TERUS MENGALAH',
            ],
            [
                'nama' => 'TERLALU DILINDUNGI ATAU TIDAK MANDIRI',
                'singkatan' => 'TERLALU DILINDUNGI ATAU TIDAK MANDIRI',
            ],
            [
                'nama' => 'TIDAK AKTIF DAN MUDAH LELAH',
                'singkatan' => 'TIDAK AKTIF DAN MUDAH LELAH',
            ],
            [
                'nama' => 'TRAUMA',
                'singkatan' => 'TRAUMA',
            ],
            [
                'nama' => 'TOTAL',
                'singkatan' => 'RATA - RATA NILAI NEGATIF',
            ],
            [
                'nama' => 'TOTAL EQ',
                'singkatan' => 'EQ (Emotional Quotient)',
            ],
            [
                'nama' => 'TOTAL SCQ',
                'singkatan' => 'SCQ (Social Quotient)',
            ],
            [
                'nama' => 'TOTAL',
                'singkatan' => 'Saat ini Anda memiliki Gangguan Karakter',
            ],
        ]);


        foreach($dataku as $data){
            // dd($data['nama']);
            DB::table('masterdeteksi')->insert([
                'nama' => $data['nama'],
                'singkatan' => $data['singkatan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
    public function hard(Request $request){
        sekolah::truncate();
        tahun::truncate();
        semester::truncate();
        siswa::truncate();
        walikelas::truncate();
        kelas::truncate();
        pengguna::truncate();
        referensi::truncate();
        masternilaipsikologi::truncate();
        masternilaibidangstudi::truncate();
        catatanprestasisiswa::truncate();
        catatankasussiswa::truncate();
        catatanpengembangandirisiswa::truncate();
        inputnilaipsikologi::truncate();
        minatbakat::truncate();
        minatbakatdetail::truncate();
        yayasandetail::truncate();
        yayasan::truncate();
        DB::table('users')->where('tipeuser','bk')->delete();
        DB::table('users')->where('tipeuser','yayasan')->delete();
        return redirect()->back()->with('status','Hard Reset berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
}
