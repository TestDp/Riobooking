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
                        <li><h6>Teléfono</h6><a>TeléfonoDelNegocio</a></li>
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
                                <form method="post" action="" id="booking">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nombre o Apodo" name="name_booking" id="name_booking">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Teléfono" name="lastname_booking" id="lastname_booking">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Correo Electrónico" name="email_booking" id="email_booking">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea rows="5" id="booking_message" name="booking_message" class="form-control" style="height:80px;" placeholder="Mensaje adicional"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div style="position:relative;"><input type="submit" class="btn_1 full-width" value="Reservar Cita" id="submit-booking"></div>
                                </form>
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
