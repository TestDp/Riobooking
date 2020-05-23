<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 23/05/2020
 * Time: 2:40 PM
 */

namespace App\Org_Saludables\Negocio\DTO\MCitas;


use App\Org_Saludables\Negocio\DTO\BaseDTO;

class CitaXUsuarioDTO extends BaseDTO
{
    public $TurnoPorColaborador_id;
    public $user_id;
    public $Comentario1;
    public $Comentario2;
    public $Estado;
}