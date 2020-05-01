<?php

use Illuminate\Database\Seeder;

class RolesUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayIdRolesUsuario = [1];
        $arrayRolesId = [1];
        /* Johana, Daniel , Simon*/
        $arrayUsersId = [1];

        for($i=0;$i < count($arrayIdRolesUsuario);$i++)
        {
            DB::table('Tbl_Roles_Por_Usuarios')->insert([
                'id' => $arrayIdRolesUsuario[$i],
                'Rol_id' => $arrayRolesId[$i],
                'user_id' => $arrayUsersId[$i],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
