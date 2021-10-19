<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiedOnSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('jeniskelamin')->nullable();
            $table->string('tempatlahir')->nullable();
            $table->string('tanggallahir')->nullable();
            $table->string('usia')->nullable();
            $table->string('warganegara')->nullable();
            $table->string('agama')->nullable();
            $table->string('anak')->nullable();
            $table->string('kandung')->nullable();
            $table->string('angkat')->nullable();
            $table->string('tiri')->nullable();
            $table->string('statusanak')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('nohp')->nullable();
            $table->string('tinggal')->nullable();
            $table->string('jarak')->nullable();
            $table->string('goldar')->nullable();
            $table->string('kelainan')->nullable();
            $table->string('tinggibadan')->nullable();
            $table->string('beratbadan')->nullable();
            $table->string('tamatan')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('lamabelajar')->nullable();
            $table->string('pindahan')->nullable();
            $table->string('alasan')->nullable();
            $table->string('namaayah')->nullable();
            $table->string('tempatayah')->nullable();
            $table->string('tanggallahirayah')->nullable();
            $table->string('agamaayah')->nullable();
            $table->string('warganegaraayah')->nullable();
            $table->string('pendidikanayah')->nullable();
            $table->string('pekerjaanayah')->nullable();
            $table->longText('alamatayah')->nullable();
            $table->string('nomorayah')->nullable();
            $table->string('statusayah')->nullable();
            $table->string('namaibu')->nullable();
            $table->string('tempatibu')->nullable();
            $table->string('tanggallahiribu')->nullable();
            $table->string('agamaibu')->nullable();
            $table->string('warganegaraibu')->nullable();
            $table->string('pendidikanibu')->nullable();
            $table->string('pekerjaanibu')->nullable();
            $table->string('penghasilanibu')->nullable();
            $table->longText('alamatibu')->nullable();
            $table->string('nomoribu')->nullable();
            $table->string('statusibu')->nullable();
            $table->string('namawali')->nullable();
            $table->string('tempatwali')->nullable();
            $table->string('tanggallahirwali')->nullable();
            $table->string('agamawali')->nullable();
            $table->string('warganegarawali')->nullable();
            $table->string('pendidikanwali')->nullable();
            $table->string('pekerjaanwali')->nullable();
            $table->string('penghasilanwali')->nullable();
            $table->longText('alamatwali')->nullable();
            $table->string('nomorwali')->nullable();
            $table->string('statuswali')->nullable();
            $table->string('hobi')->nullable();
            $table->string('organisasi')->nullable();
            $table->string('setelahlulus')->nullable();

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
