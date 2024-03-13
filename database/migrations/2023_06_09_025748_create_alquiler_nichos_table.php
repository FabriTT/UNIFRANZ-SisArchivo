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
        Schema::create('alquiler_nichos', function (Blueprint $table) {
            $table->bigIncrements('id_alni');
            $table->unsignedBigInteger('id_nic');
            $table->unsignedBigInteger('id_cli');
            $table->unsignedBigInteger('id_act');
            $table->unsignedBigInteger('id_emp');
            $table->unsignedBigInteger('id_alq');
            $table->boolean('estado_alni');
            $table->foreign('id_nic')->references('id_nic')->on('nichos');
            $table->foreign('id_emp')->references('id')->on('users');
            $table->foreign('id_cli')->references('id')->on('users');
            $table->foreign('id_act')->references('id_act')->on('actas');
            $table->foreign('id_alq')->references('id_alq')->on('tipos_alquilers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler_nichos');
    }
};
