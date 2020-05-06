<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:13 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MEmpresa;

use Org_Saludables\Datos\Modelos\MEmpresa\Compania;
use Illuminate\Support\Facades\DB;


class CompaniaRepositorio implements ICompaniaRepositorio
{


    public  function GuardarCompania(Compania $compania)
    {
        DB::beginTransaction();
        try {
            $compania->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }
    public function ObtenerListaCompanias(){
        return Compania::all();
    }

     
}