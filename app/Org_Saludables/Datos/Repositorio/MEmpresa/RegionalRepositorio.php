<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Org_Saludables\Datos\Repositorio\MEmpresa;



use Org_Saludables\Datos\Modelos\MEmpresa\Sede;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\IRegionalRepositorio;
use Illuminate\Support\Facades\DB;

class RegionalRepositorio implements IRegionalRepositorio
{

    public  function GuardarRegional(Sede $regional)
    {
        DB::beginTransaction();
        try {
            $regional->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

     public  function  ObtenerListaRegionales($idEmpreesa)
     {    
          $sedes = DB::table('Tbl_Regionales')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Sedes', 'Tbl_Regionales.id', '=', 'Tbl_Sedes.Regional_id')
            ->select('Tbl_Sedes.*','Tbl_Regionales.Nombre as NombreRegional')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
    
            ->get();
        return  $sedes;
       
    }
    
}
