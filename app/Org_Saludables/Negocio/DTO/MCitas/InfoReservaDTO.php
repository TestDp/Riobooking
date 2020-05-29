<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 28/05/2020
 * Time: 9:11 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class InfoReservaDTO extends BaseDTO
{
    public $Fecha;
    public $Inicio;
    public $Fin;
    public $NombreColaborador;
    public $NombreCompania;
    public $NombreCliente;
}