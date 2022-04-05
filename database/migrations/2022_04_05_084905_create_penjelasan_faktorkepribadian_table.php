<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjelasanFaktorkepribadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjelasan_faktorkepribadian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('namakarakter');
            $table->text('pemahaman');
            $table->text('pembiasaansikap');
            $table->text('tujuandanmanfaat');
            $table->text('tipekarakter'); //positif/negatif
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
        Schema::dropIfExists('penjelasan_faktorkepribadian');
    }
}
