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


class Sede extends  Model
{
    protected $table = 'Tbl_Sedes';
    protected $fillable =['Nombre','activa','Regional_id'];

   // public function Compania()
    //{
        //return $this->belongsTo(Compania::class,'Compania_id');
    //}

     public function Regional()
    {
        return $this->belongsTo(Regional::class,'Regional_id');
    }


   // public function Gerencias(){
        //return $this->hasMany(Gerencia::class,'Sede_id','id');
    //}
    
       // public function Jornadas(){
        //return $this->hasMany(Jornada::class,'Sede_id','id');
   // }


}