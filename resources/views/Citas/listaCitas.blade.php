@extends('layouts.principal')

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="box_general">
                <div class="header_box">
                    <h2 class="d-inline-block">Mis Citas</h2>
                </div>
                <div class="list_general">
                    <ul>
                        <li>
                            <h4>Diego Patino <i class="approved">Aprobada</i></h4>
                            <ul class="booking_details">
                                <li><strong>Fecha: </strong>  06/06/2020</li>
                                <li><strong>Hora: </strong> 10:00 AM</li>
                                <li><strong>Profesional: </strong> Milo barber</li>
                                <li><strong>Celular: </strong> 0043 432324</li>
                                <li><strong>Correo: </strong> user@email.com</li>
                            </ul>
                            <ul class="buttons">
                                <li><a href="#0" style="color:red; border: 1px solid red; border-radius: 15px; padding: 3px;"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar cita</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>


@endsection
