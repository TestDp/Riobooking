<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:18 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;
use App\Org_Saludables\Negocio\DTO\MCitas\JornadaDTO;


interface ICitaServicio
{
    public function ProgramarHorariosCitas($jornadaDTO);
    public function ObtenerListaCitas($idEmpreesa);
    public function ObtenerListaCitasUsuario($idUsuario, $idEmpreesa);
    public function ReservarCita($Cita, $usuario, $jornada);
    public function CancelarCita($Cita, $usuario, $jornada);
    public function ObtenerListaCitasBuscador($BuscadorDTO);
}
