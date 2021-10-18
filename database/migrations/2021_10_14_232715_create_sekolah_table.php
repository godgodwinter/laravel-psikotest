<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('status'); //jika nonaktif bk tidak bisa login
            $table->string('kepsek_nama')->nullable();
            $table->longText('kepsek_photo')->nullable();
            $table->string('tahunajaran_nama')->nullable();
            $table->string('semester_nama')->nullable();
            $table->longText('sekolah_logo')->nullable();
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
        Schema::dropIfExists('sekolah');
    }
}
