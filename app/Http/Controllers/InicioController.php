<?php

namespace App\Http\Controllers;

use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;

class InicioController extends Controller
{
    protected  $companiaServicio;
    protected  $tipoCitaServicio;

    public function __construct(ICompaniaServicio $companiaServicio,TipoCitaServicio $tipoCitaServicio){
        $this->companiaServicio =  $companiaServicio;
        $this->tipoCitaServicio =  $tipoCitaServicio;
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
}
