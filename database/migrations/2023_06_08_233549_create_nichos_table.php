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
        Schema::create('nichos', function (Blueprint $table) {
            $table->bigIncrements('id_nic');
            $table->unsignedBigInteger('id_cua');
            $table->string('piso_nic',2);
            $table->string('fila_nic',2);
            $table->string('columna_nic',2);
            $table->boolean('estado_nic');
            $table->foreign('id_cua')->references('id_cua')->on('cuartels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nichos');
    }
};
