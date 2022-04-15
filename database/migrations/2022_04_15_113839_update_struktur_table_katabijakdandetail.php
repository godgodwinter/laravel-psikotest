<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStrukturTableKatabijakdandetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('katabijakdetail', 'judul')) {
            Schema::table('katabijakdetail', function ($table) {
                $table->dropColumn('judul');
            });
        }

        // if (Schema::hasColumn('yayasan', 'katabijak_id')) {
        //     Schema::table('yayasan', function ($table) {
        //         $table->dropColumn('katabijak_id');
        //     });
        // }

        // if (Schema::hasColumn('katabijakdetail', 'katabijak_id')) {
        //     Schema::table('katabijakdetail', function ($table) {
        //         $table->dropColumn('katabijak_id');
        //     });
        // }

        Schema::table('katabijakdetail', function (Blueprint $table) {
            $table->string('katabijak_id')
                ->before('created_at')->nullable();
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
