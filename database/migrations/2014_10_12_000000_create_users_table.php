<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_team', function (Blueprint $table) {
            $table->increments('team_id');
            $table->string('team_username');
            $table->string('team_password');
            $table->string('team_textpass');
            $table->string('team_type');
            $table->rememberToken();

            $table->unique('team_username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_team');
    }
}
