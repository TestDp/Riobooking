<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('Tbl_Regionales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre',100);
            $table->boolean('Activa')->default(1);

            $table->integer('Compania_id')->unsigned();
            $table->foreign('Compania_id')->references('id')->on('Tbl_Companias');

            
           // $table->integer('Sede_id')->unsigned()->nullable;
           // $table->foreign("Sede_id")->references('id')->on('Tbl_Sedes');

            $table->timestamps();

            $table->unique(['Compania_id','Nombre']);
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tbl_Regionales');
    }
}
