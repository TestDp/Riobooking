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

            $table->integer('Compania_id')->unsigned();
            $table->foreign('Compania_id')->references('id')->on('Tbl_Companias');
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
