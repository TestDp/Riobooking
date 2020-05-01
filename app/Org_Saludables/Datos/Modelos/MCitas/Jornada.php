<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 10:49 AM
 */

namespace Org_Saludables\Datos\Modelos\MCitas;


use App\User;
use Org_Saludables\Datos\Modelos\MEmpresa\Compania;
use Org_Saludables\Datos\Modelos\MEmpresa\Regional;
use Org_Saludables\Datos\Modelos\MEmpresa\Gerencia;
use Org_Saludables\Datos\Modelos\MSistema\TipoCita;
use Illuminate\Database\Eloquent\Model;

class Jornada extends  Model
{
    protected $table = 'Tbl_Jornadas';
    protected $fillable =['Fecha','Inicio','Fin','Lugar','Duracion','Cupos','Descanso','Tipo_Cita_id',
    'Regional_id'];

   // public function Compania()
   // {
       // return $this->belongsTo(Compania::class,'Compania_id');
    //}

    //  public function Sedes(){
       // return $this->belongsTo(Sede::class,'Sede_id','id');
   // }


    public function Regional(){
        return $this->belongsTo(Regional::class,'Regional_id','id');
    }
    
      public function TiposCitas(){
        return $this->belongsTo(TipoCita::class,'Tipo_Cita_id','id');
    }

 
}