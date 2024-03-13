<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\TiposAlquiler;

class TipoAlquilerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alq1=new TiposAlquiler;
        $alq1->nombre_alq='Inhumamacion sector Antiguo 1ra, 5ta o 6ta fila ';
        $alq1->descripcion_alq='Se compone de inhumanacion y obturacion';
        $alq1->precio_alq=132.3;
        $alq1->duracion_alq=5;
        $alq1->estado_alq=1;
        $alq1->save();

        $alq2=new TiposAlquiler;
        $alq2->nombre_alq='Inhumamacion sector Antiguo 2da o 3ra fila ';
        $alq2->descripcion_alq='Se compone de inhumanacion y obturacion';
        $alq2->precio_alq=385.5;
        $alq2->duracion_alq=5;
        $alq2->estado_alq=1;
        $alq2->save();

        $alq3=new TiposAlquiler;
        $alq3->nombre_alq='Inhumamacion sector Antiguo 4ta fila';
        $alq3->descripcion_alq='Se compone de inhumanacion y obturacion';
        $alq3->precio_alq=328.3;
        $alq3->duracion_alq=5;
        $alq3->estado_alq=1;
        $alq3->save();
    }
}
