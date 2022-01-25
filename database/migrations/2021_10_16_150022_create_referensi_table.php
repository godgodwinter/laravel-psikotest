<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('tipe');
            $table->string('link')->nullable();
            $table->string('jenis')->nullable();
            $table->string('file')->nullable();
            // $table->string('sekolah_id');
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
        Schema::dropIfExists('referensi');
    }
}
