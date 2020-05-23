<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/05/2020
 * Time: 12:51 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;

use DateTime;
use Illuminate\Support\Facades\DB;
use Org_Saludables\Datos\Modelos\MCitas\Cita_Por_Usuario;

class AgendaRepositorio
{

    public function GuardarReserva(Cita_Por_Usuario $citaPorUsuario)
    {
        DB::beginTransaction();
        try {
            $citaPorUsuario->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }

    }
    public function obtenerReservas($idUser)
    {
        $reservas = DB::table('Tbl_Colaborador')
            ->join('Tbl_Turno_Por_Colaborador','Tbl_Turno_Por_Colaborador.Colaborador_id','=','Tbl_Colaborador.id')
            ->join('Tbl_Citas', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->leftJoin('tbl_citas_por_usuarios', 'tbl_turno_por_colaborador.id', '=', 'tbl_citas_por_usuarios.TurnoPorColaborador_id')
            ->select('Tbl_Citas.*','Tbl_Colaborador.Nickname as Nickname')
            ->where('Tbl_Colaborador.user_id', '=', $idUser)
            ->whereNotNull('tbl_citas_por_usuarios.id')
            ->get();
        return  $reservas;
    }

    public function obtenerDisponibilidadColaborador($idColaborador)
    {
        $reservas = DB::table('Tbl_Colaborador')
            ->join('Tbl_Turno_Por_Colaborador','Tbl_Turno_Por_Colaborador.Colaborador_id','=','Tbl_Colaborador.id')
            ->join('Tbl_Citas', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->select('Tbl_Citas.*','Tbl_Colaborador.Nickname as Nickname')
            ->where('Tbl_Colaborador.user_id', '=', $idColaborador)
            ->get();
        return  $reservas;
    }

    public function obtenerFechasNoDisponibles($idColaborador)
    {
        $arrayFechasNoDisponibles = array();
        $fechaActual = new DateTime('today');
        $fechaHasta = new DateTime('today');
        $fechaHasta->modify('1 Month');
        $listaFechasDisponiblesModel = DB::table('tbl_citas')
            ->join('tbl_turno_por_colaborador', 'tbl_citas.id', '=', 'tbl_turno_por_colaborador.Cita_id')
            ->join('tbl_colaborador','tbl_colaborador.id','=','tbl_turno_por_colaborador.Colaborador_id')
            ->leftJoin('tbl_citas_por_usuarios', 'tbl_turno_por_colaborador.id', '=', 'tbl_citas_por_usuarios.TurnoPorColaborador_id')
            ->where('tbl_colaborador.id', '=', $idColaborador)
            ->whereRaw('tbl_citas.Fecha >= NOW() and tbl_citas.Fecha <= DATE(DATE_ADD(NOW(), INTERVAL 1 MONTH))')
            ->whereNull('tbl_citas_por_usuarios.id')
            ->select(\DB::raw('distinct tbl_citas.Fecha' ))
            ->GroupBy('tbl_citas.Fecha')
            ->get();

        while ($fechaActual < $fechaHasta){
            $fechaFormateada = $fechaActual->format('Y-m-d');
            $respuesta =  $listaFechasDisponiblesModel->where('Fecha','=',$fechaFormateada);
            if(count($respuesta)==0)
            {
                $arrayFechasNoDisponibles[] = $fechaFormateada;
            }
            $fechaActual->modify('1 day');
        }
        return $arrayFechasNoDisponibles;
    }


    public function obtenerTunosDisponibleDia($idColaborador, $fecha)
    {
        $listaCitasDisponibles = DB::table('tbl_citas')
            ->join('tbl_turno_por_colaborador', 'tbl_citas.id', '=', 'tbl_turno_por_colaborador.Cita_id')
            ->join('tbl_colaborador','tbl_colaborador.id','=','tbl_turno_por_colaborador.Colaborador_id')
            ->leftJoin('tbl_citas_por_usuarios', 'tbl_turno_por_colaborador.id', '=', 'tbl_citas_por_usuarios.TurnoPorColaborador_id')
            ->where('tbl_colaborador.id', '=', $idColaborador)
            ->where('tbl_citas.Fecha', '=', $fecha)
            ->whereNull('tbl_citas_por_usuarios.id')
            ->select(\DB::raw('tbl_citas.*, tbl_turno_por_colaborador.Id,tbl_colaborador.id as idColaborador' ))
            ->get();
        return $listaCitasDisponibles;
    }
}