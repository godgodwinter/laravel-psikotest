<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\masternilaibidangstudi;
use App\Models\masternilaipsikologi;
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
                'nama' => 'IQ',
                'singkatan' => 'IQ',
            ],
            [
                'nama' => 'EQ',
                'singkatan' => 'EQ',
            ],
            [
                'nama' => 'SQ',
                'singkatan' => 'SQ',
            ],
            [
                'nama' => 'KB',
                'singkatan' => 'KB',
            ],
            [
                'nama' => 'LM',
                'singkatan' => 'LM',
            ],
            [
                'nama' => 'KS',
                'singkatan' => 'KS',
            ],
            [
                'nama' => 'KM',
                'singkatan' => 'KM',
            ],
            [
                'nama' => 'KK',
                'singkatan' => 'KK',
            ],
            [
                'nama' => 'KI',
                'singkatan' => 'KI',
            ],
            [
                'nama' => 'KA',
                'singkatan' => 'KA',
            ],
            [
                'nama' => 'KM',
                'singkatan' => 'KM',
            ]
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
