@extends('layouts.principal')

@section('content')

    <div class="container">
              <div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(66, 79, 99); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; display: block; opacity: 0;"><div style="position: relative; top: 34px; float: right; width: 6px; height: 116px; background-color: rgb(242, 179, 63); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div>
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Citas Reservadas</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaCitasUsuario">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo cita</th>
                            <th scope="col">Usuario Reserva</th>
                            <th>           </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listCitas as $Cita)
                            <tr>
                                <th scope="row">{{$Cita->id}}</th>
                                <td >{{$Cita->Fecha}}</td>
                                <td>{{$Cita->Inicio}}</td>
                                <td>{{$Cita->Fin}}</td>
                                <td>{{$Cita->NombreCita}}</td>
                                <td>{{$Cita->Nombre.$Cita->Apellidos}}</td>
                                <td> <button onclick="GuardarCancelacion({{$Cita->id}})" type="button" class="btn btn-success">Cancelar</button></td>
                            
                               

         

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
                </div>
            </div>

        </div>
    </div>
 <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
     <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaCitasUsuario').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page'
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });

    </script>


@endsection
