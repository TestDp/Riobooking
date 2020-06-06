<?php

namespace App\Http\Controllers\MCitas;

use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MCitas\CitaXUsuarioDTO;
use App\Org_Saludables\Negocio\Logica\MCitas\AgendaServicio;
use Illuminate\Http\Request;
use Org_Saludables\Negocio\Logica\Google\GoogleCalendar;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Redirect;

class AgendaController extends Controller
{
    public $agendaServicio;
    protected $googleCalendar;
    public function __construct(AgendaServicio $agendaServicio, GoogleCalendar $googleCalendar){
        $this->agendaServicio = $agendaServicio;
         $this->googleCalendar=$googleCalendar;
    }

    public  function GuardarReserva(Request $request)
    {
        $reservaDTO = new CitaXUsuarioDTO($request->all());
        $reservaDTO->Estado = 1;
        $reservaDTO->user_id = $request->user()->id;
        $respuesta =  $this->agendaServicio->GuardarReserva($reservaDTO);

        if($respuesta == 'true'){
            $infoReservaDTO = $this->agendaServicio->ObtenerInformacionReserva($reservaDTO->TurnoPorColaborador_id);
            $correoElectronicoCliente = $request->user()->email;
            $infoReservaDTO->NombreCliente = $request->user()->name .' '.$request->user()->last_name;
            $correoSaliente = 'reservas@riobooking.co';
            Mail::send('Email/correoReservaCliente', ['infoReserva' => $infoReservaDTO], function ($msj) use ($correoElectronicoCliente, $correoSaliente) {
                $msj->from($correoSaliente, 'Riobooking');
                $msj->subject('Tu reserva en Riobooking ha sido exitosa');
                $msj->to($correoElectronicoCliente);
                $msj->bcc('soporteecotickets@gmail.com');
            });
            $correoColaborador = $infoReservaDTO->email;
            Mail::send('Email/correoReservaColaborador', ['infoReserva' => $infoReservaDTO], function ($msj) use ($correoSaliente,$correoColaborador) {
                $msj->from($correoSaliente, 'Riobooking');
                $msj->subject('Tienes una nueva reserva en Riobooking');
                $msj->to($correoColaborador);
                $msj->bcc('soporteecotickets@gmail.com');
            });

            
            // se comenta hasta que le den permisos o validen la aplicación desde la API de GOOGLE
           //$respuestaGoogle= $this->googleCalendar->index();
          $urlGoogle='';
           // if ($respuestaGoogle['respuesta']==false)
            //{
                //$urlGoogle=$respuestaGoogle['resultado'];
                
                
            //}

             //$this->googleCalendar->store($infoReservaDTO->Fecha, $infoReservaDTO->Inicio,$infoReservaDTO->Fin, $infoReservaDTO->NombreCompania);


            return Response::json(['respuesta'=>$urlGoogle]);

            
        }
        
      

    }

    public  function ObtenerAgenda(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idUser = $request->user()->id;
        $arrayDtoReservas  = $this->agendaServicio->obtenerReservas($idUser);
        $view = View::make('Citas/Agenda');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json(['vista'=>$sections['content'],'reservas'=>$arrayDtoReservas]);
        }else return view('Citas/Agenda');

    }

    public  function ObtenerMiCalendario(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idUser = $request->user()->id;
        $arrayDtoReservas  = $this->agendaServicio->obtenerMiCalendario($idUser);
        $view = View::make('Citas/MiCalendario');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json(['vista'=>$sections['content'],'reservas'=>$arrayDtoReservas]);
        }else return view('Citas/MiCalendario');

    }

    public function ObtenerMisCitas(Request $request){
        //$urlinfo= $request->getPathInfo();
        //$request->user()->AutorizarUrlRecurso($urlinfo);
        $view = View::make('Citas/listaCitas');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json(['vista'=>$sections['content']]);
        }else return view('Citas/listaCitas');
    }
}
