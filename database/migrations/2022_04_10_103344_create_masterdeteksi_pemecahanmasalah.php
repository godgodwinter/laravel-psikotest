<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterdeteksiPemecahanmasalah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterdeteksi_pemecahanmasalah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masterdeteksi_id');
            $table->float('batasbawah');
            $table->float('batasatas');
            $table->text('keterangan');
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
        Schema::dropIfExists('masterdeteksi_pemecahanmasalah');
    }
}
