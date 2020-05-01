<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:34 PM
 */

namespace Org_Saludables\Datos\Repositorio\MSistema;

use Illuminate\Support\Facades\DB;

class UsuarioRepositorio
{

    public  function  ObtenerListaUsuarios($idEmpresa,$idUsuario)
    {  

       
        $users = DB::table('users')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'users.Compania_id')
            ->select('users.*')
            ->where('Tbl_Companias.id', '=', $idEmpresa)
            ->where('users.id','<>',$idUsuario)
            ->get();
        return $users;
    }
}