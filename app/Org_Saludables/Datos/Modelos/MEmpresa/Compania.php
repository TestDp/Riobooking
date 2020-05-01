<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 10:36 AM
 */

namespace Org_Saludables\Datos\Modelos\MEmpresa;
use App\User;




use Illuminate\Database\Eloquent\Model;
use Org_Saludables\Datos\Modelos\MCitas\Citas;
use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use Org_Saludables\Datos\Modelos\MSistema\TipoCitas;
use Org_Saludables\Datos\Modelos\MCitas\Muestra;

class Compania extends Model
{
    protected $table = 'Tbl_Companias';
    protected $fillable =['Nombre','Direccion','Activa'];

    public function Regionales(){
        return $this->hasMany(Regional::class,'Compania_id','id');
    }

  
    //public function Gerencias(){
        //return $this->hasMany(Gerencia::class,'Compania_id','id');
    //}

    
    public function Usuarios(){
        return $this->hasMany(User::class,'Compania_id','id');
    }

    // public function Jornadas(){
       // return $this->hasMany(Jornada::class,'Compania_id','id');
   // }

     //public function Citas(){
        //return $this->hasMany(Cita::class,'Compania_id','id');
    //}
    
     // public function TiposCitas(){
        //return $this->hasMany(Tipos_citas::class,'Compania_id','id');
    //}

    //public function Muestras(){
        //return $this->hasMany(Muestra::class,'Compania_id','id');
    //}
    
}