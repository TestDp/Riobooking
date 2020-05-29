@extends('layouts.principal')

@section('content')
    <form id="formUsuario" enctype="multipart/form-data">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear Usuario</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="name" name="name" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorname"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Apellidos</label>
                                <input id="last_name" name="last_name" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorlast_name"></span>
                            </div>
                            <div class="col-md-4">
                                <label>UserName</label>
                                <input id="username" name="username" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorusername"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Correo Electrónico</label>
                                <input id="email" name="email" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="erroremail"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Telefono</label>
                                <input id="telefono" name="telefono" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errortelefono"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Contraseña</label>
                                <input id="password" name="password" type="password" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorpassword"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Confirmar Contraseña</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorpassword_confirmation"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                   <label>Negocio</label>
                                <select id="Compania_id" name="Compania_id"  class="form-control"  name="language" onchange="cargarSedesEmpresa()">
                                    <option value="">Seleccionar</option>
                                    @foreach($listCompanias as $compania)
                                        <option value="{{ $compania->id }}">{{ $compania->Nombre }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert" id="errorSede_id"></span>
                            </div>
                            <div class="col-md-6">
                                   <label>Sede</label>
                                <select id="Sede_id" name="Sede_id"  class="form-control" multiple name="language">

                                </select>
                                <span class="invalid-feedback" role="alert" id="errorRoles_id"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Roles</label>
                                <select id="Roles_id" name="Roles_id[]"  class="form-control" multiple name="language">
                                    <option value="">Seleccionar</option>
                                    @foreach($listRoles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->Nombre }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert" id="errorRoles_id"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarUsuario()" type="button" class="btn btn-success">Crear Usuario</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

    <link href="{{ asset('js/Plugins/fastselect-master/dist/fastselect.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/fastselect-master/dist/fastsearch.js') }}"></script>
    <script src="{{ asset('js/Plugins/fastselect-master/dist/fastselect.js') }}"></script>


    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#Sede_id').fastselect({
                placeholder: 'Seleccione la sede',
                searchPlaceholder: 'Buscar opciones'
            });
            $('#Roles_id').fastselect({
                placeholder: 'Seleccione los roles',
                searchPlaceholder: 'Buscar opciones'
            });
            $('#Compania_id').fastselect({
                placeholder: 'Seleccione los roles',
                searchPlaceholder: 'Buscar opciones'
            });
        });

    </script>
@endsection
