<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:06 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;

use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;
use Illuminate\Support\Facades\DB;

class ColaboradorRepositorio implements  IColaboradorRepositorio
{
    public  function GuardarColaborador(Colaborador $colaborador)
    {
        DB::beginTransaction();
        try {
            $colaborador->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }


    public function ObtenerListaColaboradores($idEmpresa)
    {
        $colaboradores = DB::table('Tbl_Colaborador')
             ->join('users', 'users.id', '=', 'Tbl_Colaborador.user_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'users.Compania_id')
            ->select('Tbl_Colaborador.*')
            ->where('Tbl_Companias.id', '=', $idEmpresa)
            ->get();
        return $colaboradores;
    }
}