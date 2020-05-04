@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Negocios</h3></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Activa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listCompanias as $Compania)
                            <tr>
                                <th scope="row">{{$Compania->id}}</th>
                                <td >{{$Compania->Nombre}}</td>
                                <td>{{$Compania->Activa}}</td>
                             
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearCompania()" type="button" class="btn btn-success">Nuevo Negocio</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
