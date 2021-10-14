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
        DB::table('users')->truncate();
        //ADMIN SEEDER
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            // 'password' => '$2y$10$oOhE/tcF8MC9crGCw/Zv5.zFMGu0JLm591undChCaHJM6YrnGjgCu',
            'tipeuser' => 'admin',
            'nomerinduk' => '123',
            'username' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


        //BK SEEDER
        DB::table('users')->insert([
            'name' => 'bk',
            'email' => 'bk@gmail.com',
            'password' => Hash::make('12345678'),
            'tipeuser' => 'bk',
            'nomerinduk' => '111',
            'username' => 'bk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);



        //BK SEEDER
        DB::table('users')->insert([
            'name' => 'yayasan',
            'email' => 'yayasan@gmail.com',
            'password' => Hash::make('12345678'),
            'tipeuser' => 'yayasan',
            'nomerinduk' => '111',
            'username' => 'yayasan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('settings')->truncate();
         //settings SEEDER
        DB::table('settings')->insert([
            'app_nama' => 'Nama App',
            'app_namapendek' => 'St',
            'paginationjml' => '10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


    }
}
