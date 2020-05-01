@extends('layouts.principal')

@section('content')
    <form id="formRegional">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear nueva Sede</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                        
                                <div class="col-md-6">
                                    <label>Regional</label>
                                    <select id="Regional_id" name="Regional_id"  class="form-control"  name="language">
                                        <option value="">Seleccionar</option>
                                       @foreach($listRegionales as $regional)
                                            <option value="{{$regional->id}}">{{$regional->Nombre}}</option>
                                        @endforeach

                                    </select>
                                    <span class="invalid-feedback" role="alert" id="errorRegional_id"></span>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarRegional()" type="button" class="btn btn-success">Crear Sede</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection
