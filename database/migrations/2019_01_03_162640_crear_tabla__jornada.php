<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaJornada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Jornadas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Fecha');
            $table->date('FechaFin');
            $table->time('Inicio');
            $table->time('Fin');
            $table->integer('Descanso');
            $table->string('Lugar',100);
            $table->integer('Cupos');
            //$table->integer('Tipo_Cita_id')->unsigned();
            //$table->foreign('Tipo_Cita_id')->references('id')->on('Tbl_Tipos_Citas');
            $table->integer('Regional_id')->unsigned();
            $table->foreign('Regional_id')->references('id')->on('Tbl_Regionales');
            $table->timestamps();
            $table->unique(['Fecha','Regional_id', 'Lugar', 'Inicio','Fin'],'jornada_indice_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tbl_Jornadas');
    }
}
