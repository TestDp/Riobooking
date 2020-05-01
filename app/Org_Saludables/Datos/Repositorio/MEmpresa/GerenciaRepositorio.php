<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Org_Saludables\Datos\Repositorio\MEmpresa;



use Org_Saludables\Datos\Modelos\MEmpresa\Gerencia;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\IGerenciaRepositorio;
use Illuminate\Support\Facades\DB;

class GerenciaRepositorio implements IGerenciaRepositorio
{

    public  function GuardarGerencia(Gerencia $gerencia)
    {
        DB::beginTransaction();
        try {
            $gerencia->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

     public  function  ObtenerListaGerencias($idEmpreesa)
     {    
          $gerencias = DB::table('Tbl_Regionales')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Gerencias', 'Tbl_Regionales.id', '=', 'Tbl_Gerencias.Regional_id')
            ->select('Tbl_Gerencias.*','Tbl_Regionales.Nombre as NombreRegional')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->get();
        return  $gerencias;
       
    }
    
}
