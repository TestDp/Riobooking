@extends('layouts.negocios')

@section('content')
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">CategoríaDelNegocio</a></li>
                <li>NombreDelNegocio</li>
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
                            <a class="nav-link active" id="book-tab" data-toggle="tab" href="#servicios" role="tab" aria-controls="servicios">Servicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Colaborador</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book">Disponibilidad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">Reservar cita</a>
                        </li>
                    </ul>
                    <!--/nav-tabs -->

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="servicios" role="tabpanel" aria-labelledby="servicios-tab">
                            <div class="main_title_3">
                                <h3><strong>1</strong>Selecciona el tipo de servicio</h3>
                            </div>
                            <ul class="treatments clearfix">
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox" id="visit1" name="visit1">
                                        <label for="visit1" class="css-label">Corte <strong>$10 k</strong></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
                                        <label for="visit2" class="css-label">Corte y Barba <strong>$15 k</strong></label>
                                    </div>
                                </li>
                            </ul>
                            <p class="text-center"><a href="" class="btn_1 medium">Siguiente</a></p>
                        </div>
                        <div class="tab-pane fade show" id="book" role="tabpanel" aria-labelledby="book-tab">
                            <form>
                                <div class="main_title_3">
                                    <h3><strong>3</strong>Selecciona fecha y hora</h3>
                                </div>
                                <div class="row add_bottom_45">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div id="calendar"></div>
                                            <input type="hidden" id="my_hidden_input">
                                            <ul class="legend">
                                                <li><strong></strong>Disponible</li>
                                                <li><strong></strong>No Disponible</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <ul class="time_select version_2 add_top_20">
                                            <li>
                                                <input type="radio" id="radio1" name="radio_time" value="09.30am">
                                                <label for="radio1">09.30am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio2" name="radio_time" value="10.00am">
                                                <label for="radio2">10.00am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio3" name="radio_time" value="10.30am">
                                                <label for="radio3">10.30am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio4" name="radio_time" value="11.00am">
                                                <label for="radio4">11.00am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio5" name="radio_time" value="11.30am">
                                                <label for="radio5">11.30am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio6" name="radio_time" value="12.00am">
                                                <label for="radio6">12.00am</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio7" name="radio_time" value="01.30pm">
                                                <label for="radio7">01.30pm</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio8" name="radio_time" value="02.00pm">
                                                <label for="radio8">02.00pm</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio9" name="radio_time" value="02.30pm">
                                                <label for="radio9">02.30pm</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio10" name="radio_time" value="03.00pm">
                                                <label for="radio10">03.00pm</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio11" name="radio_time" value="03.30pm">
                                                <label for="radio11">03.30pm</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="radio12" name="radio_time" value="04.00pm">
                                                <label for="radio12">04.00pm</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <p class="text-center"><a href="" class="btn_1 medium">Siguiente</a></p>
                        </div>
                        <!-- /tab_1 -->

                        <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">

                            <div class="box_general_3 booking">
                                <div class="main_title_3">
                                    <h3><strong>4</strong>Reservar cita</h3>
                                </div>
                                <div id="message-booking"></div>
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
                            <!-- /box_general -->

                        </div>
                        <!-- /tab_2 -->

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-container">
                                <div class="main_title_3">
                                    <h3><strong>2</strong>Seleccionar colaborador</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box_list wow fadeIn">
                                            <figure>
                                                <a href=""><img src="http://via.placeholder.com/565x565.jpg" class="img-fluid" alt="">
                                                </a>
                                            </figure>
                                            <div style="text-align:center;" class="wrapper">
                                                <small>NombreNegocio</small>
                                                <h3>NombreColaborador</h3>
                                                <div class="pricing-switcher">
                                                    <p class="fieldset">
                                                        <input type="radio" name="duration-2" value="monthly" id="monthly-2" checked>
                                                        <label for="monthly-2"><i class="icon-cancel"></i></label>
                                                        <input type="radio" name="duration-2" value="yearly" id="yearly-2">
                                                        <label for="yearly-2"><i class="icon-ok"></i></label>
                                                        <span class="switch"></span>
                                                    </p>
                                                </div>
                                           </div>
                                        </div>
                                        <p class="text-center"><a href="" class="btn_1 medium">Siguiente</a></p>
                                    </div>
                                    <!-- /box_list -->

                                </div>
                                <!-- /row -->

                            </div>
                            <!-- End review-container -->
                        </div>
                        <!-- /tab_3 -->
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
