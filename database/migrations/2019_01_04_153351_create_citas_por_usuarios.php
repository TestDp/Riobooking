<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasPorUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Tbl_Citas_Por_Usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Cita_id')->unsigned();
            $table->foreign("Cita_id")->references('id')->on('Tbl_Citas');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
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
          Schema::dropIfExists('Tbl_Citas_Por_Usuarios');
    }
}
