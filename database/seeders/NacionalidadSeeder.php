<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nacionalidad;

class NacionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nacionalidad::create(['Nombre_nac' => 'Argentina']);
        Nacionalidad::create(['Nombre_nac' => 'Boliviana']);
        Nacionalidad::create(['Nombre_nac' => 'Brasileña']);
        Nacionalidad::create(['Nombre_nac' => 'Chilena']);
        Nacionalidad::create(['Nombre_nac' => 'Colombiana']);
        Nacionalidad::create(['Nombre_nac' => 'Ecuatoriana']);
        Nacionalidad::create(['Nombre_nac' => 'Paraguaya']);
        Nacionalidad::create(['Nombre_nac' => 'Peruana']);
        Nacionalidad::create(['Nombre_nac' => 'Uruguaya']);
        Nacionalidad::create(['Nombre_nac' => 'Venezolana']);
    }
}
