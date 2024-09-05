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

        DB::table('noticias')->insert([[
            'titular' => 'La Xunta activa una campaña para alertar sobre los riesgos del manejo del tractor en el rural',
            'destacado' => 'la-xunta-activa-una-campana-para-alertar-sobre-los-riesgos-del-manejo-del-tractor-en-el-rural0.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'la-xunta-activa-una-campana-para-alertar-sobre-los-riesgos-del-manejo-del-tractor-en-el-rural0',
            'multimedia' => '/noticias/local/2024/09/la-xunta-activa-una-campana-para-alertar-sobre-los-riesgos-del-manejo-del-tractor-en-el-rural0',
            'activo' => 1,
        ],[
            'titular' => 'Valentín García agradece el compromiso de Coca-Cola para promover el uso de la lengua',
            'destacado' => 'valentin-garcia-agradece-el-compromiso-de-coca-cola-para-promover-el-uso-de-la-lengua0.png',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'valentin-garcia-agradece-el-compromiso-de-coca-cola-para-promover-el-uso-de-la-lengua0',
            'multimedia' => '/noticias/local/2024/09/valentin-garcia-agradece-el-compromiso-de-coca-cola-para-promover-el-uso-de-la-lengua0',
            'activo' => 1,
        ],[
            'titular' => 'Tres personas heridas luego de una explosión en un depósito de gas en Ourense',
            'destacado' => 'tres-personas-heridas-luego-de-una-explosion-en-un-deposito-de-gas-en-ourense0.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'tres-personas-heridas-luego-de-una-explosion-en-un-deposito-de-gas-en-ourense0',
            'multimedia' => '/resources/noticias/local/2024/09/tres-personas-heridas-luego-de-una-explosion-en-un-deposito-de-gas-en-ourense0',
            'activo' => 1,
        ],[
            'titular' => 'El programa Vigo Emprega contrata a 75 personas',
            'destacado' => 'el-programa-vigo-emprega-contrata-a-75-personas0.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'el-programa-vigo-emprega-contrata-a-75-personas0',
            'multimedia' => '/noticias/local/2024/09/el-programa-vigo-emprega-contrata-a-75-personas0',
            'activo' => 1,
        ],[
            'titular' => 'Debate de investidura de Rueda 9 y 11 de abril, toma de posesión el día 13',
            'destacado' => 'debate-de-investidura-de-rueda-9-y-11-de-abril-toma-de-posesion-el-dia-130.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'debate-de-investidura-de-rueda-9-y-11-de-abril-toma-de-posesion-el-dia-130',
            'multimedia' => '/noticias/local/2024/09/debate-de-investidura-de-rueda-9-y-11-de-abril-toma-de-posesion-el-dia-130',
            'activo' => 1,
        ],[
            'titular' => 'Rueda garantiza que la lucha contra el cambio climático será una prioridad',
            'destacado' => 'rueda-garantiza-que-la-lucha-contra-el-cambio-climatico-sera-una-prioridad0.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'rueda-garantiza-que-la-lucha-contra-el-cambio-climatico-sera-una-prioridad0',
            'multimedia' => '/noticias/local/2024/09/rueda-garantiza-que-la-lucha-contra-el-cambio-climatico-sera-una-prioridad0',
            'activo' => 1,
        ],[
            'titular' => 'Carballo pone en marcha un proyecto de recuperación de variedades autóctonas de árboles frutales',
            'destacado' => 'carballo-pone-en-marcha-un-proyecto-de-recuperacion-de-variedades-autoctonas-de-arboles-frutales0.jpg',
            'categoria' => '1',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'carballo-pone-en-marcha-un-proyecto-de-recuperacion-de-variedades-autoctonas-de-arboles-frutales0',
            'multimedia' => '/noticias/local/2024/09/carballo-pone-en-marcha-un-proyecto-de-recuperacion-de-variedades-autoctonas-de-arboles-frutales0',
            'activo' => 1,
        ],[
            'titular' => 'El Supremo mantiene la orden nacional de detención contra Puigdemont',
            'destacado' => 'el-supremo-mantiene-la-orden-nacional-de-detencion-contra-puigdemont0.jpg',
            'categoria' => '2',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'el-supremo-mantiene-la-orden-nacional-de-detencion-contra-puigdemont0',
            'multimedia' => '/noticias/nacional/2024/09/el-supremo-mantiene-la-orden-nacional-de-detencion-contra-puigdemont0',
            'activo' => 1,
        ],[
            'titular' => 'Sanidad se compromete a comenzar a reducir las guardias médicas de 24 a 17 horas',
            'destacado' => 'sanidad-se-compromete-a-comenzar-a-reducir-las-guardias-medicas-de-24-a-17-horas0.jpg',
            'categoria' => '2',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'sanidad-se-compromete-a-comenzar-a-reducir-las-guardias-medicas-de-24-a-17-horas0',
            'multimedia' => '/noticias/nacional/2024/09/sanidad-se-compromete-a-comenzar-a-reducir-las-guardias-medicas-de-24-a-17-horas0',
            'activo' => 1,
        ],[
            'titular' => 'Varios detenidos tras el registro de la casa de Rubiales y de la Federación',
            'destacado' => 'varios-detenidos-tras-el-registro-de-la-casa-de-rubiales-y-de-la-federacion0.jpg',
            'categoria' => '2',
            'ano' => '2024',
            'mes' => '09',
            'escritor' => '1',
            'slug' => 'varios-detenidos-tras-el-registro-de-la-casa-de-rubiales-y-de-la-federacion0',
            'multimedia' => '/noticias/nacional/2024/09/varios-detenidos-tras-el-registro-de-la-casa-de-rubiales-y-de-la-federacion0',
            'activo' => 1,
        ]
        ]);
    }
}
