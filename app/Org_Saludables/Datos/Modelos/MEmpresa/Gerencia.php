<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 10:49 AM
 */

namespace Org_Saludables\Datos\Modelos\MEmpresa;

use Illuminate\Database\Eloquent\Model;
use Org_Saludables\Datos\Modelos\MCitas\Citas;
use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use Org_Saludables\Datos\Modelos\MSistema\TipoCitas;
use Org_Saludables\Datos\Modelos\MCitas\Muestra;
use App\User;



class Gerencia extends  Model
{
    protected $table = 'Tbl_Gerencias';
    protected $fillable =['Nombre','activa','Regional_id'];

    //public function Compania()
    //{
       // return $this->belongsTo(Compania::class,'Compania_id');
    //}

     // public function Sedes(){
       // return $this->belongsTo(Sede::class,'Sede_id','id');
   // }


    public function Regionales(){
        return $this->belongsTo(Regional::class,'Regional_id');
    }
    
      public function Citas(){
        return $this->hasMany(Cita::class,'Gerencia_id','id');
    }

    public function Muestras(){
        return $this->hasMany(Muestra::class,'Gerencia_id','id');
    }


}