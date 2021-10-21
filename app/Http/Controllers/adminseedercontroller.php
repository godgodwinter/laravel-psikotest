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

class adminseedercontroller extends Controller
{
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
                'nama' => 'KB%',
                'singkatan' => 'KB%',
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
                'nama' => 'LM%',
                'singkatan' => 'LM%',
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
                'nama' => 'KS%',
                'singkatan' => 'KS%',
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
                'nama' => 'KM%',
                'singkatan' => 'KM%',
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
                'nama' => 'KK%',
                'singkatan' => 'KK%',
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
                'nama' => 'KI%',
                'singkatan' => 'KI%',
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
                'nama' => 'KA%',
                'singkatan' => 'KA%',
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
                'nama' => 'KN%',
                'singkatan' => 'KN%',
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
                'nama' => 'IQ%',
                'singkatan' => 'IQ%',
            ],
            [
                'nama' => 'IQH',
                'singkatan' => 'IQH',
            ],
            [
                'nama' => 'EQ%',
                'singkatan' => 'EQ%',
            ],
            [
                'nama' => 'EQKET',
                'singkatan' => 'EQKET',
            ],
            [
                'nama' => 'SQ%',
                'singkatan' => 'SQ%',
            ],
            [
                'nama' => 'SQKET',
                'singkatan' => 'SQKET',
            ],
            [
                'nama' => 'SCQ%',
                'singkatan' => 'SCQ%',
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
                'nama' => 'APLUS%',
                'singkatan' => 'APLUS%',
            ],
            [
                'nama' => 'APLUSKET',
                'singkatan' => 'APLUSKET',
            ],
            [
                'nama' => 'AMINUS%',
                'singkatan' => 'AMINUS%',
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
                'nama' => 'CPLUS%',
                'singkatan' => 'CPLUS%',
            ],
            [
                'nama' => 'CPLUSKET',
                'singkatan' => 'CPLUSKET',
            ],
            [
                'nama' => 'CMINUS%',
                'singkatan' => 'CMINUS%',
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
                'nama' => 'DPLUS%',
                'singkatan' => 'DPLUS%',
            ],
            [
                'nama' => 'DPLUSKET',
                'singkatan' => 'DPLUSKET',
            ],
            [
                'nama' => 'DMINUS%',
                'singkatan' => 'DMINUS%',
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
                'nama' => 'EPLUS%',
                'singkatan' => 'EPLUS%',
            ],
            [
                'nama' => 'EPLUSKET',
                'singkatan' => 'EPLUSKET',
            ],
            [
                'nama' => 'EMINUS%',
                'singkatan' => 'EMINUS%',
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
                'nama' => 'FPLUS%',
                'singkatan' => 'FPLUS%',
            ],
            [
                'nama' => 'FPLUSKET',
                'singkatan' => 'FPLUSKET',
            ],
            [
                'nama' => 'FMINUS%',
                'singkatan' => 'FMINUS%',
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
                'nama' => 'GPLUS%',
                'singkatan' => 'GPLUS%',
            ],
            [
                'nama' => 'GPLUSKET',
                'singkatan' => 'GPLUSKET',
            ],
            [
                'nama' => 'GMINUS%',
                'singkatan' => 'GMINUS%',
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
                'nama' => 'HPLUS%',
                'singkatan' => 'HPLUS%',
            ],
            [
                'nama' => 'HPLUSKET',
                'singkatan' => 'HPLUSKET',
            ],
            [
                'nama' => 'HMINUS%',
                'singkatan' => 'HMINUS%',
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
                'nama' => 'IPLUS%',
                'singkatan' => 'IPLUS%',
            ],
            [
                'nama' => 'IPLUSKET',
                'singkatan' => 'IPLUSKET',
            ],
            [
                'nama' => 'IMINUS%',
                'singkatan' => 'IMINUS%',
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
                'nama' => 'JPLUS%',
                'singkatan' => 'JPLUS%',
            ],
            [
                'nama' => 'JPLUSKET',
                'singkatan' => 'JPLUSKET',
            ],
            [
                'nama' => 'JMINUS%',
                'singkatan' => 'JMINUS%',
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
                'nama' => 'OPLUS%',
                'singkatan' => 'OPLUS%',
            ],
            [
                'nama' => 'OPLUSKET',
                'singkatan' => 'OPLUSKET',
            ],
            [
                'nama' => 'OMINUS%',
                'singkatan' => 'OMINUS%',
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
                'nama' => 'Q2%',
                'singkatan' => 'Q2%',
            ],
            [
                'nama' => 'Q2KET',
                'singkatan' => 'Q2KET',
            ],
            [
                'nama' => 'Q2MINUS%',
                'singkatan' => 'Q2MINUS%',
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
                'nama' => 'Q3%',
                'singkatan' => 'Q3%',
            ],
            [
                'nama' => 'Q3KET',
                'singkatan' => 'Q3KET',
            ],
            [
                'nama' => 'Q3MINUS%',
                'singkatan' => 'Q3MINUS%',
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
                'nama' => 'Q4%',
                'singkatan' => 'Q4%',
            ],
            [
                'nama' => 'Q4KET',
                'singkatan' => 'Q4KET',
            ],
            [
                'nama' => 'Q4MINUS%',
                'singkatan' => 'Q4MINUS%',
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
                'nama' => 'M1%',
                'singkatan' => 'M1%',
            ],
            [
                'nama' => 'M2',
                'singkatan' => 'M2',
            ],
            [
                'nama' => 'M2%',
                'singkatan' => 'M2%',
            ],
            [
                'nama' => 'M3',
                'singkatan' => 'M3',
            ],
            [
                'nama' => 'M3%',
                'singkatan' => 'M3%',
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
