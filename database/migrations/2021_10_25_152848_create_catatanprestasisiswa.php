<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanprestasisiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatanprestasisiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siswa_id');
            $table->string('kelas_id');
            $table->string('tanggal');
            $table->string('prestasi');
            $table->string('teknikbelajar');
            $table->string('saranabelajar');
            $table->string('penunjangbelajar');
            $table->string('kesimpulandansaran');
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
        Schema::dropIfExists('catatanprestasisiswa');
    }
}
