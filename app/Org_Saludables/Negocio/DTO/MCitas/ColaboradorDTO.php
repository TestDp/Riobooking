<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:02 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class ColaboradorDTO extends BaseDTO
{
    public $Nombre;
    public $Nickname;
    public $user_id;
    public $ImagenColaborador;
    public $Calificacion;
    public $Activo;
    public $telefono;
}