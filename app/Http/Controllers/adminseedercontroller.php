<?php

namespace App\Http\Controllers;

use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
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
                'nama' => 'eqh',
                'singkatan' => 'eqh',
            ],
            [
                'nama' => 'sq_persen',
                'singkatan' => 'sq_persen',
            ],
            [
                'nama' => 'sqh',
                'singkatan' => 'sqh',
            ],
            [
                'nama' => 'scq_persen',
                'singkatan' => 'scq_persen',
            ],
            [
                'nama' => 'scqh',
                'singkatan' => 'scqh',
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
                'nama' => 'A.Kepri.Terkuat.1',
                'singkatan' => 'A.Kepri.Terkuat.1',
            ],
            [
                'nama' => 'A.Kepri.Terkuat.2',
                'singkatan' => 'A.Kepri.Terkuat.2',
            ],
            [
                'nama' => 'A.Kepri.Terkuat.3',
                'singkatan' => 'A.Kepri.Terkuat.3',
            ],
            [
                'nama' => 'A.Kepri.Terkuat.4',
                'singkatan' => 'A.Kepri.Terkuat.4',
            ],
            [
                'nama' => 'A.Kepri.Terkuat.5',
                'singkatan' => 'A.Kepri.Terkuat.5',
            ],
            [
                'nama' => 'Positif.rank.1',
                'singkatan' => 'Positif.rank.1',
            ],
            [
                'nama' => 'Positif.rank.2',
                'singkatan' => 'Positif.rank.2',
            ],
            [
                'nama' => 'Positif.rank.3',
                'singkatan' => 'Positif.rank.3',
            ],
            [
                'nama' => 'Positif.rank.4',
                'singkatan' => 'Positif.rank.4',
            ],
            [
                'nama' => 'Positif.rank.5',
                'singkatan' => 'Positif.rank.5',
            ],
            [
                'nama' => 'Negatif.rank.1',
                'singkatan' => 'Negatif.rank.1',
            ],
            [
                'nama' => 'Negatif.rank.2',
                'singkatan' => 'Negatif.rank.2',
            ],
            [
                'nama' => 'Negatif.rank.3',
                'singkatan' => 'Negatif.rank.3',
            ],
            [
                'nama' => 'Negatif.rank.4',
                'singkatan' => 'Negatif.rank.4',
            ],
            [
                'nama' => 'Negatif.rank.5',
                'singkatan' => 'Negatif.rank.5',
            ],
            [
                'nama' => 'M1%',
                'singkatan' => 'M1%',
            ],
            [
                'nama' => 'M2%',
                'singkatan' => 'M2%',
            ],
            [
                'nama' => 'M3%',
                'singkatan' => 'M3%',
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
                'nama' => 'CITA.1/Minat.1',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'CITA.2/Minat.2',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'CITA.3/Minat.3',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_1',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_2',
                'kategori' => 'Minat dan Bakat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_3',
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
                'nama' => 'Tipe Bakat.1',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Tipe Bakat.2',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Tipe Bakat.3',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMP',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_1_FAKULTAS',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_1_PRODI',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_2_FAKULTAS',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_2_PRODI',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_KEDINASAN',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMA/MA',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK1',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK2',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK3',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Disarankan studi SMA/MA/SMK',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Jurusan SMA/MA',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Jur SMK(BK/Bidg keahlian)',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'SMK (PK/Program keahlian)',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Jur.Disarankan SMA/MA',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Jur.Dipertimbangkan SMA/MA',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'Jur.Tdk.Disarankan SMA/MA',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'D / S.1 Disarankan Fakultas',
                'kategori' => 'Bakat dan Penjurusan',
            ],
            [
                'nama' => 'D / S.1 Disarankan Prodi',
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
