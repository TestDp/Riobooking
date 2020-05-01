<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */

namespace App\Http\Controllers\MEmpresa;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MEmpresa\SedeDTO;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Org_Saludables\Validaciones\MEmpresa\SedeValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class SedeController extends Controller
{
    protected  $sedeServicio;
    protected  $sedeValidaciones;

    public function __construct(ISedeServicio $sedeServicio,SedeValidaciones $sedeValidaciones){
        $this->sedeServicio = $sedeServicio;
        $this->sedeValidaciones = $sedeValidaciones;
    }

    //Metodo para cargar  la vista de crear sede
    public function CrearSede(Request $request)
    {
     
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        
        $view = View::make('MEmpresa/Sede/crearSede');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Sede/crearSede');
    }

    //Metodo para guardar la sede
    public  function GuardarSede(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->sedeValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $prueba = $request->all();
            $sede = new SedeDTO($request->all());
            $sede->Compania_id = $idEmpreesa;
            $repuesta = $this->sedeServicio->GuardarSede($sede);
            if($repuesta == true){
                $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
                $view = View::make('MEmpresa/Sede/listaSedes')->with('listSedes',$sedes);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MEmpresa/Sede/listaSedes');
    }

    //Metodo para obtener toda  la lista de sede de la empresa
    public  function ObtenerSedes(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MEmpresa/Sede/listaSedes')->with('listSedes',$sedes);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Sede/listaSedes');

    }
}