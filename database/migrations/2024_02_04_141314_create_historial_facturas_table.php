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
        Schema::create('historial_facturas', function (Blueprint $table) {
            $table->bigIncrements('Id_hfac');
            $table->date('FechaInicio_hfac');
            $table->date('FechaFin_hfac')->nullable();
            $table->string('Estado_hfac',50);
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
        Schema::dropIfExists('historial_facturas');
    }
};
