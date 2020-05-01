@extends('layouts.principal')

@section('content')

    <div class="container">
     
      
        <div class="row justify-content-center">
   
            <div class="panel panel-success">
                
           
                <div class="panel-heading"><h3>Detalle Jornada</h3></div>
                <div class="panel-body">
                     <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaDetalleJornadas">
                        <thead>
                        <tr>
                          
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo Cita</th>
                            <th scope="col">Reservado</th>
                            <th scope="col">Usuario Reserva</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Lugar</th>
                             <th scope="col">Firma</th>
                               <th scope="col">   </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jornada as $Jornada)
                            <tr>
                           
                         
                                  <td >{{$Jornada->Fecha}}</td>
                                <td >{{$Jornada->Inicio}}</td>
                                <td>{{$Jornada->Fin}}</td>
                                <td>{{$Jornada->NombreCita}}</td>
                                <td>{{$Jornada->EstadoReserva}}</td>
                                <td>{{$Jornada->Nombre. " " .$Jornada->Apellidos}}</td>
                                <td>{{$Jornada->Telefono}}</td>
                                 <td>{{$Jornada->Lugar}}</td>
                                 <td>                   </td>

                                 <td> <button onclick="ajaxRenderSectionBorrarCita({{$Jornada->id}})" type="button" class="btn btn-default" aria-label="Left Align" title="Borrar Cita">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                                            </button> 
                             
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearJornada()" type="button" class="btn btn-success">Nueva Jornada</button>
                
                        </div>
                     
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
