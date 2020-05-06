<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaColaborador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('Tbl_Colaborador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre');
            $table->string('Nickname');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
            $table->string('ImagenColaborador');
            $table->integer('Calificacion');
            $table->boolean('Activo')->default(1);
            $table->string('telefono',50)->nullable;
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
         Schema::dropIfExists('Tbl_Colaborador');
    }
}
