<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\masternilaibidangstudi;
use App\Models\masternilaipsikologi;
use App\Models\minatbakat;
use App\Models\pengguna;
use App\Models\referensi;
use App\Models\sekolah;
use App\Models\semester;
use App\Models\siswa;
use App\Models\tahun;
use App\Models\walikelas;
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
            $nomerinduk=$faker->unique()->ean8;
            DB::table('siswa')->insert([
                'nama' => $nama,
                'nomerinduk' => $nomerinduk,
                'sekolah_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

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

                $ambilwali=DB::table('walikelas')->orderBy('id','desc')->where('sekolah_id',$id)->first();


                $nama=$faker->unique()->company;
                DB::table('kelas')->insert([
                    'nama' => $nama,
                    // 'tipe' => $faker->randomElement(['Umum', 'Khusus']),
                    'walikelas_id' => $ambilwali->id,
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
                'nama' => 'KB',
                'singkatan' => 'KB',
            ],
            [
                'nama' => 'KB_P',
                'singkatan' => 'KB_P',
            ],
            [
                'nama' => 'KBH',
                'singkatan' => 'KBH',
            ],
            [
                'nama' => 'LM',
                'singkatan' => 'LM',
            ],
            [
                'nama' => 'LM_P',
                'singkatan' => 'LM_P',
            ],
            [
                'nama' => 'LMH',
                'singkatan' => 'LMH',
            ],
            [
                'nama' => 'KS',
                'singkatan' => 'KS',
            ],
            [
                'nama' => 'KS_P',
                'singkatan' => 'KS_P',
            ],
            [
                'nama' => 'KSH',
                'singkatan' => 'KSH',
            ],
            [
                'nama' => 'KM',
                'singkatan' => 'KM',
            ],
            [
                'nama' => 'KM_P',
                'singkatan' => 'KM_P',
            ],
            [
                'nama' => 'KM',
                'singkatan' => 'KM',
            ],
            [
                'nama' => 'KMH',
                'singkatan' => 'KMH',
            ],
            [
                'nama' => 'KK',
                'singkatan' => 'KK',
            ],
            [
                'nama' => 'KK_P',
                'singkatan' => 'KK_P',
            ],
            [
                'nama' => 'KKH',
                'singkatan' => 'KKH',
            ],
            [
                'nama' => 'KI',
                'singkatan' => 'KI',
            ],
            [
                'nama' => 'KI_P',
                'singkatan' => 'KI_P',
            ],
            [
                'nama' => 'KIH',
                'singkatan' => 'KIH',
            ],
            [
                'nama' => 'KA',
                'singkatan' => 'KA',
            ],
            [
                'nama' => 'KM',
                'singkatan' => 'KM',
            ],
            [
                'nama' => 'KA_P',
                'singkatan' => 'KA_P',
            ],
            [
                'nama' => 'KAH',
                'singkatan' => 'KAH',
            ],
            [
                'nama' => 'KN',
                'singkatan' => 'KN',
            ],
            [
                'nama' => 'KN_P',
                'singkatan' => 'KN_P',
            ],
            [
                'nama' => 'KNH',
                'singkatan' => 'KNH',
            ],
            [
                'nama' => 'TTL',
                'singkatan' => 'TTL',
            ],
            [
                'nama' => 'IQ',
                'singkatan' => 'IQ',
            ],
            [
                'nama' => 'IQ_P',
                'singkatan' => 'IQ_P',
            ],
            [
                'nama' => 'IQH',
                'singkatan' => 'IQH',
            ],
            [
                'nama' => 'EQ_P',
                'singkatan' => 'EQ_P',
            ],
            [
                'nama' => 'EQKET',
                'singkatan' => 'EQKET',
            ],
            [
                'nama' => 'SQ_P',
                'singkatan' => 'SQ_P',
            ],
            [
                'nama' => 'SQKET',
                'singkatan' => 'SQKET',
            ],
            [
                'nama' => 'SCQ_P',
                'singkatan' => 'SCQ_P',
            ],
            [
                'nama' => 'SCQKET',
                'singkatan' => 'SCQKET',
            ],
            [
                'nama' => 'KBH',
                'singkatan' => 'KBH',
            ],
            [
                'nama' => 'LMH',
                'singkatan' => 'LMH',
            ],
            [
                'nama' => 'KSH',
                'singkatan' => 'KSH',
            ],
            [
                'nama' => 'KMH',
                'singkatan' => 'KMH',
            ],
            [
                'nama' => 'KKH',
                'singkatan' => 'KKH',
            ],
            [
                'nama' => 'KIH',
                'singkatan' => 'KIH',
            ],
            [
                'nama' => 'KAH',
                'singkatan' => 'KAH',
            ],
            [
                'nama' => 'KNH',
                'singkatan' => 'KNH',
            ],
            [
                'nama' => 'IQH',
                'singkatan' => 'IQH',
            ],
            [
                'nama' => 'P1',
                'singkatan' => 'P1',
            ],
            [
                'nama' => 'P9',
                'singkatan' => 'P9',
            ],
            [
                'nama' => 'KR',
                'singkatan' => 'KR',
            ],
            [
                'nama' => 'A',
                'singkatan' => 'A',
            ],
            [
                'nama' => 'APLUS_P',
                'singkatan' => 'APLUS_P',
            ],
            [
                'nama' => 'APLUSKET',
                'singkatan' => 'APLUSKET',
            ],
            [
                'nama' => 'AMINUS_P',
                'singkatan' => 'AMINUS_P',
            ],
            [
                'nama' => 'AMINUSKET',
                'singkatan' => 'AMINUSKET',
            ],
            [
                'nama' => 'C',
                'singkatan' => 'C',
            ],
            [
                'nama' => 'CPLUS_P',
                'singkatan' => 'CPLUS_P',
            ],
            [
                'nama' => 'CPLUSKET',
                'singkatan' => 'CPLUSKET',
            ],
            [
                'nama' => 'CMINUS_P',
                'singkatan' => 'CMINUS_P',
            ],
            [
                'nama' => 'CMINUSKET',
                'singkatan' => 'CMINUSKET',
            ],
            [
                'nama' => 'D',
                'singkatan' => 'D',
            ],
            [
                'nama' => 'DPLUS_P',
                'singkatan' => 'DPLUS_P',
            ],
            [
                'nama' => 'DPLUSKET',
                'singkatan' => 'DPLUSKET',
            ],
            [
                'nama' => 'DMINUS_P',
                'singkatan' => 'DMINUS_P',
            ],
            [
                'nama' => 'DMINUSKET',
                'singkatan' => 'DMINUSKET',
            ],
            [
                'nama' => 'E',
                'singkatan' => 'E',
            ],
            [
                'nama' => 'EPLUS_P',
                'singkatan' => 'EPLUS_P',
            ],
            [
                'nama' => 'EPLUSKET',
                'singkatan' => 'EPLUSKET',
            ],
            [
                'nama' => 'EMINUS_P',
                'singkatan' => 'EMINUS_P',
            ],
            [
                'nama' => 'EMINUSKET',
                'singkatan' => 'EMINUSKET',
            ],
            [
                'nama' => 'F',
                'singkatan' => 'F',
            ],
            [
                'nama' => 'FPLUS_P',
                'singkatan' => 'FPLUS_P',
            ],
            [
                'nama' => 'FPLUSKET',
                'singkatan' => 'FPLUSKET',
            ],
            [
                'nama' => 'FMINUS_P',
                'singkatan' => 'FMINUS_P',
            ],
            [
                'nama' => 'FMINUSKET',
                'singkatan' => 'FMINUSKET',
            ],
            [
                'nama' => 'G',
                'singkatan' => 'G',
            ],
            [
                'nama' => 'GPLUS_P',
                'singkatan' => 'GPLUS_P',
            ],
            [
                'nama' => 'GPLUSKET',
                'singkatan' => 'GPLUSKET',
            ],
            [
                'nama' => 'GMINUS_P',
                'singkatan' => 'GMINUS_P',
            ],
            [
                'nama' => 'GMINUSKET',
                'singkatan' => 'GMINUSKET',
            ],
            [
                'nama' => 'H',
                'singkatan' => 'H',
            ],
            [
                'nama' => 'HPLUS_P',
                'singkatan' => 'HPLUS_P',
            ],
            [
                'nama' => 'HPLUSKET',
                'singkatan' => 'HPLUSKET',
            ],
            [
                'nama' => 'HMINUS_P',
                'singkatan' => 'HMINUS_P',
            ],
            [
                'nama' => 'HMINUSKET',
                'singkatan' => 'HMINUSKET',
            ],
            [
                'nama' => 'I',
                'singkatan' => 'I',
            ],
            [
                'nama' => 'IPLUS_P',
                'singkatan' => 'IPLUS_P',
            ],
            [
                'nama' => 'IPLUSKET',
                'singkatan' => 'IPLUSKET',
            ],
            [
                'nama' => 'IMINUS_P',
                'singkatan' => 'IMINUS_P',
            ],
            [
                'nama' => 'IMINUSKET',
                'singkatan' => 'IMINUSKET',
            ],
            [
                'nama' => 'J',
                'singkatan' => 'J',
            ],
            [
                'nama' => 'JPLUS_P',
                'singkatan' => 'JPLUS_P',
            ],
            [
                'nama' => 'JPLUSKET',
                'singkatan' => 'JPLUSKET',
            ],
            [
                'nama' => 'JMINUS_P',
                'singkatan' => 'JMINUS_P',
            ],
            [
                'nama' => 'JMINUSKET',
                'singkatan' => 'JMINUSKET',
            ],
            [
                'nama' => 'O',
                'singkatan' => 'O',
            ],
            [
                'nama' => 'OPLUS_P',
                'singkatan' => 'OPLUS_P',
            ],
            [
                'nama' => 'OPLUSKET',
                'singkatan' => 'OPLUSKET',
            ],
            [
                'nama' => 'OMINUS_P',
                'singkatan' => 'OMINUS_P',
            ],
            [
                'nama' => 'OMINUSKET',
                'singkatan' => 'OMINUSKET',
            ],
            [
                'nama' => 'Q2',
                'singkatan' => 'Q2',
            ],
            [
                'nama' => 'Q2_P',
                'singkatan' => 'Q2_P',
            ],
            [
                'nama' => 'Q2KET',
                'singkatan' => 'Q2KET',
            ],
            [
                'nama' => 'Q2MINUS_P',
                'singkatan' => 'Q2MINUS_P',
            ],
            [
                'nama' => 'Q2MINUSKET',
                'singkatan' => 'Q2MINUSKET',
            ],
            [
                'nama' => 'Q3',
                'singkatan' => 'Q3',
            ],
            [
                'nama' => 'Q3_P',
                'singkatan' => 'Q3_P',
            ],
            [
                'nama' => 'Q3KET',
                'singkatan' => 'Q3KET',
            ],
            [
                'nama' => 'Q3MINUS_P',
                'singkatan' => 'Q3MINUS_P',
            ],
            [
                'nama' => 'Q3MINUSKET',
                'singkatan' => 'Q3MINUSKET',
            ],
            [
                'nama' => 'Q4',
                'singkatan' => 'Q4',
            ],
            [
                'nama' => 'Q4_P',
                'singkatan' => 'Q4_P',
            ],
            [
                'nama' => 'Q4KET',
                'singkatan' => 'Q4KET',
            ],
            [
                'nama' => 'Q4MINUS_P',
                'singkatan' => 'Q4MINUS_P',
            ],
            [
                'nama' => 'Q4MINUSKET',
                'singkatan' => 'Q4MINUSKET',
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
                'nama' => 'M1',
                'singkatan' => 'M1',
            ],
            [
                'nama' => 'M1_P',
                'singkatan' => 'M1_P',
            ],
            [
                'nama' => 'M2',
                'singkatan' => 'M2',
            ],
            [
                'nama' => 'M2_P',
                'singkatan' => 'M2_P',
            ],
            [
                'nama' => 'M3',
                'singkatan' => 'M3',
            ],
            [
                'nama' => 'M3_P',
                'singkatan' => 'M3_P',
            ],
            [
                'nama' => 'IPA',
                'singkatan' => 'IPA',
            ],
            [
                'nama' => 'IPS',
                'singkatan' => 'IPS',
            ],
            [
                'nama' => 'BHS',
                'singkatan' => 'BHS',
            ],
            [
                'nama' => 'AGM',
                'singkatan' => 'AGM',
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
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tipe Bakat.1',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'CITA.2/Minat.2',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tipe Bakat.2',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'CITA.3/Minat.3',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tipe Bakat.3',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_1',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_2',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'Tambahan CITA_CITA_3',
                'kategori' => 'Minat',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMP',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_1_FAKULTAS',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_1_PRODI',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_2_FAKULTAS',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_2_PRODI',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'STUDI_LANJUT_SMA_SMK_KEDINASAN',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMA/MA',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK1',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK2',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'JURUSAN_LANJUT_SMK3',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Disarankan studi SMA/MA/SMK',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Jurusan SMA/MA',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Jur SMK(BK/Bidg keahlian)',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'SMK (PK/Program keahlian)',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Jur.Disarankan SMA/MA',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Jur.Dipertimbangkan SMA/MA',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'Jur.Tdk.Disarankan SMA/MA',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'D / S.1 Disarankan Fakultas',
                'kategori' => 'Penjurusan',
            ],
            [
                'nama' => 'D / S.1 Disarankan Prodi',
                'kategori' => 'Penjurusan',
            ],
        ]);


        foreach($dataku as $data){
            // dd($data['nama']);
            DB::table('minatbakat')->insert([
                'nama' => $data['nama'],
                'kategori' => $data['kategori'],
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
        DB::table('users')->where('tipeuser','bk')->delete();
        DB::table('users')->where('tipeuser','yayasan')->delete();
        return redirect()->back()->with('status','Hard Reset berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
}
