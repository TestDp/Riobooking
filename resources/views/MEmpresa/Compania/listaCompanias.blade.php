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
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listCompanias as $Compania)
                            <tr>
                                <th><div style="background-size: cover; background-repeat: no-repeat; background-image: url('{{ $Compania->RutaLogo.$Compania->LogoNegocio}}')"class="logo-negocio"></div></th>
                                <td>{{$Compania->Nombre}}</td>
                                <td>{{$Compania->Direccion}}</td>
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
