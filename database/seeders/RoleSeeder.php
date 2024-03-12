<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Escritor']);
        $role3 = Role::create(['name' => 'Lector']);

        //Administracion de usuarios
        Permission::create(['name' => 'usuario'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'saveUsuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'updateUsuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'disabledUsuario'])->syncRoles([$role1]);

        //Administracion de empleados
        Permission::create(['name' => 'docente'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'saveDocente'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'updateDocente'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarArchivo'])->syncRoles([$role1]);

        Permission::create(['name' => 'saveNacionalidad'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarNacionalidad'])->syncRoles([$role1]);

        //Historial de desactivacion
        Permission::create(['name' => 'historialDesactivacion'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'saveDesactivacion'])->syncRoles([$role1]);
        Permission::create(['name' => 'enabledDocente'])->syncRoles([$role1]);

        //Administracion de cuentas bancarias
        Permission::create(['name' => 'saveBanco'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'updateBanco'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarBanco'])->syncRoles([$role1]);

        //Administracion de formacion academica
        Permission::create(['name' => 'updateFormacion'])->syncRoles([$role1,$role2]);

        //Administracion de titulos complementarios
        Permission::create(['name' => 'saveTitulo'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarTiulo'])->syncRoles([$role1]);

        //Administracion de experiencia laboral
        Permission::create(['name' => 'updateExperiencia'])->syncRoles([$role1,$role2]);

        //Administracion de clase modelo
        Permission::create(['name' => 'updateClase_modelo'])->syncRoles([$role1,$role2]);

        //Administracion de documentos complementaios
        Permission::create(['name' => 'saveDocumento'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarDocumento'])->syncRoles([$role1]);

        //Administracion de contratos
        Permission::create(['name' => 'saveContrato'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'saveEvaluacion'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'borrarContrato'])->syncRoles([$role1]);

        //Backup
        Permission::create(['name' => 'backup'])->syncRoles([$role1]);
    }
}
