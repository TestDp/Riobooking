<?php

namespace App\Http\Controllers;

use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class InicioController extends Controller
{
    protected  $companiaServicio;

    public function __construct(ICompaniaServicio $companiaServicio){
        $this->companiaServicio =  $companiaServicio;
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
}
