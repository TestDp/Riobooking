@extends('layouts.principal')

@section('content')
    <style type="text/css">
        ul#menu_arbol li {
            padding: 0 10px;
        }
        ul#menu_arbol ul {
            margin-left: 5px;
        }
    </style>
    <form id="formRol">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="Empresa_id" name="Empresa_id" >
        <input type="hidden" id="id" name="id" value="{{$rol->id}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Editar Rol</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control" value="{{$rol->Nombre}}">
                                    <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            <div class="col-md-4">
                                <label>DescripciÃ³n</label>
                                <input id="Descripcion" name="Descripcion" type="text" class="form-control" value="{{$rol->Descripcion}}">
                                <span class="invalid-feedback" role="alert" id="errorDescripcion"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="menu_arbol" >
                                    @foreach($listRecursos as $recursoPadre)
                                        @if($recursoPadre->RecursoSistemaPadre_id == null)
                                            <li name="liPadre">
                                                @php ($b = false)
                                                @foreach($recursosDelRol as $recusroRol)
                                                    @if($recursoPadre->id == $recusroRol->RecursoSistema_id)
                                                        @php ($b = true)
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($b)
                                               <input name="idRecurso[]" type="checkbox" value="{{$recursoPadre->id}}" onclick="checkRecursosHijos(this)" checked>
                                                <a href="#ul{{$recursoPadre->id}}" data-toggle="collapse">{{$recursoPadre->Descripcion}} </a>
                                                @else
                                                    <input name="idRecurso[]" type="checkbox" value="{{$recursoPadre->id}}" onclick="checkRecursosHijos(this)">
                                                    <a href="#ul{{$recursoPadre->id}}" data-toggle="collapse">{{$recursoPadre->Descripcion}} </a>
                                                @endif
                                                <ul class="nav nav-second-level collapse" id="ul{{$recursoPadre->id}}" name="ulhijo">

                                                    @foreach($listRecursos as $recurso)
                                                        @if($recurso->RecursoSistemaPadre_id == $recursoPadre->id)
                                                            @php ($a = false)
                                                            @foreach($recursosDelRol as $recusroRol)
                                                                @if($recurso->id == $recusroRol->RecursoSistema_id)
                                                                    @php ($a = true)
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @if($a)
                                                            <li>
                                                                <input name="idRecurso[]" type="checkbox" value="{{$recurso->id}}" onclick="checkRecursoPadre(this)" checked>{{$recurso->Descripcion}}
                                                            </li>
                                                            @else
                                                                <li>
                                                                    <input name="idRecurso[]" type="checkbox" value="{{$recurso->id}}" onclick="checkRecursoPadre(this)" >{{$recurso->Descripcion}}
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarRol()" type="button" class="btn btn-success">Crear Rol</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection
