@extends('layouts.principal')

@section('content')
    <form id="formCompania">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear nuevo negocio</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre del negocio</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Logo</label>
                                <input type="file" class="form-control" name="LogoNegocio" accept=".png,.jpg,.jpeg">
                            </div>
                            <div class="col-md-4">
                                <label>Dirección</label>
                                <input id="Direccion" name="Direccion" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorDireccion"></span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                               <button onclick="GuardarCompania()" type="button" class="btn btn-success">Crear Negocio</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection
