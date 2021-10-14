<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class oneseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ADMIN SEEDER
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('perpus123'),
            // 'password' => '$2y$10$oOhE/tcF8MC9crGCw/Zv5.zFMGu0JLm591undChCaHJM6YrnGjgCu',
            'tipeuser' => 'admin',
            'nomerinduk' => '123',
            'username' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


        //KEPSEK SEEDER
        DB::table('users')->insert([
            'name' => 'Pustakawan',
            'email' => 'pustakawan@gmail.com',
            'password' => Hash::make('perpus123'),
            'tipeuser' => 'pustakawan',
            'nomerinduk' => '111',
            'username' => 'pustakawan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);




        //Siswa SEEDER
        DB::table('siswa')->insert([
            'nama' => 'Paijo',
            'kelas_nama' => 'VII A',
            'tempatlahir' => 'Malang',
            'tgllahir' => '2003-05-20',
            'alamat' => 'Desa Sumbersari Kecamatan Losari Kabupaten Trenggalek',
            'nis' => '1',
            'jk' => 'Laki-laki',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);



        //KATEGORI SEEDER
        DB::table('kategori')->insert([
            'nama' => 'Agama',
            'prefix' => 'ddc',
            'kode' => '1-200',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kategori')->insert([
             'nama' => 'Bahasa',
             'prefix' => 'ddc',
             'kode' => '201-400',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
          ]);

          DB::table('kategori')->insert([
              'nama' => 'Sejarah',
              'prefix' => 'ddc',
              'kode' => '401-600',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
           ]);


          DB::table('kategori')->insert([
            'nama' => 'Teknologi',
            'prefix' => 'ddc',
            'kode' => '601-800',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


          DB::table('kategori')->insert([
            'nama' => 'Siswa',
            'prefix' => 'tipeanggota',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kategori')->insert([
           'nama' => 'Umum',
           'prefix' => 'tipeanggota',
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
        ]);


        DB::table('kategori')->insert([
            'nama' => 'Bagus',
            'prefix' => 'kondisi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kategori')->insert([
            'nama' => 'Layak',
            'prefix' => 'kondisi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

        DB::table('kategori')->insert([
            'nama' => 'Tidak Layak',
            'prefix' => 'kondisi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kategori')->insert([
             'nama' => 'Umum',
             'prefix' => 'tipeperalatan',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
          ]);


         //KELAS SEEDER
        DB::table('kelas')->insert([
            'nama' => 'VI IA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         //KELAS SEEDER
        DB::table('kelas')->insert([
            'nama' => 'VII B',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         //KELAS SEEDER
        DB::table('kelas')->insert([
            'nama' => 'VIII A',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);
         //KELAS SEEDER
        DB::table('kelas')->insert([
            'nama' => 'VIII B',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         //settings SEEDER
        DB::table('settings')->insert([
            'paginationjml' => '10',
            'sekolahnama' => 'SMP ABCD 01 Malang',
            'kop1' => 'YAYASAN PENDIDIKAN ISLAM',
            'kop2' => 'MTS SHIROTHUL FUQOHA',
            'kop3' => 'KENDAL PAYAK - KECAMATAN PAKISAJI - KABUPATEN MALANG',
            'kop4' => 'Alamat : Jl. Kendalpayak No.98 Pakisaji - Malang',
            'sekolahalamat' => 'Alamat : Jl. Kendalpayak No.98 Pakisaji - Malang',
            'sekolahtelp' => '0341-123456',
            'aplikasijudul' => 'PERPUSTAKAAN',
            'aplikasijudulsingkat' => 'SP',
            'defaultdenda' => '7000',
            'defaultminbayar' => '100',
            'defaultmaxbukupinjam' => '10',
            'defaultmaxharipinjam' => '7',
            'passdefaultpegawai' => 'perpus123',
            'passdefaultadmin' => 'perpus123',
            'sekolahlogo' => '',
            'sekolahttd' => 'Kepala Perpustakaan',
            'sekolahttd2' => 'Nama Kepala Sekolah M.Pd', //masih konsep
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


    }
}
