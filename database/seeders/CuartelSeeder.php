<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Cuartel;

class CuartelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cua1=new Cuartel;
        $cua1->nombres_cua='Cuartel 1';
        $cua1->tipoPersona_cua='Publico';
        $cua1->descuento_cua=0.0;
        $cua1->capacidad_cua=120;
        $cua1->pisos_cua=0;
        $cua1->nfilas_cua=6;
        $cua1->ncolumnas_cua=20;
        $cua1->latitud_cua=-16.4964702;
        $cua1->longitud_cua=-68.1528497;
        $cua1->sector_cua='Ampliacion';
        $cua1->calle_cua='Via A';
        $cua1->estado_cua=1;
        $cua1->save();

        $cua2=new Cuartel;
        $cua2->nombres_cua='Cuartel 2';
        $cua2->tipoPersona_cua='Publico';
        $cua2->descuento_cua=0.0;
        $cua2->capacidad_cua=120;
        $cua2->pisos_cua=0;
        $cua2->nfilas_cua=6;
        $cua2->ncolumnas_cua=20;
        $cua2->latitud_cua=-16.4964599;
        $cua2->longitud_cua=-68.1529409;
        $cua2->sector_cua='Ampliacion';
        $cua2->calle_cua='Via B';
        $cua2->estado_cua=1;
        $cua2->save();

        $cua3=new Cuartel;
        $cua3->nombres_cua='Cuartel jubilados';
        $cua3->tipoPersona_cua='Privado';
        $cua3->descuento_cua=0.15;
        $cua3->capacidad_cua=240;
        $cua3->pisos_cua=1;
        $cua3->nfilas_cua=6;
        $cua3->ncolumnas_cua=20;
        $cua3->latitud_cua=-16.4963673;
        $cua3->longitud_cua=-68.1515138;
        $cua3->sector_cua='Antiguo';
        $cua3->calle_cua='Via C';
        $cua3->estado_cua=1;
        $cua3->save();

        $cua4=new Cuartel;
        $cua4->nombres_cua='Cuartel guerra del chaco';
        $cua4->tipoPersona_cua='Privado';
        $cua4->descuento_cua=0.19;
        $cua4->capacidad_cua=360;
        $cua4->pisos_cua=2;
        $cua4->nfilas_cua=6;
        $cua4->ncolumnas_cua=20;
        $cua4->latitud_cua=-16.4963725;
        $cua4->longitud_cua=-68.1514388;
        $cua4->sector_cua='Antiguo';
        $cua4->calle_cua='Via A';
        $cua4->estado_cua=1;
        $cua4->save();
    }
}
