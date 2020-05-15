<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/05/2020
 * Time: 12:47 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Repositorio\MCitas\AgendaRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\ReservaDTO;

class AgendaServicio
{
    protected $agendaRepositorio;

    public function __construct(AgendaRepositorio $agendaRepositorio)
    {
     $this->agendaRepositorio = $agendaRepositorio;
    }

    public function obtenerReservas($idUser){
        $arrayReservasModel = $this->agendaRepositorio->obtenerReservas($idUser);
        $arrayDTOreservas = array();
        foreach ($arrayReservasModel as $modelReservas){
            $reservaDTO = new ReservaDTO();
            $reservaDTO->title = "Reserva de ".$modelReservas->Nickname;
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
}