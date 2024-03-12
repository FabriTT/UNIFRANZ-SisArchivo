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
        Schema::create('documentos_complementarios', function (Blueprint $table) {
            $table->bigIncrements('Id_com');
            $table->string('Tipo_com',50);
            $table->string('Descripcion_com',100);
            $table->date('Fecha_com');
            $table->string('Fotocopia_com');
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
        Schema::dropIfExists('documentos_complementarios');
    }
};
