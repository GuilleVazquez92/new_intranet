<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticaEntregas extends Migration
{
    

    public function up()
    {
        Schema::create('logistica_entregas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('carrito');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('observacion')->nullable();
            $table->integer('estado');
            $table->string('motivo')->nullable();
            $table->date('created');
            $table->double('longitud')->nullable();
            $table->double('latitud')->nullable();
            $table->integer('user');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('
            logistica_entregas');
    }
}
