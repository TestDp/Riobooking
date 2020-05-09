<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Se elimina data incial de tablas, antes de volver a llenar data en ellas  */
        $this->truncateTables([
            'users',
            'Tbl_Tipos_Documento',
            'Tbl_Tipos_Citas',
            'Tbl_Sedes',
            'Tbl_Roles_Por_Usuarios',
            'Tbl_Roles',
            'Tbl_Regionales',
            'Tbl_Recursos_Sistemas_Por_Rol',
            'Tbl_Recursos_Sistemas',
            'Tbl_Muestras',
            'Tbl_Jornadas',
            'Tbl_Gerencias',
            'Tbl_Companias',
            'Tbl_Citas_Por_Usuarios',
            'Tbl_Citas',
            'password_resets',
        ]);

         /* Invocar metodo iterativo de llamada a Seeders en el orden adecuado*/
         $this->CallSeeders([
            CompaniasSeeder::class,
             RegionalSeeder::class,
             SedesSeeder::class,
            RecursosSistemasSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            RolesUsuarioSeeder::class,
            RecursosSistemasRolSeeder::class,
         ]);
    }

    /* Metodo iterativo para invocar seeders  */
    public function CallSeeders(array $classSeeders)
    {
         /* Ejecutar cada uno de los seeders: */
        foreach ($classSeeders as $classSeeder) 
        {
            $this->call($classSeeder);
        }
    }

    /* Metodo iterativo para eliminar data de tablas  */
    public function truncateTables(array $tables)
    {
        /* Se deshabilita la verificacion de llaves foraneas*/
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        /* Se truncan las tablas */
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        /* Se habilita la verificacion de llaves foraneas*/
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
