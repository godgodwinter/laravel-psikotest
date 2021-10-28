<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanpengembangandirisiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatanpengembangandirisiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siswa_id');
            $table->string('kelas_id');
            $table->string('tanggal');
            $table->string('idedanimajinasi');
            $table->string('ketrampilan');
            $table->string('kreatif');
            $table->string('organisasi');
            $table->string('kelanjutanstudi');
            $table->string('hobi');
            $table->string('citacita');
            $table->string('kemampuankhusus');
            $table->string('keterangan');
            $table->string('sekolah_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catatanpengembangandirisiswa');
    }
}
