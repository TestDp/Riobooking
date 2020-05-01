<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */

namespace App\Http\Controllers\MEmpresa;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MEmpresa\RegionalDTO;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IRegionalServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Org_Saludables\Validaciones\MEmpresa\RegionalValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class RegionalController extends Controller
{
    protected  $regionalServicio;
    protected  $regionalValidaciones;
    protected  $sedeServicio;

    public function __construct(IRegionalServicio $regionalServicio,RegionalValidaciones $regionalValidaciones, ISedeServicio $sedeServicio){
        $this->regionalServicio = $regionalServicio;
        $this->regionalValidaciones = $regionalValidaciones;
        $this->sedeServicio = $sedeServicio;

    }

    //Metodo para cargar  la vista de crear sede
    public function CrearRegional(Request $request)
    {
     
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MEmpresa/Regional/crearRegional')->with('listRegionales',$regionales);;
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Regional/crearRegional');
    }

    //Metodo para guardar la sede
    public  function GuardarRegional(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->regionalValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $regional = new RegionalDTO($request->all());
           // $sede->Compania_id = $idEmpreesa;
            $repuesta = $this->regionalServicio->GuardarRegional($regional);
            if($repuesta == true){
                $regionales = $this->regionalServicio->ObtenerListaRegionales($idEmpreesa);
                $view = View::make('MEmpresa/Regional/listaRegionales')->with('listSedes',$regionales);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MEmpresa/Regional/listaRegionales');
    }

    //Metodo para obtener toda  la lista de sede de la empresa
    public  function ObtenerRegionales(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $regionales = $this->regionalServicio->ObtenerListaRegionales($idEmpreesa);
        $view = View::make('MEmpresa/Regional/listaRegionales')->with('listSedes',$regionales);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/Regional/listaRegionales');

    }
}