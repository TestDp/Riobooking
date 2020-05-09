<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 9:39 AM
 */

namespace App\Http\Controllers\MSistema;

use App\Http\Controllers\Controller;
use Org_Saludables\Validaciones\MSistema\TipoCitaValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Illuminate\Support\Facades\View;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;
use Illuminate\Support\Facades\Auth;

class TipoCitaController extends Controller
{
    protected  $TipoCitaServicio;
    protected $tipoCitaValidaciones;
    protected  $sedeServicio;
    public function __construct(TipoCitaServicio $TipoCitaServicio,TipoCitaValidaciones $tipoCitaValidaciones,ISedeServicio $sedeServicio){
        $this->middleware('auth');
        $this->TipoCitaServicio = $TipoCitaServicio;
        $this->tipoCitaValidaciones = $tipoCitaValidaciones;
         $this->sedeServicio = $sedeServicio;
    }

    //Metodo para cargar  la vista de crear el tipo de citas
    public function CrearTipoCita(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
         $idSede = Auth::user()->Sede_id;
         $regionales = $this->sedeServicio->ObtenerListaSedes($idSede);
        $view = View::make('MSistema/TipoCita/crearTipoCita')->with('listRegionales',$regionales);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/TipoCita/crearTipoCita');
    }

    //Metodo para guardar el tipo de documento
    public  function GuardarTipoCita(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->tipoCitaValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $idSede = Auth::user()->Sede_id;
            $repuesta = $this->TipoCitaServicio->GuardarTipoCita($request);
            if($repuesta == true){
                $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idSede);
                $view = View::make('MSistema/TipoCita/listaCitas')->with('listCitas',$tiposCitas);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MSistema/TipoCita/listaCitas');
    }

    //Metodo para obtener toda  la lista de tipos de citas
    public  function ObtenerTiposCitas(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idSede = Auth::user()->Sede_id;
        $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idSede);
        $view = View::make('MSistema/TipoCita/listaCitas')->with('listCitas',$tiposCitas);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/TipoCita/listaCitas');
    }

    public  function ObtenerTiposCitasR($idRegional){
      
        return response()->json($this->TipoCitaServicio->ObtenerListaTipoCitasR($idRegional));
        
        
    }
}

