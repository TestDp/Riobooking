@extends('layouts.principal')

@section('content')

    <form id="formServicio">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

        <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Asignacion servicios</h3></div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <label>Colaborador</label>
                        <select id="Regional_id" name="Regional_id"  class="form-control"  name="language" onchange="CargarTiposCitasPorRegional()">
                            <option value="">Seleccionar</option>
                            @foreach($listColaboradores as $servicio)
                                <option value="{{$servicio->id}}">{{$servicio->Nombre}}</option>
                            @endforeach

                        </select>
                        <span class="invalid-feedback" role="alert" id="errorRegional_id"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Asignar Servicios a colaboradores</label>
                            <select id="TipoCita_id" name="Servicio_id[]"  class="form-control" multiple name="language">
                                <option value="">Seleccionar</option>
                                @foreach($listServicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->Nombre }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert" id="errorRoles_id"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="GuardarServicioColaborador()" type="button" class="btn btn-success">Crear Asignacion servicios</button>
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
            $('#tablaTiposCitas').DataTable({
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
