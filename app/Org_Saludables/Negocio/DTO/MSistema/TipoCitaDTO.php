<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 12/05/2020
 * Time: 9:05 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MSistema;

use App\Org_Saludables\Negocio\DTO\BaseDTO;

class TipoCitaDTO extends BaseDTO
{
     public $id;
     public $Nombre;
     public $Activa;
     public $NombreSede;
     public $Precio;
}