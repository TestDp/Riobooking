<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 11:53 AM
 */

namespace App\Org_Saludables\Datos\Modelos\MCitas;

use Illuminate\Database\Eloquent\Model;


class Colaborador extends  Model
{
    protected $table = 'Tbl_Colaborador';
    protected $fillable =['Nombre','Nickname','user_id','ImagenColaborador','Calificacion','Activo','telefono'];
}