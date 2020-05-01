@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Sedes</h3></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Regional</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listSedes as $Sede)
                            <tr>
                               <th scope="row">{{$Sede->id}}</th>
                                <td>{{$Sede->Nombre}}</td>
                                <td>{{$Sede->NombreRegional}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearRegional()" type="button" class="btn btn-success">Nueva Sede</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
