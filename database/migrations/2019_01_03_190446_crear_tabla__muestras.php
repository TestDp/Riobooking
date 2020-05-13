<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMuestras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('Tbl_Muestras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Fecha');
            $table->string('last_name');
            $table->string('username',15)->unique();
            $table->Integer('Edad');
            $table->char('Sexo', 2);
            $table->string('TipoTrabajo',100);
            $table->Integer('TEN_ART_SIST');
            $table->Integer('TEN_ART_DIAS');
            $table->Integer('GLICEMIA');
            $table->Integer('COLESTEROL_TOTAL');
            $table->Integer('TRIGLICERIDOS');
            $table->Integer('HDL');
            $table->Integer('COLESTEROL_LDL');
            $table->Integer('IMC');
            $table->Integer('P_A');
            $table->Integer('TIEMPO_MINS');
            $table->Integer('SES_SEMANALES');
            $table->Integer('TABACO_MES');
            $table->string('FUMA_PASIVO',200);
            $table->Integer('ALCOHOL_COP_SEM');
            $table->string('ANT_CARDIOVASCULARES',500);
            $table->string('FRAMIGHAM10',10);
            $table->Integer('PORC_GRASA');
            $table->Integer('EVOL_POR_GRASA');
            $table->Integer('TALLA');
            $table->Integer('PESO');

    
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references('id')->on('users');

            //$table->integer('Compania_id')->unsigned();
            //$table->foreign('Compania_id')->references('id')->on('Tbl_Companias');


            //$table->integer('Regional_id')->unsigned();
            //$table->foreign('Regional_id')->references('id')->on('Tbl_Regionales');

            
            $table->integer('Gerencia_id')->unsigned();
            $table->foreign('Gerencia_id')->references('id')->on('Tbl_Gerencias');

            $table->integer('Cita_id')->unsigned()->nullable;
            $table->foreign('Cita_id')->references('id')->on('Tbl_Citas');

            
             $table->timestamps();

             $table->unique(['Fecha', 'User_id']);
           



        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tbl_Muestras');
    }
}
