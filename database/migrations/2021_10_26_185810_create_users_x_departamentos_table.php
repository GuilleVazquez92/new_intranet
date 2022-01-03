<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersXDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_x_departamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('iduser');
            $table->integer('iddepartamento');
            $table->timestamps();
        

            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('iddepartamento')->references('id')->on('departamentos');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_x_departamentos');
    }
}
