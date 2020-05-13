<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CrearTablaSedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('Tbl_Sedes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre',100)->unique();
            $table->boolean('activa')->default(1);
            $table->timestamps();
            $table->integer('Compania_id')->unsigned();
            $table->foreign('Compania_id')->references('id')->on('Tbl_Companias');

             
            // $table->integer('Regional_id')->unsigned();
             //$table->foreign('Regional_id')->references('id')->on('Tbl_Regionales');

           // $table->unique(['Regional_id','id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('Tbl_Sedes');
    }
}
