<?php
/**
 * Created by PhpStorm.
 * User: DPS-J
 * Date: 16/06/2020
 * Time: 7:53 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;

use App\Org_Saludables\Negocio\DTO\BaseDTO;

class ReservaCalenDTO extends BaseDTO
{
    public $idCitaUser;
    public $title;
    public $start;
    public $end;
    public $nombreNegocio;
}