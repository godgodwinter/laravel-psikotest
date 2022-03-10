<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referensi', function (Blueprint $table) {
            $table->text('nama')->change();
            $table->text('link')->change();
        });
        Schema::table('informasipsikologi', function (Blueprint $table) {
            $table->text('nama')->change();
            $table->text('link')->change();
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
