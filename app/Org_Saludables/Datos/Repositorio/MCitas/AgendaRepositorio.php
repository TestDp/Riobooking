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
            ->leftJoin('Tbl_Citas_Por_Usuarios', 'Tbl_Turno_Por_Colaborador.id', '=', 'Tbl_Citas_Por_Usuarios.TurnoPorColaborador_id')
            ->join('users', 'users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->select('Tbl_Citas.*','users.name as Nickname','users.last_name as apellidos')
            ->where('Tbl_Colaborador.user_id', '=', $idUser)
            ->where('Tbl_Citas_Por_Usuarios.Estado','=',1)
            ->whereNotNull('Tbl_Citas_Por_Usuarios.id')
            ->get();
        return  $reservas;
    }

    public function obtenerCalendarioUsuario($idUser)
    {
        $reservas = DB::table('Tbl_Colaborador')
            ->join('Tbl_Turno_Por_Colaborador','Tbl_Turno_Por_Colaborador.Colaborador_id','=','Tbl_Colaborador.id')
            ->join('Tbl_Citas', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->join('Users', 'Tbl_Colaborador.user_id', '=', 'Users.id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'Users.Sede_id')
            ->leftJoin('Tbl_Citas_Por_Usuarios', 'Tbl_Turno_Por_Colaborador.id', '=', 'Tbl_Citas_Por_Usuarios.TurnoPorColaborador_id')
            ->select('Tbl_Citas.*','Tbl_Colaborador.Nombre as Nickname','Tbl_Citas_Por_Usuarios.id as IdCitaUser','Tbl_Sedes.Nombre' )
            ->where('Tbl_Citas_Por_Usuarios.Estado','=',1)
            ->where('Tbl_Citas_Por_Usuarios.user_id', '=', $idUser)
            ->whereNotNull('Tbl_Citas_Por_Usuarios.id')
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
            ->where('Tbl_Citas_Por_Usuarios.Estado','<>',1)
            ->get();
        return  $reservas;
    }

    public function obtenerFechasNoDisponibles($idColaborador)
    {
        $arrayFechasNoDisponibles = array();
        $fechaActual = new DateTime('today');
        $fechaHasta = new DateTime('today');
        $fechaActual->modify('-1 Day');
        $fechaHasta->modify('1 Month');
        $fechaFormateada1 = $fechaActual->format('Y-m-d');
        $listaFechasDisponiblesModel = DB::table('Tbl_Citas')
            ->join('Tbl_Turno_Por_Colaborador', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->join('Tbl_Colaborador','Tbl_Colaborador.id','=','Tbl_Turno_Por_Colaborador.Colaborador_id')
            ->leftJoin('Tbl_Citas_Por_Usuarios', 'Tbl_Turno_Por_Colaborador.id', '=', 'Tbl_Citas_Por_Usuarios.TurnoPorColaborador_id')
            ->where('Tbl_Colaborador.id', '=', $idColaborador)
            ->whereRaw('Tbl_Citas.Fecha >= '. $fechaFormateada1 .' and Tbl_Citas.Fecha <= DATE(DATE_ADD(NOW(), INTERVAL 1 MONTH))')
            ->whereNull('Tbl_Citas_Por_Usuarios.id')
            ->Orwhere('Tbl_Citas_Por_Usuarios.Estado','<>',1)
            ->select(\DB::raw('distinct Tbl_Citas.Fecha' ))
            ->GroupBy('Tbl_Citas.Fecha')
            ->get();

        while ($fechaActual <= $fechaHasta){
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
        $listaCitasDisponibles = DB::table('Tbl_Citas')
            ->join('Tbl_Turno_Por_Colaborador', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->join('Tbl_Colaborador','Tbl_Colaborador.id','=','Tbl_Turno_Por_Colaborador.Colaborador_id')
            ->leftJoin('Tbl_Citas_Por_Usuarios', 'Tbl_Turno_Por_Colaborador.id', '=', 'Tbl_Citas_Por_Usuarios.TurnoPorColaborador_id')
            ->where('Tbl_Colaborador.id', '=', $idColaborador)
            ->where('Tbl_Citas.Fecha', '=', $fecha)
            ->where('Tbl_Citas_Por_Usuarios.Estado','<>',1)
            ->whereNull('Tbl_Citas_Por_Usuarios.id')
            ->select(\DB::raw('Tbl_Citas.*, Tbl_Turno_Por_Colaborador.Id,Tbl_Colaborador.id as idColaborador' ))
            ->get();
        return $listaCitasDisponibles;
    }

  public function ObtenerInformacionReserva($TurnoPorColaborador_id){

        $infoReserva = DB::table('Tbl_Turno_Por_Colaborador')
                        ->join('Tbl_Citas','Tbl_Turno_Por_Colaborador.Cita_id','=','Tbl_Citas.id')
                        ->join('Tbl_Colaborador','Tbl_Colaborador.id','=','Tbl_Turno_Por_Colaborador.Colaborador_id')
                        ->join('users','Tbl_Colaborador.user_id','=','users.id')
                        ->join('Tbl_Sedes','users.Sede_id','=','Tbl_Sedes.id')
                        ->join('Tbl_Companias','Tbl_Sedes.Compania_id','=','Tbl_Companias.id')
                        ->where('Tbl_Turno_Por_Colaborador.id', '=', $TurnoPorColaborador_id)
                        ->select(\DB::raw('Tbl_Citas.*, Tbl_Colaborador.Nombre as NombreColaborador,users.email,Tbl_Companias.Nombre as NombreCompania' ))
                        ->get()->first();
        return $infoReserva;
    }


    public function CancelarCita($idCitaUser)
    {
        $InfoCita = Cita_Por_Usuario::where('id',$idCitaUser )->get()->first();
        if($InfoCita){
            $InfoCita->Estado = 0;
            $InfoCita->save();
            return true;
        }
        return False;
    }
}