<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKeteranganToKeteranganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keterangan', function (Blueprint $table) {
            $table->dropColumn('beasiswa');
            $table->integer('spp');
            $table->integer('uanggedung');
            $table->integer('alatpraktek');
            $table->integer('seragam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keterangan', function (Blueprint $table) {
            //
        });
    }
}
