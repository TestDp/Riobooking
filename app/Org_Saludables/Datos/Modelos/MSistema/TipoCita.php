<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 9:08 AM
 */

namespace Org_Saludables\Datos\Modelos\MSistema;


use Org_Saludables\Datos\Modelos\MInventario\Proveedor;
use Illuminate\Database\Eloquent\Model;

//tipo de cita es igual al tipo de servicio
class TipoCita extends Model
{
    protected $table = 'Tbl_Tipos_Citas';
    protected $fillable =['Nombre','Activa','Regional_id'];

      public function Regionales(){
        return $this->belongsTo(Regional::class,'Regional_id');
    }

        public function Jornadas(){
        return $this->hasMany(Jornada::class,'Tipos_Citas_id','id');
    }



}