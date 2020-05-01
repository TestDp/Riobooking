<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayRolesIds = ['1','2','3'];

        $arrayRolesNombres = ['Super Admin','Administrador de Compañias','Colaborador'];

        $arrayRolesDescripcion = ['Administrador del sitio','Es la persona encargada de administrar las compañias','Es la persona con permisos para gestionar citas'];

        $arrayRolesCompaniaId = [NULL,1,1];


        for($i=0;$i < count($arrayRolesIds);$i++)
        {
            DB::table('Tbl_Roles')->insert([
                'id' => $arrayRolesIds[$i],
                'Nombre' => $arrayRolesNombres[$i],
                'Descripcion' => $arrayRolesDescripcion[$i],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
                'Compania_id' => $arrayRolesCompaniaId[$i],
            ]);
        }
    }
}
