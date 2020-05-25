<?php

namespace App\Http\Controllers\MCitas;

use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MCitas\CitaXUsuarioDTO;
use App\Org_Saludables\Negocio\Logica\MCitas\AgendaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class AgendaController extends Controller
{
    public $agendaServicio;
    public function __construct(AgendaServicio $agendaServicio){
        $this->agendaServicio = $agendaServicio;
    }

    public  function GuardarReserva(Request $request)
    {
        $reservaDTO = new CitaXUsuarioDTO($request->all());
        $reservaDTO->Estado = 1;
        $reservaDTO->user_id = $request->user()->id;
        $respuesta =  $this->agendaServicio->GuardarReserva($reservaDTO);

        if($respuesta == 'true'){
            $correoElectronicoCliente = $request->user()->email;
            $correoSaliente = 'info@riobooking.co';
            Mail::send('Email/correoReservaCliente', ['ElementosArray' => "Correo Reserva Cliente"], function ($msj) use ($correoElectronicoCliente, $correoSaliente) {
                $msj->from($correoSaliente, 'Riobooking');
                $msj->subject('Tu reserva en Riobooking ha sido exitosa');
                $msj->to($correoElectronicoCliente);
                $msj->bcc('soporteecotickets@gmail.com');
            });
            Mail::send('Email/correoReservaColaborador', ['ElementosArray' => "Correo Reserva Colaborador"], function ($msj) use ($correoSaliente) {
                $msj->from($correoSaliente, 'Riobooking');
                $msj->subject('Tienes una nueva reserva en Riobooking');
                $msj->to('info@dpsoluciones.co');
                $msj->bcc('soporteecotickets@gmail.com');
            });
        }



        return Response::json(['respuesta'=>$respuesta]);

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
}
