@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3> Servicios Por Colaboradores</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaServiciosColaborador">
                        <thead>
                        <tr>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Tipo Servicio</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listServiciosPorColaboradores as $servicioColaborador)
                            <tr>
                                <td>{{$servicioColaborador->NombreColaborador}}</td>
                                <td>{{$servicioColaborador->NombreServicio}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearServicioColaborador()" type="button" class="btn btn-success">Nuevo Asignacion de Servicio</button>
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
            $('#tablaServiciosColaborador').DataTable({
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
