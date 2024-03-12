<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        
        $this->call([
            RoleSeeder::class,  
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Fabricio',
            'paterno' => 'Torrez',
            'materno' => 'Torrez',
            'email' => 'fabricio.torrez1234@gmail.com',
            'carnet' => '12961156',
            'password' => bcrypt('12961156'),
            'telefono' => '78837715',
            'imagen' => '',
            'codigoVerificacion' => '',
            'estado' => '1',
        ])->assignRole('Administrador');

        \App\Models\User::factory()->create([
            'name' => 'Alan',
            'paterno' => 'Aruni',
            'materno' => 'Zuloaga',
            'email' => 'alan4@gmail.com',
            'carnet' => '11111111',
            'password' => bcrypt('Hola@123'),
            'telefono' => '22222222',
            'imagen' => '',
            'codigoVerificacion' => '',
            'estado' => '1',
        ])->assignRole('Escritor');

        \App\Models\User::factory()->create([
            'name' => 'Diego',
            'paterno' => 'Torrez',
            'materno' => 'Torrez',
            'email' => 'diego@gmail.com',
            'carnet' => '22222222',
            'password' => bcrypt('Hola@456'),
            'telefono' => '33333333',
            'imagen' => '',
            'codigoVerificacion' => '',
            'estado' => '1',
        ])->assignRole('Lector');


    }
}
 