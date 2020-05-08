@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Jornadas</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaJornadas">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Regional</th>
                            <th scope="col">Cupos por Cita</th>
                            <th scope="col">Lugar</th>
                            <th scope="col">   </th>
                             <th scope="col">   </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listJornadas as $Jornada)
                            <tr>
                                <th scope="row">{{$Jornada->id}}</th>
                                <td >{{$Jornada->Fecha}}</td>
                                <td>{{$Jornada->NombreRegional}}</td>
                                <td>{{$Jornada->Cupos}}</td>
                                <td>{{$Jornada->Lugar}}</td>
                                 <td> <button onclick="VerJornada({{$Jornada->id}})" type="button" class="btn btn-success">Detalle Jornada</button></td>
                                 <td> <a class="btn btn-success" href="{{url('/exportarJornada',['idJornada'=>$Jornada->id])}}">Exportar Jornada</a></td>
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

    <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
     <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaJornadas').DataTable({
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
