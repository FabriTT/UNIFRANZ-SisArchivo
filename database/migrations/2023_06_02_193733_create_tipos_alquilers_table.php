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
        Schema::create('tipos_alquilers', function (Blueprint $table) {
            $table->bigIncrements('id_alq');
            $table->string('nombre_alq',50);
            $table->string('descripcion_alq',150);
            $table->decimal('precio_alq',6,2);
            $table->integer('duracion_alq');
            $table->boolean('estado_alq');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_alquilers');
    }
};
