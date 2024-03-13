<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Cargo;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car1=new Cargo;
        $car1->id_car='AUSE';
        $car1->descripcion_car='Administrador de usuarios';
        $car1->save();

        $car2=new Cargo;
        $car2->id_car='ADCG';
        $car2->descripcion_car='Administrador del cementerio';
        $car2->save();

        $car5=new Cargo;
        $car5->id_car='AVEN';
        $car5->descripcion_car='Administrador de ventas';
        $car5->save();

        $car6=new Cargo;
        $car6->id_car='ASEG';
        $car6->descripcion_car='Administrador de seguridad';
        $car6->save();

        $car7=new Cargo;
        $car7->id_car='SUDO';
        $car7->descripcion_car='Super usuario';
        $car7->save();

        $car8=new Cargo;
        $car8->id_car='CLIE';
        $car8->descripcion_car='Cliente regular';
        $car8->save();
    }
}
