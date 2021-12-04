<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropKelasIdOnCatatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catatankasussiswa', function($table) {
           $table->dropColumn('kelas_id');
        });
        Schema::table('catatanpengembangandirisiswa', function($table) {
           $table->dropColumn('kelas_id');
        });
        Schema::table('catatanprestasisiswa', function($table) {
           $table->dropColumn('kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
