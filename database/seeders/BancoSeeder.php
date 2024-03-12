<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banco::create(['Nombre_ban' => 'Banco Naciona del Bolivia BNB']);
        Banco::create(['Nombre_ban' => 'Banco Union']);
        Banco::create(['Nombre_ban' => 'Banco Mercantil Santa Cruz']);
        Banco::create(['Nombre_ban' => 'Banco BISA']);
        Banco::create(['Nombre_ban' => 'Banco de Credito']);
        Banco::create(['Nombre_ban' => 'Banco Ganadero']);
        Banco::create(['Nombre_ban' => 'Banco Economico de Bolivia']);
        Banco::create(['Nombre_ban' => 'Banco Sol']);
        Banco::create(['Nombre_ban' => 'Asociacion de Bancos Privados de Bolivia ASOBAN']);
        Banco::create(['Nombre_ban' => 'Banco Central de Bolivia BCB']);

    }
}
