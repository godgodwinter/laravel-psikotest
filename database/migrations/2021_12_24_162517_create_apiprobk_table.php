<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiprobkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apiprobk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('sertifikat')->nullable(); //status -> belum / sukses / gagal
            $table->string('sertifikat_tgl')->nullable(); //tgl backup
            $table->string('deteksi')->nullable(); //status -> belum / sukses / gagal
            $table->string('deteksi_tgl')->nullable(); //tgl sinkron
            $table->string('sinkron')->nullable(); //status -> belum / sukses / gagal
            $table->string('sinkron_tgl')->nullable(); //tgl sinkron
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
        Schema::dropIfExists('apiprobk');
    }
}
