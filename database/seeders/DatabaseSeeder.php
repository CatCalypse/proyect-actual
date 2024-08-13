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
            ['rol' => 'administrador',],
            ['rol' => 'escritor',],
            ['rol' => 'usuario',],
        ]);


        DB::table('usuarios')->insert([
            'nombre' => 'test',
            'apellidos' => 'test',
            'correo' => 'test@test',
            'rol' => 2,
            'usuario' => 'test',
            'password' => Hash::make('test'),
            'activo' => true,
        ]);
    }
}
