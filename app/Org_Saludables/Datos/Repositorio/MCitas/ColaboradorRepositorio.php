<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:06 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;

use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;
use App\Org_Saludables\Datos\Modelos\MCitas\TipoServicioPorColaborador;
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
        $colaboradores = DB::table('users')
             ->join('Tbl_Colaborador', 'users.id', '=', 'Tbl_Colaborador.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->select('Tbl_Colaborador.*')
            ->where('Tbl_Sedes.Compania_id', '=', $idEmpresa)
            ->get();
        return $colaboradores;
    }

    public function GuardarServiciosPorColaboradores($idColaborador, $idServicio)
    {

        $servicioXcolaborador = new TipoServicioPorColaborador();
        $servicioXcolaborador->TipoCita_id = $idColaborador;
        $servicioXcolaborador->Colaborador_id = $idServicio;

        DB::beginTransaction();
        try {
            $servicioXcolaborador->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }
}