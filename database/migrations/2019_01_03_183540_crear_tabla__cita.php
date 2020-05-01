<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('Tbl_Citas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Fecha');
            $table->time('Inicio');     
            $table->time('Fin');   
            // $table->string('diagnostico',1000)->nullable;
            //$table->string('Lugar',100)->unique();
            //$table->char('Cupos', 2)->nullable;
            //$table->integer('TipoCita');
            $table->boolean('EstadoReserva')->default(0);
             $table->boolean('Asistencia')->default(0);
             $table->boolean('Anulada')->default(0);
             // $table->string('telefono',50)->nullable;

                    

           // $table->integer('User_id')->unsigned()->nullable;
           // $table->foreign('User_id')->references('id')->on('Tbl_Users');

            $table->integer('Jornada_id')->unsigned();
            $table->foreign('Jornada_id')->references('id')->on('Tbl_Jornadas');

           // $table->integer('Compania_id')->unsigned();
          // $table->foreign('Compania_id')->references('id')->on('Tbl_Companias');

          

           // $table->integer('Gerencia_id')->unsigned();
          // $table->foreign('Gerencia_id')->references('id')->on('Tbl_Gerencias');

           // $table->integer('Regional_id')->unsigned();
           // $table->foreign('Regional_id')->references('id')->on('Tbl_Regionales');

               $table->timestamps();

             $table->unique(['Fecha', 'Inicio','Fin','Jornada_id']);
      


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('Tbl_Citas');
    }
}
