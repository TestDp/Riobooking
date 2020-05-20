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

    public function ObtenerListaColaboradoresPorServicio($idTipoServicio)
    {
        $colaboradores = DB::table('tbl_tiposervicio_por_colaborador')
            ->join('Tbl_Colaborador', 'tbl_tiposervicio_por_colaborador.Colaborador_id', '=', 'Tbl_Colaborador.id')
            ->select('Tbl_Colaborador.*')
            ->where('tbl_tiposervicio_por_colaborador.TipoCita_id', '=', $idTipoServicio)
            ->get();
        return $colaboradores;
    }
    public function GuardarServiciosPorColaboradores($request)
    {

        $arrayServicios = $request->Servicio_id;

        DB::beginTransaction();
        try {
            $servicioXcolaborador = new TipoServicioPorColaborador();
            $servicioXcolaborador->Colaborador_id = $request->Colaborador_id;
            foreach ($arrayServicios as $servicio) {
                $servicioXcolaborador->TipoCita_id = $servicio;
                $servicioXcolaborador->save();

            }


            DB::commit();
            return true;
        } catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }


    public function ObtenerListaServiciosPorColaborador($idSede)
    {
        $colaboradores = DB::table('tbl_tiposervicio_por_colaborador')
            ->join('Tbl_Colaborador', 'tbl_tiposervicio_por_colaborador.Colaborador_id', '=', 'Tbl_Colaborador.id')
            ->join('Tbl_Tipos_Citas', 'tbl_tiposervicio_por_colaborador.TipoCita_id', '=', 'Tbl_Tipos_Citas.id')
            ->select('Tbl_Colaborador.id','Tbl_Colaborador.Nombre as NombreColaborador','Tbl_Tipos_Citas.id','Tbl_Tipos_Citas.Nombre as NombreServicio')
            ->where('Tbl_Tipos_Citas.Sede_id', '=', $idSede)
            ->get();
        return $colaboradores;
    }

    public function ObtenerTodosLosServiciosPorColaborador($idusuario)
    {
        $colaboradores = DB::table('tbl_tiposervicio_por_colaborador')
            ->join('Tbl_Colaborador', 'tbl_tiposervicio_por_colaborador.Colaborador_id', '=', 'Tbl_Colaborador.id')
            ->join('Tbl_Tipos_Citas', 'tbl_tiposervicio_por_colaborador.TipoCita_id', '=', 'Tbl_Tipos_Citas.id')
            ->select('Tbl_Colaborador.id','Tbl_Colaborador.Nombre as NombreColaborador','Tbl_Tipos_Citas.id','Tbl_Tipos_Citas.Nombre as NombreServicio')
            ->where('Tbl_Colaborador.Usuario_id', '=', $idusuario)
            ->get();
        return $colaboradores;
    }
}