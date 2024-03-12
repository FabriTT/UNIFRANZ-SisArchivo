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
        Schema::create('titulos_complementarios', function (Blueprint $table) {
            $table->bigIncrements('Id_tit');
            $table->string('Tipo_tit',50);
            $table->string('Descripcion_tit',100);
            $table->date('Fecha_tit');
            $table->string('Fotocopia_tit');
            $table->unsignedBigInteger('Id_doc');
            $table->foreign('Id_doc')->references('Id_doc')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulos_complementarios');
    }
};
