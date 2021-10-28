<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatankasussiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatankasussiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siswa_id');
            $table->string('kelas_id');
            $table->string('kasus');
            $table->string('tanggal');
            $table->string('pengambilandata');
            $table->string('sumberkasus');
            $table->string('golkasus');
            $table->string('penyebabtimbulkasus');
            $table->string('teknikkonseling');
            $table->string('keberhasilanpenanganankasus');
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
        Schema::dropIfExists('catatankasussiswa');
    }
}
