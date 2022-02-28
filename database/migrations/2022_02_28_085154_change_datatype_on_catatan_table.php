<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeOnCatatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catatankasussiswa', function (Blueprint $table) {
            $table->text('kasus')->change();
            $table->text('pengambilandata')->change();
            $table->text('sumberkasus')->change();
            $table->text('golkasus')->change();
            $table->text('penyebabtimbulkasus')->change();
            $table->text('teknikkonseling')->change();
            $table->text('keberhasilanpenanganankasus')->change();
            $table->text('keterangan')->change();
        });

        Schema::table('catatanpengembangandirisiswa', function (Blueprint $table) {
            $table->text('idedanimajinasi')->change();
            $table->text('ketrampilan')->change();
            $table->text('kreatif')->change();
            $table->text('organisasi')->change();
            $table->text('kelanjutanstudi')->change();
            $table->text('hobi')->change();
            $table->text('citacita')->change();
            $table->text('kemampuankhusus')->change();
            $table->text('keterangan')->change();
        });

        Schema::table('catatanprestasisiswa', function (Blueprint $table) {
            $table->text('prestasi')->change();
            $table->text('teknikbelajar')->change();
            $table->text('saranabelajar')->change();
            $table->text('penunjangbelajar')->change();
            $table->text('kesimpulandansaran')->change();
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
