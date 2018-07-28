<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_flag', function (Blueprint $table) {
            $table->increments('flag_id');
            $table->unsignedInteger('soal_id');
            $table->unsignedInteger('team_id');
            $table->string('flag_text');
            $table->string('flag_isActive');
            $table->string('flag_submitter')->nullable();
            $table->string('flag_timestamp')->nullable();

            $table->foreign('soal_id')->references('soal_id')->on('tb_soal');
            $table->foreign('team_id')->references('team_id')->on('tb_team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_flag');
    }
}
