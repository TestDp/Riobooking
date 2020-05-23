<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 12:52 PM
 */


namespace Org_Saludables\Datos\Modelos\MCitas;


use Illuminate\Database\Eloquent\Model;

class Cita_Por_Usuario extends Model
{
    protected $table = 'Tbl_Citas_Por_Usuarios';
    protected $fillable =['TurnoPorColaborador_id','user_id','Comentario1','Comentario2','Estado'];
}