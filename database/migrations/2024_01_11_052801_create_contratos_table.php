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
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('Id_con');
            $table->date('Fecha_con');
            $table->date('Fecha_fin_con');
            $table->string('Materia_con');
            $table->string('Foto_contrato_con');
            $table->date('Fecha_evaluacion_con')->nullable();
            $table->string('Calificacion_evaluacion_con',50)->nullable();
            $table->string('Foto_evaluacion_con')->nullable();
            $table->unsignedBigInteger('Id_doc');
            $table->boolean('Estado_con');
            $table->foreign('Id_doc')->references('Id_doc')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
