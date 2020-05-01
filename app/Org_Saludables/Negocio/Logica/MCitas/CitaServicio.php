<?php

/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Repositorio\MCitas\IJornadaRepositorio;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\JornadaDTO;
use Org_Saludables\Datos\Modelos\MCitas\Cita;
use App\Org_Saludables\Negocio\Logica\MCitas\ICitaServicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Drive;





class CitaServicio implements ICitaServicio
{

     // protected $client;
    protected $citaRepositorio;





    public function __construct(ICitasRepositorio $citaRepositorio)
    {
        $this->citaRepositorio = $citaRepositorio;
      

  
    }

    public function ProgramarHorariosCitas($jornadaDTO)
    {
        $inicioJornada = $jornadaDTO->Inicio;
        $finJornada = $jornadaDTO->Fin;
        $descansoCita = $jornadaDTO->Descanso;
        $duracionCita = $jornadaDTO->Duracion;
        $arrayCitas = array();
        while ($inicioJornada <= $finJornada) {
            $cita = new Cita();
            $cita->Fecha = $jornadaDTO->Fecha;
            $cita->Cupos = $jornadaDTO->Cupos;
            $cita->Inicio = $inicioJornada;
            $cita->Fin = $this->SumaHoras($inicioJornada, $duracionCita);
            $inicioJornada = $this->SumaHoras($inicioJornada, $duracionCita + $descansoCita);
            $arrayCitas[] = $cita;
        }
        return $arrayCitas;
    }

    function SumaHoras($hora, $minutos_sumar)
    {
        $minutoAnadir = $minutos_sumar;
        $segundos_horaInicial = strtotime($hora);
        $segundos_minutoAnadir = $minutoAnadir * 60;
        $nuevaHora = date("H:i:s", $segundos_horaInicial + $segundos_minutoAnadir);
        return $nuevaHora;
    } //fin función


    public function ObtenerListaCitas($idEmpreesa)
    {

        $idusuario = Auth::user()->id;
        $arrayCitasUusarios = $this->citaRepositorio->ObtenerTipoCitaUsuario($idusuario, $idEmpreesa);

        //$horariosReservados = $this->citaRepositorio->ObtenerHorarioCitaUsuario($idusuario, $idEmpreesa);
         
        return $this->citaRepositorio->ObtenerListaCitas($idEmpreesa, $arrayCitasUusarios);
    }

    // es la validacion que permite realizar la busqueda segun los filtros ingresados por el usuario 
    public function ObtenerListaCitasBuscador($BuscadorDTO)
    {
        $idEmpreesa=$BuscadorDTO->idEmpresa;
        $idusuario = Auth::user()->id;

        $arrayCitasUusarios = $this->citaRepositorio->ObtenerTipoCitaUsuario($idusuario, $idEmpreesa);

        if ($BuscadorDTO->Fecha !=null && $BuscadorDTO->Regional ==null && $BuscadorDTO->TipoCita ==null)
        {
             $fecha=$BuscadorDTO->Fecha;
            return $this->citaRepositorio->BuscardorCitasxFecha($idEmpreesa, $arrayCitasUusarios,$fecha);
        }

        
        if ($BuscadorDTO->Fecha ==null && $BuscadorDTO->Regional ==null && $BuscadorDTO->TipoCita !=null)
        {
             $tipoCita=$BuscadorDTO->TipoCita;
            return $this->citaRepositorio->BuscardorCitasxTipoCita($idEmpreesa, $arrayCitasUusarios,$tipoCita);
        }

         if ($BuscadorDTO->Fecha ==null && $BuscadorDTO->Regional !=null && $BuscadorDTO->TipoCita ==null)
        {
             $regional=$BuscadorDTO->Regional;
            return $this->citaRepositorio->BuscardorCitasxRegional($idEmpreesa, $arrayCitasUusarios,$regional);
        }

         if ($BuscadorDTO->Fecha !=null && $BuscadorDTO->Regional ==null && $BuscadorDTO->TipoCita !=null)
        {
             $tipoCita=$BuscadorDTO->TipoCita;
             $fecha=$BuscadorDTO->Fecha;
            return $this->citaRepositorio->BuscardorCitasxFechaYTipoCita($idEmpreesa, $arrayCitasUusarios,$fecha, $tipoCita);
        }

         if ($BuscadorDTO->Fecha !=null && $BuscadorDTO->Regional !=null && $BuscadorDTO->TipoCita ==null)
        {
             $regional=$BuscadorDTO->Regional;
             $fecha=$BuscadorDTO->Fecha;
            return $this->citaRepositorio->BuscardorCitasxFechaYRegional($idEmpreesa, $arrayCitasUusarios,$fecha, $regional);
        }
        
         if ($BuscadorDTO->Fecha ==null && $BuscadorDTO->Regional !=null && $BuscadorDTO->TipoCita !=null)
        {
             $regional=$BuscadorDTO->Regional;
             $tipoCita=$BuscadorDTO->TipoCita;
            return $this->citaRepositorio->BuscardorCitasxRegionalYTipoCita($idEmpreesa, $arrayCitasUusarios,$regional, $tipoCita);
        }

          if ($BuscadorDTO->Fecha !=null && $BuscadorDTO->Regional !=null && $BuscadorDTO->TipoCita !=null)
        {
             $regional=$BuscadorDTO->Regional;
             $tipoCita=$BuscadorDTO->TipoCita;
             $fecha=$BuscadorDTO->Fecha;
            return $this->citaRepositorio->BuscardorCitasxRegionalTipoCitaYFecha($idEmpreesa, $arrayCitasUusarios,$regional, $tipoCita, $fecha);
        }

        if ($BuscadorDTO->Fecha ==null && $BuscadorDTO->Regional ==null && $BuscadorDTO->TipoCita ==null)
        {
            
            return $this->citaRepositorio->ObtenerListaCitas($idEmpreesa, $arrayCitasUusarios);
        }
        
        
        
    }




