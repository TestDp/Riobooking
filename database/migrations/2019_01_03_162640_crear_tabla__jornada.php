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
            $table->time('Inicio');     
            $table->time('Fin');   
             $table->integer('Descanso');  
            $table->string('Lugar',100);
            $table->integer('Cupos');
          // $table->integer('TipoCita');
            //$table->boolean('EstadoReserva')->default(0);



            //$table->integer('User_id')->unsigned()->nullable;
           // $table->foreign('User_id')->references('id')->on('Tbl_Users');

            $table->integer('Tipo_Cita_id')->unsigned();
            $table->foreign('Tipo_Cita_id')->references('id')->on('Tbl_Tipos_Citas');

            //$table->integer('Compania_id')->unsigned();
            //$table->foreign('Compania_id')->references('id')->on('Tbl_Companias');

            $table->integer('Regional_id')->unsigned();
            $table->foreign('Regional_id')->references('id')->on('Tbl_Regionales');

            //$table->integer('Sede_id')->unsigned()->nullable;
            //$table->foreign('Sede_id')->references('id')->on('Tbl_Sedes');

               $table->timestamps();

             $table->unique(['Fecha', 'Tipo_Cita_id','Regional_id', 'Lugar', 'Inicio','Fin'],'jornada_indice_fk');
      
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
