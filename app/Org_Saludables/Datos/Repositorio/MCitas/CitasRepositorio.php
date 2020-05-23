<?php

/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Org_Saludables\Datos\Repositorio\MCitas;

use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use Org_Saludables\Datos\Modelos\MCitas\Cita;
use Org_Saludables\Datos\Modelos\MCitas\Cita_Por_Usuario;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CitasRepositorio implements ICitasRepositorio
{


    public function GuardarCita(Jornada $jornada)
    {
        DB::beginTransaction();
        try {

            DB::commit();
            return;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }

    }



    // metodo para obtener la lista de citas que un usuario se puede reservar
    public function ObtenerListaCitas($idEmpreesa, $arrayCitasUusarios)
    {
        $data = array();
        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }
        $diaActual = Carbon::now();
        $diaActual = $diaActual->format('Y-m-d');
        $citas = DB::table('Tbl_Regionales')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            // ->latest()
            ->paginate(10);
        return $citas;
    }

    // metodo para obtener la lista de citas quee el usuario tiene reservados 
    public function ObtenerListaCitasUsuario($idUsuario, $idEmpreesa)
    {
        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->join('Tbl_Citas_Por_Usuarios', 'Tbl_Citas.id', '=', 'Tbl_Citas_Por_Usuarios.Cita_id')
            ->join('users', 'users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->select(
                'Tbl_Citas.*',
                'Tbl_Tipos_Citas.Nombre as NombreCita',
                'users.name as Nombre',
                'users.last_name as Apellidos'
            )
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('users.id', '=', $idUsuario)
            ->get();
        return $citas;

    }


    //metodo para obtener los tipos de citas que tiene un usuario reservado

    public function ObtenerTipoCitaUsuario($idUsuario, $idEmpreesa)
    {
        $tipoCitasUsuario = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->join('Tbl_Citas_Por_Usuarios', 'Tbl_Citas.id', '=', 'Tbl_Citas_Por_Usuarios.Cita_id')
            ->join('users', 'users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->select(
                'Tbl_Tipos_Citas.id'
            )
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('users.id', '=', $idUsuario)
            ->get();
        return $tipoCitasUsuario;
    }



    //metodo para obtener los horarios que tiene un usuario reservado

    public function ObtenerHorarioCitaUsuario($idUsuario, $idEmpreesa)
    {
        $horarioCitasUsuario = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->join('Tbl_Citas_Por_Usuarios', 'Tbl_Citas.id', '=', 'Tbl_Citas_Por_Usuarios.Cita_id')
            ->join('users', 'users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->select(
                'Tbl_Citas.*'
            )
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('users.id', '=', $idUsuario)
            ->get();
        return $horarioCitasUsuario;
    }

    public function ObtenerCita($idCita)
    {
        return Cita::where('id', '=', $idCita)->get()->first();
    }

    public function ReservarCita($Cita, $usuario, $jornada)
    {
        DB::beginTransaction();
        try {
            if ($Cita->EstadoReserva == 0 && $Cita->Cupos == $jornada->Cupos) {
                $Cita->EstadoReserva = 1;
                $Cita->Cupos--;
                $Cita->save();
                $citaPorUsuario = new Cita_Por_Usuario();
                $citaPorUsuario->cita_id = $Cita->id;
                $citaPorUsuario->user_id = $usuario;
                $citaPorUsuario->save();
                DB::commit();
                return true;
            } else if ($jornada->Cupos > 1 && $Cita->Cupos > 0) {

                $Cita->Cupos--;
                $Cita->save();
                $citaPorUsuario = new Cita_Por_Usuario();
                $citaPorUsuario->cita_id = $Cita->id;
                $citaPorUsuario->user_id = $usuario;
                $citaPorUsuario->save();
                DB::commit();
                return true;

            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }


    }

    public function CancelarCita($Cita, $usuario, $jornada)
    {
        DB::beginTransaction();
        try {
            $Cita->Cupos++;
            if ($jornada->Cupos == $Cita->Cupos) {
                $Cita->EstadoReserva = 0;
            }
            $Cita->save();
            DB::commit();
            return true;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }


    }

    public function EliminarCitaPorUsuario($idCita, $idUsuario,$Cita,$jornada)
    {
        DB::beginTransaction();
        try{

            $citasPorUsuario = DB::table('Tbl_Citas_Por_Usuarios')
                ->select('Tbl_Citas_Por_Usuarios.*')
                ->where('Tbl_Citas_Por_Usuarios.Cita_id', '=', $idCita)
                ->where('Tbl_Citas_Por_Usuarios.user_id', '=', $idUsuario);
            $citasPorUsuario->delete();
            $Cita->Cupos++;
            if ($jornada->Cupos == $Cita->Cupos) {
                $Cita->EstadoReserva = 0;
            }
            $Cita->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;

        }
    }

    public function BorrarCita($idCita)
    {
        DB::beginTransaction();
        try{
            $cita = DB::table('Tbl_Citas')
                ->select('Tbl_Citas.*')
                ->where('Tbl_Citas.id', '=', $idCita);
            $cita->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;

        }
    }

    public function GuardarIdEvento($cita, $idEvento, $citaPorUsuario)

    {
        DB::beginTransaction();
        try {
            $citaPorUsuario->idEvento=$idEvento;
            $citaPorUsuario->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }


    public function EliminarIdEvento($idEvento, $cita, $citaPorUsuario)
    {
        DB::beginTransaction();
        try{
            $citaPorUsuario->idEvento= " ";
            $citaPorUsuario->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;

        }
    }
    public function CruceCitas($idUsuario,$informacionCitaReservada, $InicioAReservar, $FinAReservar)
    {
        $citasReservadas = DB::table('Tbl_Citas')
            ->join('Tbl_Citas_Por_Usuarios', 'Tbl_Citas.id', '=', 'Tbl_Citas_Por_Usuarios.Cita_id')
            ->join('users', 'users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->whereBetween('Tbl_Citas.Inicio', array( $InicioAReservar, $FinAReservar))
            ->orwhereBetween('Tbl_Citas.Fin', array( $InicioAReservar, $FinAReservar))
            ->where ('Tbl_Citas.id', '=',$informacionCitaReservada)
            ->where('users.id', '=', $idUsuario)
            ->select(DB::raw('count(*) as numero'))
            ->get();
        return $citasReservadas;
    }



    public function BuscardorCitasxFecha($idEmpreesa, $arrayCitasUusarios,$fecha)
    {
        $data = array();
        $diaActual = Carbon::now();
        $diaActual = $diaActual->format('Y-m-d');
        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }
        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Citas.Fecha','like', '%'.$fecha.'%')
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);
        // ->get();
        return $citas;
    }

    public function BuscardorCitasxTipoCita($idEmpreesa, $arrayCitasUusarios,$tipoCita)
    {
        $data = array();
        $diaActual = Carbon::now();
        $diaActual = $diaActual->format('Y-m-d');
        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }
        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Tipos_Citas.Nombre','like','%'.$tipoCita.'%')
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);

        return $citas;
    }

    public function BuscardorCitasxRegional($idEmpreesa, $arrayCitasUusarios,$regional)
    {
        $data = array();

        $diaActual = Carbon::now();

        $diaActual = $diaActual->format('Y-m-d');


        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }




        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Regionales.Nombre','like','%'.$regional.'%')
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);

        //->get();
        return $citas;

    }

    public function BuscardorCitasxFechaYTipoCita($idEmpreesa, $arrayCitasUusarios,$fecha,$tipoCita)
    {
        $data = array();

        $diaActual = Carbon::now();

        $diaActual = $diaActual->format('Y-m-d');


        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }




        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Citas.Fecha','like','%'.$fecha.'%')
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Tipos_Citas.Nombre','like','%'.$tipoCita.'%')
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);
        //->get();
        return $citas;
    }

    public function BuscardorCitasxFechaYRegional($idEmpreesa, $arrayCitasUusarios,$fecha, $regional)
    {
        $data = array();

        $diaActual = Carbon::now();

        $diaActual = $diaActual->format('Y-m-d');

        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }




        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Citas.Fecha','like','%'.$fecha.'%')
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Regionales.Nombre','like','%'.$regional.'%')
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);
        // ->get();
        return $citas;
    }
    public function BuscardorCitasxRegionalYTipoCita($idEmpreesa, $arrayCitasUusarios,$regional,$tipoCita)
    {
        $data = array();

        $diaActual = Carbon::now();

        $diaActual = $diaActual->format('Y-m-d');

        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }




        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Tipos_Citas.Nombre','like','%'.$tipoCita.'%')
            ->where('Tbl_Regionales.Nombre','like','%'.$regional.'%')
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);

        //->get();
        return $citas;
    }

    public function BuscardorCitasxRegionalTipoCitaYFecha($idEmpreesa, $arrayCitasUusarios,$regional,$tipoCita, $fecha)
    {
        $data = array();

        $diaActual = Carbon::now();

        $diaActual = $diaActual->format('Y-m-d');


        foreach ($arrayCitasUusarios as $citasUsuario) {
            $data[] = $citasUsuario->id;
        }




        $citas = DB::table('Tbl_Regionales')
            // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join('Tbl_Citas', 'Tbl_Citas.Jornada_id', '=', 'Tbl_Jornadas.id')
            ->select('Tbl_Citas.*', 'Tbl_Regionales.Nombre as NombreRegional', 'Tbl_Tipos_Citas.Nombre as NombreCita', 'Tbl_Jornadas.Cupos as CuposJornada',  'Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Tipos_Citas.Nombre','like','%'.$tipoCita.'%')
            ->where('Tbl_Regionales.Nombre','like','%'.$regional.'%')
            ->where('Tbl_Citas.Fecha','=', 'like','%'.$fecha.'%')
            ->where('Tbl_Citas.Fecha', '>=', $diaActual)
            ->where('Tbl_Citas.Cupos', '>', 0)
            ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->whereNotIn('Tbl_Tipos_Citas.id', $data)
            //->whereNotBetween('Tbl_Citas.Inicio', [$dataInicial, $dataFinal] )
            // ->whereNotBetween('Tbl_Citas.Fin',  [$dataInicial, $dataFinal])
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
            ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
            ->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->latest()
            ->paginate(200);

        //->get();
        return $citas;
    }

    public function ObtenerCitaPorUsuario($idCita, $idUsuario)
    {

        return Cita_Por_Usuario::where('Cita_id', '=', $idCita)
            ->where('user_id', '=', $idUsuario)
            ->get()->first();
    }

}