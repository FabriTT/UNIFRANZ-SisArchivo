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
        Schema::create('mausoleos', function (Blueprint $table) {
            $table->bigIncrements('id_mau');
            $table->string('nombre_mau',50);
            $table->string('descripcion_mau',100);
            $table->integer('capacidad_mau');
            $table->decimal('latitud_cua',9,7);
            $table->decimal('longitud_cua',9,7);
            $table->string('sector_mau',30);
            $table->string('calle_mau',30);
            $table->boolean('estadoCompra_mau');
            $table->boolean('estado_mau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mausoleos');
    }
};
