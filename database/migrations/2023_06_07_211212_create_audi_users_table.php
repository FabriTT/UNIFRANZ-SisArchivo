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
        Schema::create('audi_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paterno',25);
            $table->string('materno',25);
            $table->string('carnet',8);
            $table->date('nacimiento');
            $table->string('telefono',8);
            $table->string('imagen');
            $table->string('email');
            $table->string('password');
            $table->boolean('estado');
            $table->string('usuario');
            $table->string('accion');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audi_users');
    }
};
