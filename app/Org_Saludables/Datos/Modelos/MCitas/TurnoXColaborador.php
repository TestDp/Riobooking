<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 7/05/2020
 * Time: 9:58 PM
 */

namespace App\Org_Saludables\Datos\Modelos\MCitas;


use Illuminate\Database\Eloquent\Model;

class TurnoXColaborador extends  Model
{
    protected $table = 'Tbl_Turno_Por_Colaborador';
    protected $fillable =['Cita_id','Colaborador_id'];
}