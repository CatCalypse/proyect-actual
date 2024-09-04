<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('roles')->insert([
            ['rol' => 'Administrador',],
            ['rol' => 'Escritor',],
            ['rol' => 'Usuario',],
        ]);


        DB::table('usuarios')->insert([[
            'nombre' => 'admin',
            'apellidos' => 'admin',
            'correo' => 'admin@yopmail',
            'rol' => 1,
            'usuario' => 'admin',
            'password' => Hash::make('1234'),
            'activo' => true,
        ],[
            'nombre' => 'escritor',
            'apellidos' => 'escritor',
            'correo' => 'escritor@yopmail',
            'rol' => 2,
            'usuario' => 'escritor',
            'password' => Hash::make('1234'),
            'activo' => true,
        ]]);



        DB::table('categorias')->insert([
            ['categoria' => 'Local',],
            ['categoria' => 'Nacional',],
            ['categoria' => 'Internacional',],
        ]);

    }
}
