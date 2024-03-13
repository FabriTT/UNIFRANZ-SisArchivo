<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->bigIncrements('id_act');
            $table->unsignedBigInteger('id_use');
            $table->string('nombres_act',50);
            $table->string('paterno_act',40);
            $table->string('materno_act',40);
            $table->string('edad_act',3);
            $table->date('partida_act');
            $table->string('provincia_act',50);
            $table->string('departamento_act',20);
            $table->string('pais_act',30);
            $table->string('causaMuerte_act',50);
            $table->string('drNombre_act',50);
            $table->string('drPaterno_act',50);
            $table->string('drMaterno_act',50);
            $table->string('drCarnet_act',8);
            $table->string('relacion_act',20);
            $table->boolean('fosa_act');
            $table->boolean('estado_act');
            $table->foreign('id_use')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
