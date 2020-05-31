<?php
/**
 * Created by PhpStorm.
 * User: DPS-J
 * Date: 9/05/2020
 * Time: 11:48 AM
 */

namespace App\Org_Saludables\Datos\Modelos\MCitas;

use Illuminate\Database\Eloquent\Model;
use Org_Saludables\Datos\Modelos\MSistema\TipoCita;


class TipoServicioPorColaborador extends  Model
{

    protected $table = 'Tbl_TipoServicio_Por_Colaborador';
    protected $fillable =['TipoCita_id','Colaborador_id'];


    public function Colaborador(){
        return $this->belongsTo(Colaborador::class,'Colaborador_id','id');
    }


    public function Servicio(){
        return $this->belongsTo(TipoCita::class,'TipoCita_id','id');
    }

}