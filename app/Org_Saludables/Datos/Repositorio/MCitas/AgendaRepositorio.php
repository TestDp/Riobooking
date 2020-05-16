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
use Illuminate\Support\Arr;

class AgendaRepositorio
{

    public function obtenerReservas($idUser)
    {
        $reservas = DB::table('Tbl_Colaborador')
            ->join('Tbl_Turno_Por_Colaborador','Tbl_Turno_Por_Colaborador.Colaborador_id','=','Tbl_Colaborador.id')
            ->join('Tbl_Citas', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->select('Tbl_Citas.*','Tbl_Colaborador.Nickname as Nickname')
            ->where('Tbl_Colaborador.user_id', '=', $idUser)
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

        $arrayFecha = new Arr();
        $fechaActual = new DateTime('today');
        $fechaHasta = new DateTime('today');
        $fechaHasta->modify('1 Month');

        $listaFechasNoDisponibles = DB::table('tbl_citas')
            ->join('tbl_turno_por_colaborador', 'tbl_citas.id', '=', 'tbl_turno_por_colaborador.Cita_id')
            ->join('tbl_colaborador','tbl_colaborador.id','=','tbl_turno_por_colaborador.Colaborador_id')
            ->leftJoin('tbl_citas_por_usuarios', 'tbl_turno_por_colaborador.id', '=', 'tbl_citas_por_usuarios.TurnoPorColaborador_id')
            ->where('tbl_colaborador.id', '=', $idColaborador)
            ->whereRaw('tbl_citas.Fecha >= NOW() and tbl_citas.Fecha <= DATE(DATE_ADD(NOW(), INTERVAL 1 MONTH))')
            ->whereNull('tbl_citas_por_usuarios.id')
            ->select(\DB::raw('distinct tbl_citas.Fecha,  count(*)' ))
            ->GroupBy('tbl_citas.Fecha')
            ->get();

        while ($fechaActual < $fechaHasta){


            $exists = Arr::exists($listaFechasNoDisponibles , $fechaActual);

            if($exists != true)
            {
                $arrayFecha = Arr::add(['Fecha' => $fechaActual]);
            }

            $fechaActual->modify('1 day');

        }

       // return array("2020/05/15", "2020/05/16");
        return $arrayFecha;

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
            ->select(\DB::raw('tbl_citas.id, tbl_citas.Fecha,  tbl_turno_por_colaborador.Id' ))
            ->get();


        //return array("2020/05/15", "2020/05/16");

        return $listaCitasDisponibles;

    }
}