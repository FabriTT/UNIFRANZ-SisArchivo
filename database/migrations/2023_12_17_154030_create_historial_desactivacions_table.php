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
        Schema::create('historial_desactivacions', function (Blueprint $table) {
            $table->bigIncrements('Id_des');
            $table->unsignedBigInteger('Id_doc');
            $table->string('Motivo_des',100);
            $table->string('Clasificacion_des',20);
            $table->foreign('Id_doc')->references('Id_doc')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_desactivacions');
    }
};
