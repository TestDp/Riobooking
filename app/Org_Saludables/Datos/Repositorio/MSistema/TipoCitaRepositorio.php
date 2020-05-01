<?php

/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 10:17 AM
 */

namespace Org_Saludables\Datos\Repositorio\MSistema;


use Org_Saludables\Datos\Modelos\MSistema\TipoCita;
use Illuminate\Support\Facades\DB;



class TipoCitaRepositorio
{

    public function GuardarTipoCita($request)
    {
        DB::beginTransaction();
        try {
            $tipoCita = new TipoCita($request->all());
            $tipoCita->Activa = 1;
            $tipoCita->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

    public function ObtenerListaTipoCitas($idEmpreesa)
    {
        $tipoCitas = DB::table('Tbl_Regionales')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Regionales.id', '=', 'Tbl_Tipos_Citas.Regional_id')
            ->select('Tbl_Tipos_Citas.*','Tbl_Regionales.Nombre as NombreRegional')
             ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Companias.id', '=', $idEmpreesa)

            ->get();
        return $tipoCitas;
    }

    public function ObtenerListaTipoCitasR($idRegional)
    {
        $tipoCitas = TipoCita::where('Regional_id', '=', $idRegional)->get();
        return $tipoCitas;
    }

}