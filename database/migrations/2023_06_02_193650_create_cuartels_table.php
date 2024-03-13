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
        Schema::create('cuartels', function (Blueprint $table) {
            $table->bigIncrements('id_cua');
            $table->string('nombres_cua',50);
            $table->string('tipoPersona_cua',40);
            $table->decimal('descuento_cua',3,2);
            $table->integer('capacidad_cua');
            $table->integer('pisos_cua');
            $table->integer('nfilas_cua');
            $table->integer('ncolumnas_cua');
            $table->decimal('latitud_cua',9,7);
            $table->decimal('longitud_cua',9,7);
            $table->string('sector_cua',30);
            $table->string('calle_cua',30);
            $table->boolean('estado_cua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuartels');
    }
};
