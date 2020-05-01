<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Org_Saludables\Datos\Repositorio\MCitas;



use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use App\Org_Saludables\Datos\Repositorio\MCitas\IJornadaRepositorio;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use Org_Saludables\Datos\Modelos\MCita\Cita;
use Illuminate\Support\Facades\DB;

class JornadaRepositorio implements IJornadaRepositorio
{

    protected  $citaRepositorio;
    public function __construct(ICitasRepositorio $citaRepositorio){
       
        $this->citaRepositorio=$citaRepositorio;
    }
    public  function GuardarJornada(Jornada $jornada,$arrayCitas)
    {
        DB::beginTransaction();
        try {
            $jornada->save();
            
             foreach ($arrayCitas as $cita) {
                 $cita->Jornada_id = $jornada->id;
                 $cita->save();
             }   
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

     public  function  ObtenerListaJornadas($idEmpreesa)
     {    
          $jornadas = DB::table('Tbl_Regionales')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->select('Tbl_Jornadas.*','Tbl_Regionales.Nombre as NombreRegional','Tbl_Tipos_Citas.Nombre as NombreCita')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
             ->where ('Tbl_Tipos_Citas.activa','=', 1)
            ->get();
        return  $jornadas;
       
    }

    
     public  function  ObtenerJornada($idEmpreesa, $idJornada)
     {    
          $jornadas = DB::table('Tbl_Regionales')
           // ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Companias', 'Tbl_Companias.id', '=', 'Tbl_Regionales.Compania_id')
            ->join('Tbl_Jornadas', 'Tbl_Regionales.id', '=', 'Tbl_Jornadas.Regional_id')
            ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
            ->join ('Tbl_Citas', 'Tbl_Jornadas.id', '=', 'Tbl_Citas.Jornada_id')
            ->leftjoin ('Tbl_Citas_Por_Usuarios','Tbl_Citas.id', '=', 'Tbl_Citas_Por_Usuarios.Cita_id')
            ->leftjoin ('users','users.id', '=', 'Tbl_Citas_Por_Usuarios.user_id')
            ->select('Tbl_Citas.*','Tbl_Regionales.Nombre as NombreRegional','Tbl_Tipos_Citas.Nombre as NombreCita',
            'users.name as Nombre', 'users.last_name as Apellidos','users.email as email','users.telefono as Telefono','users.username as cedula','Tbl_Jornadas.Lugar as Lugar')
            ->where('Tbl_Companias.id', '=', $idEmpreesa)
            ->where('Tbl_Jornadas.id', '=', $idJornada)
            ->orderByRaw('Tbl_Citas.Fecha', 'ASC')
           ->orderByRaw('Tbl_Citas.Inicio', 'ASC')
           //->orderByRaw('Tbl_Regionales.Nombre', 'ASC')
            ->get();
        return  $jornadas;
       
    }
      //metodo para obtener una jornada especifica 
      public function ObtenerJornadaC($idJornada)
    {

        return Jornada::where('id', '=', $idJornada)->get()->first();
    }
   
     public function CruceJornadas($informacionJornadaGuardada, $InicioJornadaCrear,  $FinJornadaCrear)
    {
        $jornadasGuardadas = DB::table('Tbl_Jornadas')
         
         ->whereBetween('Tbl_Jornadas.Inicio', array( $InicioJornadaCrear, $FinJornadaCrear))
        ->orwhereBetween('Tbl_Jornadas.Fin', array( $InicioJornadaCrear, $FinJornadaCrear))
        ->where ('Tbl_Jornadas.id', '=',$informacionJornadaGuardada)
   
      
         ->select(DB::raw('count(*) as numero'))
         ->get();


        return $jornadasGuardadas;


    }

     public  function  InformacionJornada($idJornada)
     {    
          $jornadas = DB::table('Tbl_Jornadas')
             ->join('Tbl_Tipos_Citas', 'Tbl_Tipos_Citas.id', '=', 'Tbl_Jornadas.Tipo_Cita_id')
           ->select('Tbl_Jornadas.*','Tbl_Tipos_Citas.Nombre as NombreCita')
            

            ->where('Tbl_Jornadas.id', '=', $idJornada)
            ->get()->first();
        return  $jornadas;
       
    }
}
