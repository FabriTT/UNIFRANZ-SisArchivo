<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Actas;

class ActaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $act1=new Actas;
        $act1->id_use=2;
        $act1->nombres_act='Alonso Antonio';
        $act1->paterno_act='Perales';
        $act1->materno_act='Buckridge';
        $act1->edad_act='45';
        $act1->partida_act='2003-05-08';
        $act1->provincia_act='Murillo';
        $act1->departamento_act='La Paz';
        $act1->pais_act='Bolivia';
        $act1->causaMuerte_act='Paro cardiaco';
        $act1->drNombre_act="Diana";
        $act1->drPaterno_act="Marquez";
        $act1->drMaterno_act="Torres";
        $act1->drCarnet_act="74748585";
        $act1->relacion_act="Madre";
        $act1->fosa_act=1;
        $act1->estado_act=1;
        $act1->save();

        $act2=new Actas;
        $act2->id_use=3;
        $act2->nombres_act='Pedro ronaldo';
        $act2->paterno_act='Fisher';
        $act2->materno_act='Quispe';
        $act2->edad_act='38';
        $act2->partida_act='1999-11-18';
        $act2->provincia_act='Murillo';
        $act2->departamento_act='La Paz';
        $act2->pais_act='Bolivia';
        $act2->causaMuerte_act='Neumonia';
        $act2->drNombre_act="Paolo";
        $act2->drPaterno_act="Sanchez";
        $act2->drMaterno_act="Curz";
        $act2->drCarnet_act="96963232";
        $act2->relacion_act="Padre";
        $act2->fosa_act=1;
        $act2->estado_act=1;
        $act2->save();

        $act3=new Actas;
        $act3->id_use=3;
        $act3->nombres_act='Susan';
        $act3->paterno_act='Cruz';
        $act3->materno_act='Sullcata';
        $act3->edad_act='49';
        $act3->partida_act='1988-10-08';
        $act3->provincia_act='Murillo';
        $act3->departamento_act='La Paz';
        $act3->pais_act='Bolivia';
        $act3->causaMuerte_act='Accidente cerebrovascular';
        $act3->drNombre_act="Diana";
        $act3->drPaterno_act="Marquez";
        $act3->drMaterno_act="Torres";
        $act3->drCarnet_act="74748585";
        $act3->relacion_act="Tio";
        $act3->fosa_act=1;
        $act3->estado_act=1;
        $act3->save();

        $act4=new Actas;
        $act4->id_use=4;
        $act4->nombres_act='Alicia Britany';
        $act4->paterno_act='Carrera';
        $act4->materno_act='Pueblo';
        $act4->edad_act='55';
        $act4->partida_act='1991-03-08';
        $act4->provincia_act='Murillo';
        $act4->departamento_act='La Paz';
        $act4->pais_act='Bolivia';
        $act4->causaMuerte_act='Paro cardiaco';
        $act4->drNombre_act="Pedro";
        $act4->drPaterno_act="Casas";
        $act4->drMaterno_act="Tapia";
        $act4->drCarnet_act="45854585";
        $act4->relacion_act="Primo";
        $act4->fosa_act=1;
        $act4->estado_act=1;
        $act4->save();

    }

}
