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

use Illuminate\Database\Eloquent\Model;

class Cita extends  Model
{
    protected $table = 'Tbl_Citas';
    protected $fillable =['Fecha','Inicio','Fin','EstadoReserva','Asistencia','Anulada','Cupos'];

   // public function Compania()
   // {
      //  return $this->belongsTo(Compania::class,'Compania_id');
    //}

      //public function Regional(){
      //  return $this->belongsTo(Regional::class,'Regional_id','id');
   // }


   // public function Gerencia(){
       // return $this->belongsTo(Gerencia::class,'Gerencia_id','id');
   // }
    
      public function Jornada(){
        return $this->belongsTo(Jornada::class,'Jornada_id','id');
    }

 
}