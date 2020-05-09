<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayUsersIds = ['1'];

        $arrayUsersName = ['Juan'];

        $arrayUsersLastName = ['Blandon'];

        $arrayUsersUsersName = ['jblandon'];

        $arrayUsersEmail = ['juancamilo.blandon@gmail.com'];
        
        $UsersActivo = 1; 

        $UsersPass = bcrypt("admon123456"); 

        $UsersRemember_token = bcrypt("123456");

        $arrayUsersSede = [1];

        $arrayUsersCorreoConfirmado = [0];

        $arrayUsersCodigoConfirmacion = [NULL];

        $arrayUsersTel = ['3655600'];


        for($i=0;$i < count($arrayUsersIds);$i++)
        {
            DB::table('users')->insert([
                'id' => $arrayUsersIds[$i],
                'name' => $arrayUsersName[$i],
                'last_name' => $arrayUsersLastName[$i],
                'username' => $arrayUsersUsersName[$i],
                'email' => $arrayUsersEmail[$i],
                'activo' => $UsersActivo,
                'password' => $UsersPass,
                'remember_token' => $UsersRemember_token,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
                'Sede_id' => $arrayUsersSede[$i],
                'CorreoConfirmado' => $arrayUsersCorreoConfirmado[$i],
                'telefono' => $arrayUsersTel[$i],
            ]);
        }
    }
}
