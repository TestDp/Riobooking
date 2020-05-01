<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Repositorio\MCitas\IJornadaRepositorio;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\JornadaDTO;
use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use App\Org_Saludables\Negocio\Logica\MCitas\IJornadaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\ICitaServicio;
use Illuminate\Support\Facades\Auth;



class JornadaServicio implements IJornadaServicio
{
    protected  $jornadaRepositorio;
    protected  $citaRepositorio;
    protected  $citaServicio;
    public function __construct(IJornadaRepositorio $jornadaRepositorio, ICitasRepositorio $citaRepositorio,
                                ICitaServicio $citaServicio){
        $this->jornadaRepositorio = $jornadaRepositorio;
        $this->citaRepositorio=$citaRepositorio;
        $this->citaServicio=$citaServicio;

    }

    public  function GuardarJornada(JornadaDTO $jornadaDTO, $request){


        $jornadaModel = $jornadaDTO->toModel(Jornada::class);
        $idEmpreesa = Auth::user()->Compania_id;
        $jornadasCreadas = $this->jornadaRepositorio->ObtenerListaJornadas($idEmpreesa);
        // $jornadas = $this->citaRepositorio->ObtenerHorarioCitaUsuario($usuario, $idEmpreesa);
        foreach ($jornadasCreadas as $jornada)
        {
            if($jornada->Fecha ==$jornadaModel->Fecha && $jornada->Regional_id ==$jornadaModel->Regional_id)
            {
                if (strcmp ($jornada->Lugar , $jornadaModel->Lugar ) == 0)
                {
                    $informacionJornadaGuardada=$jornada->id;
                    $InicioJornadaCrear= $jornadaModel->Inicio;
                    $FinJornadaCrear=$jornadaModel->Fin;
                    $InicioJornadaGuardada=$jornada->Inicio;
                    $FinJornadaGuardada=$jornada->Fin;
                    if ((($InicioJornadaCrear>$InicioJornadaGuardada) &&  ($InicioJornadaCrear<$FinJornadaGuardada)) || (($FinJornadaCrear>$InicioJornadaGuardada) &&  ($FinJornadaCrear<$FinJornadaGuardada))||(($InicioJornadaCrear>=$InicioJornadaGuardada) &&  ($FinJornadaCrear<=$FinJornadaGuardada)))
                    {
                        return false;
                    }
                }
            }

        }
        if ($jornadaModel->Cupos==null)
        {
            $jornadaModel->Cupos=1;
        }
        $arrayCitasModel = $this->citaServicio->ProgramarHorariosCitas($jornadaModel);
        return $this->jornadaRepositorio->GuardarJornada($jornadaModel,$arrayCitasModel);
    }

    public  function  ObtenerListaJornadas($idEmpreesa){
        return $this->jornadaRepositorio->ObtenerListaJornadas($idEmpreesa);
    }

    public  function  ObtenerJornada($idEmpreesa, $idJornada){
        return $this->jornadaRepositorio->ObtenerJornada($idEmpreesa, $idJornada);
    }

    public  function  ObtenerJornadaC($idJornada){
        return $this->jornadaRepositorio->ObtenerJornadaC($idJornada);
    }

    public  function InformacionJornada($idJornada){
        return $this->jornadaRepositorio->InformacionJornada($idJornada);
    }
}