    public function ObtenerListaCitasUsuario($idUsuario, $idEmpreesa)
    {

        return $this->citaRepositorio->ObtenerListaCitasUsuario($idUsuario, $idEmpreesa);
    }



    public function ObtenerCita($idCita)
    {
        return $this->citaRepositorio->ObtenerCita($idCita);
    }

    public function ReservarCita($Cita, $usuario, $jornada)
    {


         $idEmpreesa = Auth::user()->Compania_id;
          $arrayCitas = array();
        $horariosReservados = $this->citaRepositorio->ObtenerHorarioCitaUsuario($usuario, $idEmpreesa);
          foreach ($horariosReservados as $horarioReservaUsuario) {
                if($horarioReservaUsuario->Fecha ==$Cita->Fecha)
                {   
                    $informacionCitaReservada=$horarioReservaUsuario->id;
                    $horaInicioReservada=$horarioReservaUsuario->Inicio;
                    $horaFinReservada=$horarioReservaUsuario->Fin;
                    $InicioAReservar= $Cita->Inicio;
                    $FinAReservar=$Cita->Fin;
                   
                  // $citasReservadas =$this->citaRepositorio->CruceCitas($usuario,$informacionCitaReservada, $InicioAReservar, $FinAReservar);

                    //foreach ($citasReservadas as $citaReservada)
                    //{
                        //if($citaReservada->numero >0)
                        //{
                            //return ['respuesta' =>false,'mensaje'=>'En este horario ya tiene otra cita reservada'];
                            //return false;
                        //}

                   //}
                  
                      if ((($InicioAReservar>$horaInicioReservada) &&  ($InicioAReservar<$horaFinReservada)) || (($FinAReservar>$horaInicioReservada) &&  ($FinAReservar<$horaFinReservada))||(($InicioAReservar>=$horaInicioReservada) &&  ($FinAReservar<=$horaFinReservada)))
                   {              
                          return false;

                   }

                }

                    
                
            }
        return $this->citaRepositorio->ReservarCita($Cita, $usuario, $jornada);




    }

    public function CancelarCita($Cita, $usuario, $jornada)
    {

        //$idCita = $Cita->id;
        //$respuesta = $this->citaRepositorio->EliminarCitaPorUsuario($idCita, $usuario);
        //if ($respuesta == true) {
            //return $this->citaRepositorio->CancelarCita($Cita, $usuario, $jornada);
        //}
        
        $idCita = $Cita->id;
        return $this->citaRepositorio->EliminarCitaPorUsuario($idCita, $usuario,$Cita,$jornada);
      
    }
 

   public function ObtenerCitaPorUsuario($idCita, $idUsuario)
    {
        return $this->citaRepositorio->ObtenerCitaPorUsuario($idCita, $idUsuario);
   }
 
   public function BorrarCita($idCita)
    {

   
            return $this->citaRepositorio->BorrarCita($idCita);
      

    }

}