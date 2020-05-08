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
    <link rel="shortcut icon" href="welcome/img/favicon.png" type="image/x-icon">

    <!-- BASE CSS -->
    <link href="welcome/css/bootstrap.min.css" rel="stylesheet">
    <link href="welcome/css/style.css" rel="stylesheet">
    <link href="welcome/css/menu.css" rel="stylesheet">
    <link href="welcome/css/vendors.css" rel="stylesheet">
    <link href="welcome/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="welcome/css/custom.css" rel="stylesheet">

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
                    <h1><a href="index.html" title="Findoctor"></a></h1>
                </div>
            </div>
            <nav class="col-lg-9 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                <ul id="top_access">
                    <li><a href="{{ route('login') }}"><i class="pe-7s-user"></i></a></li>
                    <li><a href="{{ route('register') }}"><i class="pe-7s-add-user"></i></a></li>
                </ul>
                <div class="main-menu">
                    <ul>
                        <li class="submenu">
                            <a href="#0" class="show-submenu">Inicio<i class="icon-down-open-mini"></i></a>
                        </li>
                        <li class="submenu">
                            <a href="#0" class="show-submenu">Categorías<i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="">Cuidado personal</a></li>
                                <li><a href="">Centro de servicios</a></li>
                                <li><a href="">Soporte técnico</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
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
                        <li><a href="#0">Contáctanos</a></li>
                    </ul>
                </div>
                <!-- /main-menu -->
            </nav>
        </div>
    </div>
    <!-- /container -->
</header>
<!-- /header -->

<main>
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
                <div class="col-lg-4 col-md-6">
                    <div class="box_list home">
                        <figure>
                            <a href="detail-page.html"><img src="http://via.placeholder.com/565x565.jpg" class="img-fluid" alt=""></a>
                            <div class="preview"><span>Reservar cita</span></div>
                        </figure>
                        <div class="wrapper">
                            <small>Rionegro</small>
                            <h3>Og´s Barbery Studio</h3>
                            <p>Sector Las Torres</p>
                            <ul>
                                <li><a href="">Reservar cita</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
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
<script src="welcome/js/jquery-2.2.4.min.js"></script>
<script src="welcome/js/common_scripts.min.js"></script>
<script src="welcome/js/functions.js"></script>

</body>

</html>