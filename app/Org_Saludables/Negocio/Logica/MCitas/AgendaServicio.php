<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/05/2020
 * Time: 12:47 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Repositorio\MCitas\AgendaRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\CitaXUsuarioDTO;
use App\Org_Saludables\Negocio\DTO\MCitas\InfoReservaDTO;
use App\Org_Saludables\Negocio\DTO\MCitas\ReservaDTO;
use Org_Saludables\Datos\Modelos\MCitas\Cita_Por_Usuario;

class AgendaServicio
{
    protected $agendaRepositorio;

    public function __construct(AgendaRepositorio $agendaRepositorio)
    {
     $this->agendaRepositorio = $agendaRepositorio;
    }

    public function GuardarReserva(CitaXUsuarioDTO $citaXUsuarioDTO)
    {
        $reservaModel = $citaXUsuarioDTO->toModel(Cita_Por_Usuario::class);
        return $this->agendaRepositorio->GuardarReserva($reservaModel);
    }
    public function obtenerReservas($idUser){
        $arrayReservasModel = $this->agendaRepositorio->obtenerReservas($idUser);
        $arrayDTOreservas = array();
        foreach ($arrayReservasModel as $modelReservas){
            $reservaDTO = new ReservaDTO();
            $reservaDTO->title = "Reserva de ".$modelReservas->Nickname." ". $modelReservas->apellidos;
            $reservaDTO->start = $modelReservas->Fecha.' '. $modelReservas->Inicio;
            $reservaDTO->end = $modelReservas->Fecha.' '. $modelReservas->Fin;
            $arrayDTOreservas[]=$reservaDTO;
        }
        return $arrayDTOreservas;
    }

    public function obtenerDisponibilidadColaborador($idColaborador){
        $arrayDisponibilidadModel = $this->agendaRepositorio->obtenerDisponibilidadColaborador($idColaborador);
        $arrayDTOdisponibilidad = array();
        foreach ($arrayDisponibilidadModel as $modelReservas){
            $reservaDTO = new ReservaDTO();
            $reservaDTO->title = "Reserva de ".$modelReservas->Nickname;
            $reservaDTO->start = $modelReservas->Fecha.' '. $modelReservas->Inicio;
            $reservaDTO->end = $modelReservas->Fecha.' '. $modelReservas->Fin;
            $arrayDTOdisponibilidad[]=$reservaDTO;
        }
        return $arrayDTOdisponibilidad;
    }

    public function obtenerFechasNoDisponibles($idColaborador)
    {
        $arrayFechasNoDiposniblesModel = $this->agendaRepositorio->obtenerFechasNoDisponibles($idColaborador);
        return $arrayFechasNoDiposniblesModel;
    }

    public function obtenerTunosDisponibleDia($idColaborador, $fecha)
    {
        $arrayTunosDisponibleDiaModel = $this->agendaRepositorio->obtenerTunosDisponibleDia($idColaborador, $fecha);
        return $arrayTunosDisponibleDiaModel;

    }

    public function obtenerMiCalendario($idUser){
        $arrayReservasModel = $this->agendaRepositorio->obtenerCalendarioUsuario($idUser);
        $arrayDTOreservas = array();
        foreach ($arrayReservasModel as $modelReservas){
            $reservaDTO = new ReservaDTO();
            $reservaDTO->title = "Reserva con ".$modelReservas->Nickname;
            $reservaDTO->start = $modelReservas->Fecha.' '. $modelReservas->Inicio;
            $reservaDTO->end = $modelReservas->Fecha.' '. $modelReservas->Fin;
            $arrayDTOreservas[]=$reservaDTO;
        }
        return $arrayDTOreservas;
    }

    public function ObtenerInformacionReserva($TurnoPorColaborador_id){
        $infoReservaModel=  $this->agendaRepositorio->ObtenerInformacionReserva($TurnoPorColaborador_id);
        $infoReservaDTO = new InfoReservaDTO((array)$infoReservaModel);
        return $infoReservaDTO;
    }
}