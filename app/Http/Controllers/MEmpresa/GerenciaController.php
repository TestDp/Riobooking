<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */

namespace App\Http\Controllers\MEmpresa;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MEmpresa\GerenciaDTO;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IGerenciaServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Org_Saludables\Validaciones\MEmpresa\GerenciaValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class GerenciaController extends Controller
{
    protected  $gerenciaServicio;
    protected  $gerenciaValidaciones;
    protected  $sedeServicio;

    public function __construct(IGerenciaServicio $gerenciaServicio,GerenciaValidaciones $gerenciaValidaciones, ISedeServicio $sedeServicio){
        $this->gerenciaServicio = $gerenciaServicio;
        $this->gerenciaValidaciones = $gerenciaValidaciones;
        $this->sedeServicio = $sedeServicio;

    }

    //Metodo para cargar  la vista de crear sede
    public function CrearGerencia(Request $request)
    {
     
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MEmpresa/Gerencia/crearGerencia')->with('listRegionales',$regionales); 
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Gerencia/crearGerencia');
    }

    //Metodo para guardar la Gerencia
    public  function GuardarGerencia(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->gerenciaValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $gerencia = new GerenciaDTO($request->all());
           // $sede->Compania_id = $idEmpreesa;
            $repuesta = $this->gerenciaServicio->GuardarGerencia($gerencia);
            if($repuesta == true){
                $gerencias = $this->gerenciaServicio->ObtenerListaGerencias($idEmpreesa);
                $view = View::make('MEmpresa/Gerencia/listaGerencias')->with('listGerencias',$gerencias);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MEmpresa/Gerencia/listaGerencias');
    }

    //Metodo para obtener toda  la lista de las gerencias de la empresa
    public  function ObtenerGerencias(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $gerencias = $this->gerenciaServicio->ObtenerListaGerencias($idEmpreesa);
        $view = View::make('MEmpresa/Gerencia/listaGerencias')->with('listGerencias',$gerencias);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Gerencia/listaGerencias');

    }
}