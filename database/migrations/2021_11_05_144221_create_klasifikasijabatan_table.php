<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlasifikasijabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasijabatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bidang')->nullable();
            $table->string('akademis')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nilaistandart')->nullable();
            $table->string('iqstandart')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('bidangstudi')->nullable();
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('klasifikasijabatan');
    }
}
