<?php

use Illuminate\Database\Seeder;

class RecursosSistemasRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRecuSisRolId = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53];

        $arrayRolId = [1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,1,3,3,1,2,2];

        $arrayRecurSistId = [1,17,18,19,9,10,11,12,13,14,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,30,31,32,26,5,34,35,37,37,38];

        
        for($i=0;$i < count($arrayRecuSisRolId);$i++)
        {
            DB::table('Tbl_Recursos_Sistemas_Por_Rol')->insert([
                'id' => $arrayRecuSisRolId[$i],
                'Rol_id' =>$arrayRolId[$i],
                'RecursoSistema_id' => $arrayRecurSistId[$i],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
