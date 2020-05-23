<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */
namespace App\Http\Controllers\MCitas;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MCitas\BuscadorDTO;
use App\Org_Saludables\Negocio\Logica\MCitas\ICitaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\CitaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\IJornadaServicio;
use Org_Saludables\Negocio\Logica\Google\GoogleCalendar;
use App\Org_Saludables\Negocio\Logica\MCitas\JornadaServicio;
use Org_Saludables\Validaciones\MCitas\CitaValidaciones;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Redirect;


class CitaController extends Controller
{
    protected  $jornadaServicio;
    protected  $citaValidaciones;
    protected  $sedeServicio;
    protected  $TipoCitaServicio;
    protected $googleCalendar;


    public function __construct(ICitaServicio $citaServicio,CitaValidaciones $citaValidaciones,ISedeServicio $sedeServicio,
                                TipoCitaServicio $TipoCitaServicio, IJornadaServicio $jornadaServicio, GoogleCalendar $googleCalendar){
        $this->citaServicio =  $citaServicio;
        $this->citaValidaciones = $citaValidaciones;
        $this->sedeServicio = $sedeServicio;
        $this->TipoCitaServicio = $TipoCitaServicio;
        $this->jornadaServicio=$jornadaServicio;
        $this->googleCalendar=$googleCalendar;
    }

    //Metodo para cargar  la vista de crear Compania
    public function CrearJornada(Request $request)
    {

        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitasR($idEmpreesa, $request['Regional_id']);
        $view = View::make('Citas/crearJornada')->with('listRegionales',$regionales)->with('listTiposCitas',$tiposCitas);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Citas/crearJornada');
    }

    //Metodo para guardar la reserva
    public  function GuardarReserva(Request $request,$idCita)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idCita,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $cita = $this->citaServicio->ObtenerCita($idCita);
            $usuario= Auth::user()->id;
            $ijornada=$cita->Jornada_id;
            $jornada=$this->jornadaServicio->ObtenerJornadaC($ijornada);
            $repuesta = $this->citaServicio->ReservarCita($cita, $usuario, $jornada);
            $citaPorUsuario=$this->citaServicio->ObtenerCitaPorUsuario($idCita, $usuario);
            if($repuesta == true){
                $ijornada=$cita->Jornada_id;
                $jornada=$this->jornadaServicio->InformacionJornada($ijornada);
                $this->googleCalendar->store($cita, $jornada, $citaPorUsuario);
                $citas = $this->citaServicio->ObtenerListaCitas($idEmpreesa);
                $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
                $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idEmpreesa);
                $view = View::make('Citas/listaCitas')->with('listCitas',$citas)->with('listRegionales',$regionales)->with('listTiposCitas',$tiposCitas);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('Citas/listaCitas');
    }

    //Metodo para obtener las citas de citas para que el usuario reserve 
    public  function ObtenerCitas(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $respuestaGoogle= $this->googleCalendar->index();
        if ($respuestaGoogle['respuesta']==false)
        {
            $urlGoogle=$respuestaGoogle['resultado'];
            return Redirect::to($urlGoogle);

        }
        $citas = $this->citaServicio->ObtenerListaCitas($idEmpreesa);
        $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idEmpreesa);
        if($request->ajax()){

            return view('Citas/datosPagCitas')->with('listCitas',$citas)->render();
        }
        else
        {
            return view('Citas/listaCitas')->with('listCitas',$citas)->with('listRegionales',$regionales)->with('listTiposCitas',$tiposCitas);

        }
    }

    public  function ObtenerCitasUsuario(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $usuario = Auth::user()->id;
        $idEmpreesa = Auth::user()->Compania_id;
        $respuestaGoogle= $this->googleCalendar->index();
        if ($respuestaGoogle['respuesta']==false)
        {
            $urlGoogle=$respuestaGoogle['resultado'];
            return Redirect::to($urlGoogle);

        }
        $citas = $this->citaServicio->ObtenerListaCitasUsuario($usuario, $idEmpreesa);
        return view('Citas/listaCitasUsuario')->with('listCitas',$citas);
    }

    public  function GuardarCancelacion(Request $request,$idCita)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idCita,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $cita = $this->citaServicio->ObtenerCita($idCita);
            $usuario= Auth::user()->id;
            $citaPorUsuario=$this->citaServicio->ObtenerCitaPorUsuario($idCita, $usuario);
            $ijornada=$cita->Jornada_id;
            $jornada=$this->jornadaServicio->ObtenerJornadaC($ijornada);
            $repuesta = $this->citaServicio->CancelarCita($cita, $usuario, $jornada);
            if($repuesta == true){
                $idEvento=$citaPorUsuario->idEvento;
                if ($idEvento != null)
                {
                    $this->googleCalendar->destroy($idEvento, $cita, $citaPorUsuario);
                }
                $citas = $this->citaServicio->ObtenerListaCitas($idEmpreesa);
                $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
                $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idEmpreesa);
                $view = View::make('Citas/listaCitas')->with('listCitas',$citas)->with('listRegionales',$regionales)->with('listTiposCitas',$tiposCitas);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('Citas/listaCitas');
    }

    public function BuscarCistas(Request $request){
        $data =(array) json_decode($_POST['array']);
        $buscador =  new BuscadorDTO($data);
        $idEmpreesa=Auth::user()->Compania_id;
        $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $tiposCitas = $this->TipoCitaServicio->ObtenerListaTipoCitas($idEmpreesa);
        $buscador->idEmpresa = $idEmpreesa = Auth::user()->Compania_id;
        $citas = $this->citaServicio->ObtenerListaCitasBuscador($buscador);
        if(isset($request['page']))
        {
            return view('Citas/datosPagCitas', ['listCitas' => $citas])->render();
        }else{
            $view = View::make('Citas/listaCitas')->with('listCitas',$citas)->with('listRegionales',$regionales)->with('listTiposCitas',$tiposCitas);
        }
        $sections = $view->renderSections();
        return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
    }

    // es la funcionalidas que le permite al administrador de citas borrar una de las citas
    public  function GuardarBorrado(Request $request,$idCita)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idCita,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $cita = $this->citaServicio->ObtenerCita($idCita);
            $idJornada=$cita->Jornada_id;
            $repuesta = $this->citaServicio->BorrarCita($idCita);
            if($repuesta == true){
                $jornada = $this->jornadaServicio->ObtenerJornada($idEmpreesa, $idJornada);
                $view = View::make('Citas/detalleJornada')->with('jornada',$jornada);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('Citas/detalleJornada');

    }
}