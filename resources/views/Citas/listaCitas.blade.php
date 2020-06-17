@extends('layouts.principal')

@section('content')
    <form id="formDetalleCita">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="box_general">
                <div class="header_box">
                    <h2 class="d-inline-block">Mis Citas</h2>

                </div>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

                <div class="list_general">
                    <ul>
                        @foreach($reservas as $reserva)
                        <li>

                            <h4>{{$reserva->title}}  <i class="approved">Aprobada</i></h4>
                            <ul class="booking_details">

                                <input type="hidden" id="idCitaUser" name="idCitaUser" value="{{$reserva->idCitaUser}}">
                                <li><strong>Fecha: </strong>  {{$reserva->start}}</li>
                                <li><strong>Hora: </strong> {{$reserva->start}}</li>
                                <li><strong>Lugar: </strong> {{$reserva->nombreNegocio}}</li>

                            </ul>
                            <ul class="buttons">
                                <li><a onclick="CancelarCita()"  style="color:red; border: 1px solid red; border-radius: 15px; padding: 3px;"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar cita</a></li>
                            </ul>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>
    </form>

@endsection
