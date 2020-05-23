@extends('layouts.negocios')

@section('content')
    <div class="hero_home version_1">
        <div class="content">
            <h3>Reserva de citas</h3>
            <p>
                Encuentra el servicio que requieres y reserva tu cita.
            </p>
            <form method="post" action="list.html">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class=" search-query" placeholder="Ej. Barbería, centro de servicios ....">
                        <input type="submit" class="btn_search" value="Buscar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Hero -->


    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Reserva tu cita en el negocio que desees</h2>
                <p>Estos son nuestros negocios más destacados</p>
            </div>
            <div class="row">
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
            </div>
            <!-- /row -->
            <p class="text-center add_top_30"><a href="#" class="btn_1 medium">Ver todos los negocios</a></p>
        </div>
        <!-- /container -->
    </div>
    <!-- /white_bg -->

    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Reserva tu <strong>cita</strong> en 3 simples pasos</h2>
            <p>Nunca había sido tan fácil.</p>
        </div>
        <div class="row add_bottom_30">
            <div class="col-lg-4">
                <div class="box_feat" id="icon_1">
                    <span></span>
                    <h3>Encuentra el negocio</h3>
                    <p>Busca el servicio que necesites y el profesional de tu elección</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_2">
                    <span></span>
                    <h3>Visita el perfil</h3>
                    <p>Elije el servicio que deseas y diligencia tu información</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_3">
                    <h3>Reserva tu cita</h3>
                    <p>Selecciona la fecha y la hora de tu cita y haz tu reserva</p>
                </div>
            </div>
        </div>
        <!-- /row -->
        <p class="text-center"><a href="#" class="btn_1 medium">Contáctanos</a></p>

    </div>
    <!-- /container -->

    <!-- /app_section -->
@endsection
