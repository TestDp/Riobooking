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
use Org_Saludables\Datos\Modelos\MEmpresa\Sede;


class CompaniaRepositorio implements ICompaniaRepositorio
{


    public  function GuardarCompania(Compania $compania)
    {
        DB::beginTransaction();
        try {
            $compania->save();
            $sede = new Sede();
            $sede->Nombre="Sede Principal";
            $sede->activa = 1;
            $sede->Compania_id = $compania->id;
            $sede->save();
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
    public function ObtenerCompania($idCompania){
        return Compania::where('id', '=', $idCompania)->get()->first();

    }



}