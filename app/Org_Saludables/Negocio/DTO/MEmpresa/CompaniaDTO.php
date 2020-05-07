<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:16 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MEmpresa;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class CompaniaDTO extends BaseDTO
{
    public $id;
    public $Nombre;
    public $Direccion;
    public $Activa;
    public $LogoNegocio;
    public $RutaLogo;
}