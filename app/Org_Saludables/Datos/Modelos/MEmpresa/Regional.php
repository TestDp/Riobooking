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



class Regional extends  Model
{
    protected $table = 'Tbl_Regionales';
    protected $fillable =['Nombre','Activa','Compania_id'];

    public function Compania()
    {
        return $this->belongsTo(Compania::class,'Compania_id');
    }

      public function Sedes(){
        return $this->hasMany(Sede::class,'Regional_id','id');
    }


    public function Gerencias(){
        return $this->hasMany(Gerencia::class,'Regional_id','id');
    }
    
    public function Jornadas(){
        return $this->hasMany(Jornada::class,'Regional_id','id');
    }

   // public function Citas(){
        //return $this->hasMany(Cita::class,'Regional_id','id');
    //}
    
    public function TiposCitas(){
        return $this->hasMany(Tipos_citas::class,'Regional_id','id');
    }

    //public function Muestras(){
      //  return $this->hasMany(Muestra::class,'Regional_id','id');
    //}

}