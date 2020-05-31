<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find easily a doctor and book online an appointment">
    <meta name="author" content="Ansonika">
    <title>RioBooking | Reserva de citas</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('welcome/img/favicon.png') }}" type="image/x-icon">

    <!-- BASE CSS -->
    <link href="{{ asset('welcome/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome/css/vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('welcome/css/icon_fonts/css/all_icons_min.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('welcome/css/custom.css') }}" rel="stylesheet">
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('welcome/css/tables.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('welcome/css/date_picker.css') }}" rel="stylesheet">
    <!-- Modernizr -->
    <script src="{{ asset('welcome/js/modernizr_tables.js') }}"></script>

    <!-- sweet plugins-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<div id="preloader">
    <div data-loader="circle-side"></div>
</div>
<!-- End Preload -->

<header class="header_sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div id="logo_home">
                    <h1><a href="{{ url('/') }}"></a></h1>
                </div>
            </div>
            @if (Route::has('login'))
            <nav class="col-lg-9 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                @auth
                    <ul id="top_access">
                        <li class="submenu"><a class="show-submenu" href="{{ route('home') }}"><i class="pe-7s-user"></i></a></li>
                    </ul>
                @else
                <ul id="top_access">
                    <li><a href="{{ route('login') }}"><i class="pe-7s-user"></i></a></li>
                    <li><a href="{{ route('register') }}"><i class="pe-7s-add-user"></i></a></li>
                </ul>
                @endauth
                <div class="main-menu">
                    <ul>
                        <li class="submenu">
                            <a href="{{ url('/') }}" class="show-submenu">Inicio</a>
                        </li>
                        <li style="display: none;" class="submenu">
                            <a href="#0" class="show-submenu">Categorías<i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="">Cuidado personal</a></li>
                                <li><a href="">Centro de servicios</a></li>
                                <li><a href="">Soporte técnico</a></li>
                            </ul>
                        </li>
                        <li style="display: none;" class="submenu">
                            <a href="#0" class="show-submenu">Ciudades<i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="">Rionegro</a></li>
                                <li><a href="">La Ceja</a></li>
                                <li><a href="">Marinilla</a></li>
                                <li><a href="">El Carmen de Víboral</a></li>
                                <li><a href="">Guarne</a></li>
                                <li><a href="">El Retiro</a></li>
                                <li><a href="">Medellín</a></li>
                                <li><a href="">Envigado</a></li>
                            </ul>
                        </li>
                        <li><a href="https://dpsoluciones.co/contactanos/" target="_blank">Contáctanos</a></li>
                    </ul>
                </div>
                <!-- /main-menu -->
            </nav>
            @endif
        </div>
    </div>
    <!-- /container -->
</header>
<!-- /header -->

<main>
    @yield('content')
</main>
<!-- /main content -->

<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <p>
                    <a href="index.html" title="Findoctor">
                        <img src="images/logo-blanco.png" data-retina="true" alt="" width="163" height="36" class="img-fluid">
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>RioBooking</h5>
                <ul class="links">
                    <li><a href="#0">Acerca de nosotros</a></li>
                    <li><a href="#0">Preguntas frecuentes</a></li>
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Categorías</h5>
                <ul class="links">
                    <li><a href="#0">Cuidado personal</a></li>
                    <li><a href="#0">Centros de servicio</a></li>
                    <li><a href="#0">Soporte técnico</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Contáctanos</h5>
                <ul class="contacts">
                    <li><a href=""><i class="icon_mobile"></i> + 57 312 342 21 20</a></li>
                    <li><a href=""><i class="icon_mail_alt"></i> contacto@riobooking.co</a></li>
                </ul>
                <div class="follow_us">
                    <h5>Síguenos</h5>
                    <ul>
                        <li><a href="#0"><i class="social_facebook"></i></a></li>
                        <li><a href="#0"><i class="social_instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/row-->
        <hr>
        <div class="row">
            <div class="col-md-8">
                <ul id="additional_links">
                    <li><a href="#0">Términos y condiciones</a></li>
                    <li><a href="#0">Política de datos</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <div id="copy">© Desarrollado por DPSoluciones</div>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->

<div id="toTop"></div>
<!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="{{ asset('welcome/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('welcome/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('welcome/js/functions.js') }}"></script>
<script src="{{ asset('js/MEmpresa/Compania.js') }}"></script>
<script src="{{ asset('js/Transversal/generales.js') }}"></script>
<script src="{{ asset('js/InicioRioBooking.js') }}"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('welcome/js/bootstrap-datepicker.js') }}"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('welcome/js/tables_func.js') }}"></script>


</body>

</html>