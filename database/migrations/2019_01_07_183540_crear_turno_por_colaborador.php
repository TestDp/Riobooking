<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTurnoPorColaborador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Tbl_Turno_Por_Colaborador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Cita_id')->unsigned();
            $table->foreign("Cita_id")->references('id')->on('Tbl_Citas');
            $table->integer('Colaborador_id')->unsigned();
            $table->foreign("Colaborador_id")->references('id')->on('Tbl_Colaborador');
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
          Schema::dropIfExists('Tbl_TipoServicio_Por_Colaborador');
    }
}
