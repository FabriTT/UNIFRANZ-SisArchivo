<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Asignacion;

class AsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $as1=new Asignacion;
        $as1->id_use=1;
        $as1->id_car='SUDO';
        $as1->estado_asi=1;
        $as1->save();

        $as2=new Asignacion;
        $as2->id_use=1;
        $as2->id_car='CLIE';
        $as2->estado_asi=1;
        $as2->save();
        /*
        $as3=new Asignacion;
        $as3->id_use=2;
        $as3->id_car='AUSE';
        $as3->estado_asi=1;
        $as3->save();

        $as4=new Asignacion;
        $as4->id_use=3;
        $as4->id_car='ADCG';
        $as4->estado_asi=1;
        $as4->save();

        $as5=new Asignacion;
        $as5->id_use=4;
        $as5->id_car='ADCG';
        $as5->estado_asi=1;
        $as5->save();

        $as6=new Asignacion;
        $as6->id_use=5;
        $as6->id_car='AVEN';
        $as6->estado_asi=1;
        $as6->save();

        $as7=new Asignacion;
        $as7->id_use=6;
        $as7->id_car='ASEG';
        $as7->estado_asi=1;
        $as7->save();
        */
    }
}
