<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:13 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MEmpresa;

use Org_Saludables\Datos\Modelos\MEmpresa\Compania;
use Org_Saludables\Datos\Modelos\MEmpresa\Categoria;
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



        $compañias = DB::table('Tbl_Companias')
            ->join('Tbl_Categoria', 'Tbl_Companias.Categoria_id', '=', 'Tbl_Categoria.id')
            ->select('Tbl_Companias.*','Tbl_Categoria.Categoria')
            ->get();
        return $compañias;
    }
    public function ObtenerCompania($idCompania){


        $compañias = DB::table('Tbl_Companias')
            ->join('Tbl_Categoria', 'Tbl_Companias.Categoria_id', '=', 'Tbl_Categoria.id')
            ->select('Tbl_Companias.*','Tbl_Categoria.Categoria')
            ->where('Tbl_Companias.id', '=', $idCompania)
            ->get()->first();
        return $compañias;

    }
    public function ObtenerListaCategorias(){


        $categorias = DB::table('Tbl_Categoria')
            ->select('Tbl_Categoria.*')
            ->get();
        return $categorias;

    }


}