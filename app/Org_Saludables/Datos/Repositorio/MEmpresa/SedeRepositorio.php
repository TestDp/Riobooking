<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Org_Saludables\Datos\Repositorio\MEmpresa;



use Org_Saludables\Datos\Modelos\MEmpresa\Regional;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\ISedeRepositorio;
use Illuminate\Support\Facades\DB;

class SedeRepositorio implements ISedeRepositorio
{

    public  function GuardarSede(Regional $sede)
    {
        DB::beginTransaction();
        try {
            $sede->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

     //public  function  ObtenerListaSedes($idEmpreesa)
     //{    
      //return Regional::where('Compania_id', '=', $idEmpreesa)->get();
    //}

         public function ObtenerListaSedes($idEmpreesa)
    {
        $regionales = DB::table('Tbl_Sedes')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Sedes.Compania_id')
            ->select('Tbl_Sedes.*','Tbl_Companias.Nombre as NombreCompania')
             ->where('Tbl_Companias.id', '=', $idEmpreesa)

            ->get();
        return $regionales;
    }

}