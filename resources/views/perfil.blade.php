@extends('layouts.negocios')

@section('content')
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>{{$Compania->Nombre}}</li>
            </ul>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="container margin_60">
        <div class="row">

            <aside class="col-xl-3 col-lg-4" id="sidebar">
                <div class="box_profile">
                    <figure>
                        <img src="{{ $Compania->RutaLogo.$Compania->LogoNegocio}}" alt="" class="img-fluid">
                    </figure>
                    <small>CategoríaDelNegocio</small>
                    <h1>{{$Compania->Nombre}}</h1>
                    <ul class="contacts">
                        <li><h6>Dirección</h6>{{$Compania->Direccion}}</li>
                    </ul>
                    <!--<div class="text-center"><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div>-->
                </div>
            </aside>
            <!-- /asdide -->

            <div class="col-xl-9 col-lg-8">

                <div class="tabs_styled_2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="book-tab" data-toggle="tab" href="#servicios" role="tab" aria-controls="servicios">Diligencia la siguiente información para reservar tu cita</a>
                        </li>
                    </ul>
                    <!--/nav-tabs -->

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="servicios" role="tabpanel" aria-labelledby="servicios-tab">
                            <div class="main_title_3">
                                <h3><strong>1</strong>Selecciona el tipo de servicio</h3>
                            </div>
                            <ul class="treatments clearfix">
                                @foreach($tiposCitas as $tipoCita)
                                    <li>
                                        <div class="checkbox">
                                            <input onclick="renderSectionCargarVPColaboradores({{$tipoCita->id}})" type="checkbox" class="css-checkbox" id="tipoServicio{{$tipoCita->id}}" name="tipoServicio{{$tipoCita->id}}">
                                            <label for="tipoServicio{{$tipoCita->id}}" class="css-label">{{$tipoCita->Nombre}} <strong>$10 k</strong></label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="reviews-container">
                                <div class="main_title_3">
                                    <h3><strong>2</strong>Seleccionar colaborador</h3>
                                </div>
                                <div id="divColaborador" class="row" style="display: none;">



                                </div>
                                <!-- /row -->

                            </div>

                            <div class="main_title_3">
                                <h3><strong>3</strong>Selecciona fecha y hora</h3>
                            </div>
                            <div id="divDisponibilidad" style="display: none;">


                            </div>
                            <div class="reviews-container">
                                <div class="main_title_3">
                                    <h3><strong>4</strong>Reservar cita</h3>
                                </div>
                                <div id="divReservar" style="display:none">
                                        @guest
                                                    <div id="login-2">
                                                        <form id="formLogin">
                                                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                                            <div style="padding: 3% !important;" class="box_form clearfix">
                                                                <h6 style="text-align: center;">Inicia Sesión en RioBooking</h6>
                                                                <div class="box_login last">
                                                                    <div class="form-group">
                                                                        <input placeholder="Cédula ó Nombre de Usuario" id="login”" type="login" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                                                        @if ($errors->has('login'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('login') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input placeholder="Contraseña" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                                        @if ($errors->has('password'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                        <a href="{{ route('password.request') }}" class="forgot"><small>Olvidaste tu contraseña?</small></a>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <a class="btn_1" style="cursor: pointer; color:#fff;" onclick="iniciarSesion()" value="Iniciar Sesión">Iniciar Sesión</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <button style="background: #3f4079 !important;" class="btn_1"><a onclick="renderSectionCargarVPRegistrarUsuario()"><strong>¿No tienes cuenta? ¡Registrate aquí!</strong></a></button>
                                                    </div>
                                                    <!-- /login -->
                                        @else
                                        <form id="formSolicitarResevar">
                                        <input type="hidden" id="TurnoPorColaborador_id" name="TurnoPorColaborador_id" value="1">
                                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <textarea rows="5" id="Comentario1" name="Comentario1" class="form-control" style="height:80px;" placeholder="Mensaje adicional"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div style="position:relative;">
                                                <input type="button" class="btn_1 full-width" value="Reservar Cita" onclick="guardarReservaUsuario()">
                                            </div>
                                        </form>
                                        @endguest

                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /tab-content -->
                </div>
                <!-- /tabs_styled -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

@endsection
