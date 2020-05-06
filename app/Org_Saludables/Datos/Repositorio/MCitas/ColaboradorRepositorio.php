<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:06 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;

use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;
use Illuminate\Support\Facades\DB;

class ColaboradorRepositorio implements  IColaboradorRepositorio
{
    public  function GuardarColaborador(Colaborador $colaborador)
    {
        DB::beginTransaction();
        try {
            $colaborador->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }
}