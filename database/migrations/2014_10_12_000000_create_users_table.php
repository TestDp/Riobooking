<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('username',15);
            $table->string('email');
            $table->boolean('activo')->default(1);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('Sede_id')->unsigned();
            $table->foreign('Sede_id')->references('id')->on('Tbl_Sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
