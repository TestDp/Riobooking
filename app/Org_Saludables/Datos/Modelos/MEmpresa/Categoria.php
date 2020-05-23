<?php
/**
 * Created by PhpStorm.
 * User: DPS-J
 * Date: 23/05/2020
 * Time: 3:04 PM
 */

namespace App\Org_Saludables\Datos\Modelos\MEmpresa;

use Org_Saludables\Datos\Modelos\MEmpresa\Compañia;

class Categoria
{
    protected $table = 'Tbl_Categoria';
    protected $fillable =['Categoria','Descripcion'];

    public function Compañias(){
        return $this->hasMany(Compañia::class,'Categoria_id','id');
    }


}