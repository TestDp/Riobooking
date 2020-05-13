<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 2/01/2019
 * Time: 5:23 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class JornadaDTO extends BaseDTO
{
    
    public $Fecha;
    public $FechaFin;
    public $Inicio;
    public $Fin;
    public $Descanso;
    public $Lugar;
    public $Duracion;
    public $Cupos;
    public $Tipo_Cita_id;
    public $Sede_id;
}