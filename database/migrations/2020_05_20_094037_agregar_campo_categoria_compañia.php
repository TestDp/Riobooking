<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoCategoriaCompañia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_Companias', function (Blueprint $table) {
            $table->integer('Categoria_id')->nullable()->unsigned();
            $table->foreign("Categoria_id")->references('id')->on('Tbl_Categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tbl_Companias', function (Blueprint $table) {
            //
        });
    }
}
