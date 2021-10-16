<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasternilaipsikologiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masternilaipsikologi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('singkatan');
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
        Schema::dropIfExists('masternilaipsikologi');
    }
}
