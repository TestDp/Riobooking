<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */

namespace App\Http\Controllers\MEmpresa;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MEmpresa\CompaniaDTO;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\CompaniaServicio;
use Org_Saludables\Validaciones\MEmpresa\CompaniaValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class CompaniaController extends Controller
{
    protected  $companiaServicio;
    protected  $companiaValidaciones;

    public function __construct(ICompaniaServicio $companiaServicio,CompaniaValidaciones $companiaValidaciones){
        $this->companiaServicio =  $companiaServicio;
        $this->companiaValidaciones = $companiaValidaciones;
    }

    //Metodo para cargar  la vista de crear Compania
    public function CrearCompania(Request $request)
    {
     
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        
        $view = View::make('MEmpresa/Compania/crearCompania');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Compania/crearCompania');
    }

    //Metodo para guardar la compania
    public  function GuardarCompania(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->companiaValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            
            $compania = new CompaniaDTO($request->all());
            $nombreLogo = "LogoNegocio".$compania->Nombre.'.jpg';
            $compania->LogoNegocio = $nombreLogo;
            $respuesta = $this->companiaServicio->GuardarCompania($compania);
            if($respuesta == true){
                if($request->hasFile('fileLogoNegocio')){
                    $file = $request->file('fileLogoNegocio');
                    $nombre = $nombreLogo;
                    $file->move('LogosNegocio', $nombre);
                }
                $companias = $this->companiaServicio->ObtenerListaCompanias();
                $view = View::make('MEmpresa/Compania/listaCompanias')->with('listCompanias',$companias);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MEmpresa/Compania/listaCompanias');
    }

    //Metodo para obtener toda  la lista de compañias
    public  function ObtenerCompanias(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        //$idEmpreesa = Auth::user()->Compania_id;
        $companias = $this->companiaServicio->ObtenerListaCompanias();
        $view = View::make('MEmpresa/Compania/listaCompanias')->with('listCompanias',$companias);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Compania/listaCompanias');

    }
}