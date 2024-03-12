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
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('Id_doc');
            $table->unsignedBigInteger('Id_nac');
            $table->unsignedBigInteger('Id_ban')->nullable();
            $table->string('Nombres_doc',50);
            $table->string('Paterno_doc',50);
            $table->string('Materno_doc',50);
            $table->date('Fecha_Nacimiento_doc');
            $table->string('Carnet_doc',8)->unique();
            $table->date('VencimientoCarnet_doc');
            $table->string('Sexo_doc',1);
            $table->string('Direccion_doc',100);
            $table->string('CorreoPersonal_doc',100)->unique();
            $table->string('CorreoCoorporativo_doc',100)->unique();
            $table->string('TelefonoParticular_doc',10)->nullable()->unique();
            $table->string('Celular_doc',8)->unique();
            $table->string('Foto_Carnet_doc');
            $table->string('Foto_Nacimiento_doc');
            //CONTACTOS DE EMERGENCIA
            $table->string('EmergenciaNombres_doc',50);
            $table->string('EmergenciaPaterno_doc',50);
            $table->string('EmergenciaMaterno_doc',50);
            $table->string('EmergenciaGrado_doc',50);
            $table->string('EmergenciaCelular_doc',8);
            //CUENTA BANCARIA
            $table->string('NumeroCuenta_doc',30)->nullable()->unique();
            $table->boolean('Factura_doc')->nullable();
            $table->string('Foto_Cuenta_doc')->nullable();
            //FORMACION
            $table->string('Profesion_doc',100)->nullable();
            $table->date('Fecha_titulo_doc')->nullable();
            $table->string('Foto_titulo_doc')->nullable();
            $table->string('GradoAcademico_doc',50)->nullable();
            $table->date('Fecha_provision_nacional_doc')->nullable();
            $table->string('Foto_provision_nacional_doc')->nullable();
            $table->date('Fecha_educacion_superior_doc')->nullable();
            $table->string('Foto_educacion_superior_doc')->nullable();
            
            //EXPERIENCIA LABORAL
            $table->string('Foto_curriculum_doc')->nullable();
            $table->string('Años_experiencia_doc')->nullable();
            $table->string('Foto_experiencia_doc')->nullable();

            //CLASE MODELO
            $table->date('Fecha_clase_modelo_doc')->nullable();
            $table->string('Foto_clase_modelo_doc')->nullable();
            $table->date('Fecha_evaluar_doc')->nullable();
            $table->string('Foto_evaluar_doc')->nullable();
            $table->string('Calificacion_evaluar_doc',3)->nullable();
            

            $table->boolean('Estado_doc');
            $table->foreign('Id_nac')->references('Id_nac')->on('nacionalidads');
            $table->foreign('Id_ban')->references('Id_ban')->on('bancos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
