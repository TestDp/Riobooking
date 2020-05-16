<?php

use Illuminate\Database\Seeder;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Tbl_Sedes')->insert([
            'id' => '1',
            'Nombre' => 'Bomba de Servicios Tucan',
            'Activa' => '1',
            'Compania_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
