@extends('layouts.negocios')

@section('content')
    @foreach($listCompanias as $Compania)
        <div class="col-lg-4 col-md-6">
            <div class="box_list home">
                <figure>
                    <a href="{{url('perfilNegocio', ['idCompania' => $Compania->id ])}}"><img src="{{ $Compania->RutaLogo.$Compania->LogoNegocio}}" class="img-fluid" alt=""></a>
                </figure>
                <div class="wrapper">
                    <small>Rionegro</small>
                    <h3>{{$Compania->Nombre}}</h3>
                    <p>{{$Compania->Direccion}}</p>
                    <ul>
                        <li><a href="{{url('perfilNegocio', ['idCompania' => $Compania->id ])}}">Reservar cita</a></li>
                    </ul>
                </div>

            </div>
        </div>
    @endforeach

@endsection
