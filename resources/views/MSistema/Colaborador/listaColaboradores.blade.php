@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Colaboradores</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaUsuarios">
                        <thead>
                        <tr>
                            <th scope="col">Foto de perfil</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Correo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listColaboradores as $usuario)
                            <tr>
                                <th><div style="background-size: cover; background-repeat: no-repeat; background-image: url('')"class="logo-negocio"></div></th>
                                <td>{{$usuario->name}} {{$usuario->last_name}}</td>
                                <td>{{$usuario->username}}</td>
                                <td>{{$usuario->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearColaborador()" type="button" class="btn btn-success">Nuevo Colaborador</button>
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
            $('#tablaUsuarios').DataTable({
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
