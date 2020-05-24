<?php

namespace App\Http\Controllers;

use App\Org_Saludables\Negocio\Logica\MCitas\AgendaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\ColaboradorServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Org_Saludables\Negocio\Logica\MEmpresa\SedeServicio;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InicioController extends Controller
{
    protected  $companiaServicio;
    protected  $tipoCitaServicio;
    protected  $sedeServicio;
    protected  $colaboradorServicio;
    protected  $agendaServicio;

    public function __construct(ICompaniaServicio $companiaServicio,TipoCitaServicio $tipoCitaServicio,
                                SedeServicio $sedeServicio,ColaboradorServicio $colaboradorServicio,AgendaServicio $agendaServicio){
        $this->companiaServicio =  $companiaServicio;
        $this->tipoCitaServicio =  $tipoCitaServicio;
        $this->sedeServicio = $sedeServicio;
        $this->colaboradorServicio = $colaboradorServicio;
        $this->agendaServicio = $agendaServicio;
    }

    public function cargarVistaNegocios(Request $request)
    {
        $companias = $this->companiaServicio->ObtenerListaCompanias();
        $view = View::make('riobooking')->with('listCompanias',$companias);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else
        {
            return view ('riobooking')->with('listCompanias',$companias);
        }

    }

    public function cargarVistaPerfilNegocio(Request $request, $idCompania)
    {
        $companiaDTO = $this->companiaServicio->ObtenerCompania($idCompania);
        $tiposCitasDTO = $this->tipoCitaServicio->ObtenerListaTipoCitas($idCompania);
        $view = View::make('perfil');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else
        {
            return view ('perfil',array('Compania'=>$companiaDTO,'tiposCitas'=>$tiposCitasDTO));
        }
    }

    //Metodo para obtener toda  la lista de sede de la empresa
    public  function cargarSedesEmpresa($idCompania)
    {
      $sedes = $this->sedeServicio->ObtenerListaSedes($idCompania);
      return Response::json($sedes);
    }

    //Metodo para cargar  la vista para seleccionar un colaborador cuando se va a realizar una reserva
    public function CargarVPListaColaboradores(Request $request, $idTipoCita)
    {
        $colaboradoresDTO = $this->colaboradorServicio->ObtenerListaColaboradoresPorServicio($idTipoCita);
        $view = View::make('MSistema/Colaborador/listaColaboradoresVP')->with('Colaboradores',$colaboradoresDTO);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/listaColaboradoresVP');
    }

    public function CargarVPDisponibilidadColaborador(Request $request,$idColaborador){
        $noDisponibilidadDTO = $this->agendaServicio->obtenerFechasNoDisponibles($idColaborador);
        $view = View::make('MSistema/Colaborador/disponibilidadColaboradorVP');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json(['vista'=>$sections['content'],'noDisponibilidadDTO'=>$noDisponibilidadDTO]);
        }else return view('MSistema/Colaborador/disponibilidadColaboradorVP');
    }

    public function CargarVPTurnosDisponibles(Request $request,$fechaConsulta,$idColabordor){
        $fecha = date('Y-m-d',strtotime($fechaConsulta));
        $turnosDisponibleXfecha = $this->agendaServicio->obtenerTunosDisponibleDia($idColabordor,$fecha);
        $view = View::make('MSistema/Colaborador/turnosDisponiblesVP')->with('turnos',$turnosDisponibleXfecha);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/turnosDisponiblesVP');
    }

    public function CargarVPRegistrarUsuario(Request $request){
        $view = View::make('auth/registrarUsuarioVP');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('auth/registrarUsuarioVP');
    }


}
