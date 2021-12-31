<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiprobkDeteksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apiprobk_deteksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('apiprobk_id')->nullable();
            $table->string('kunci')->nullable(); //key
            $table->longText('isi')->nullable(); //value
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
        Schema::dropIfExists('apiprobk_deteksi');
    }
}
