<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        User::factory(10)->create();
        */
        $us1=new User;
        $us1->name='Fabricio Gabriel';
        $us1->paterno='Torrez';
        $us1->materno='Torrez';
        $us1->carnet='12961156';
        $us1->nacimiento='2002-02-19';
        $us1->telefono='78837715';
        $us1->imagen='avatar.jpg';
        $us1->email='fabricio.torrez1234@gmail.com';
        $us1->email_verified_at=now();
        $us1->password=sha1('12961156');
        $us1->remember_token="6Y7p9B2rT5";
        $us1->estado=1;
        $us1->save();
        
    }
}
