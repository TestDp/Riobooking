<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoComentarioCitasPorUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_Citas_Por_Usuarios', function (Blueprint $table)
        {
                $table->string('Comentario1',200)->nullable();
                $table->string('Comentario2',200)->nullable();
                $table->integer('Estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
