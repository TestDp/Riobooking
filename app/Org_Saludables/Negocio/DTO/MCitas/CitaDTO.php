<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 2/01/2019
 * Time: 5:23 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class CitaDTO extends BaseDTO
{
    
    public $Fecha;
    public $Inicio;
    public $Fin;
    public $EstadoReserva;
    public $Asistencia;
    public $Anulada;
    public $Cupos;
    public $Tipo_Cita_id;
    public $Jornada_id;

}