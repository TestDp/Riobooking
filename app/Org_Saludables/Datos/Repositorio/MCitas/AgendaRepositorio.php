<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/05/2020
 * Time: 12:51 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;


use Illuminate\Support\Facades\DB;

class AgendaRepositorio
{

    public function obtenerReservas($idUser)
    {
        $reservas = DB::table('Tbl_Colaborador')
            ->join('Tbl_Turno_Por_Colaborador','Tbl_Turno_Por_Colaborador.Colaborador_id','=','Tbl_Colaborador.id')
            ->join('Tbl_Citas', 'Tbl_Citas.id', '=', 'Tbl_Turno_Por_Colaborador.Cita_id')
            ->select('Tbl_Citas.*','Tbl_Colaborador.Nickname as Nickname')
            ->where('Tbl_Colaborador.user_id', '=', $idUser)
            ->get();
        return  $reservas;
    }
}