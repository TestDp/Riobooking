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

class Muestra extends  Model
   

{
    protected $table = 'Tbl_muestra';
    protected $fillable =['last_name','Fecha','username','Edad','Sexo','TipoTrabajo','TEN_ART_SIST','TEN_ART_DIAS',
    'GLICEMIA', 'COLESTEROL_TOTAL','TRIGLICERIDOS','HDL','COLESTEROL_LDL','IMC','P_A','TIEMPO_MINS','SES_SEMANALES',
    'TABACO_MES','FUMA_PASIVO','ALCOHOL_COP_SEM','ANT_CARDIOVASCULARES','FRAMIGHAM10','PORC_GRASA','EVOL_POR_GRASA',
    'TALLA','PESO', 'Gerencia_id','user_id'];

   // public function Compania()
    //{
      //  return $this->belongsTo(Compania::class,'Compania_id');
    //}

     // public function Regionales(){
       // return $this->belongsTo(Regional::class,'Regional_id','id');
   // }


    public function Gerencia(){
        return $this->belongsTo(Gerencia::class,'Gerencia_id','id');
    }
    
      public function Usuario(){
        return $this->belongsTo(User::class,'user_id','id');
    }

 
}