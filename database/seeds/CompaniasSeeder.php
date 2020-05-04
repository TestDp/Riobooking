<?php

use Illuminate\Database\Seeder;

class CompaniasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
         
         
         DB::table('Tbl_Companias')->insert([
            'id' => '1',
            'Nombre' => 'Compañia administradora',
            'Direccion' => 'Medellin',
             'LogoNegocio' => 'ImagenLogoNegocio',
            'Activa' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
