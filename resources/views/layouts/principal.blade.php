<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RioBooking | Reserva de citas</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css'/>
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>

    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <!--//webfonts-->
    <!--animate-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Metis Menu -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('images/favicon.png') }}}">
    <!-- sweet plugins-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Prueba autor del build -->
     <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">


</head>
<body class="cbp-spmenu-push" style="overflow: auto;">
    <div class="overflow-auto" style="overflow: auto;"></div>
 <div class="main-content">
    <div class=" sidebar" role="navigation">
        <div class="navbar-collapse">
            <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <ul class="nav" id="side-menu">
                    @if(Auth::user()->buscarRecurso('Empresa'))
                        <li>
                            <a href="#ulEmpresa" data-toggle="collapse"><i class="fa fa-table nav_icon"></i>Negocio<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulEmpresa">

                              
                                @if(Auth::user()->buscarRecurso('Sedes'))  
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaSedes()" >Regionales</a>
                                    </li>
                                @endif
                                @if(Auth::user()->buscarRecurso('Usuarios'))
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaUsuarios()">Usuarios</a>
                                    </li>
                                @endif
                                    @if(Auth::user()->buscarRecurso('Colaboradores'))
                                        <li>
                                            <a href="#" onclick="ajaxRenderSectionListaColaboradores()">Colaboradores</a>
                                        </li>
                                    @endif
                                @if(Auth::user()->buscarRecurso('Roles'))
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaRoles()">Roles</a>
                                    </li>
                                @endif

                                 @if(Auth::user()->buscarRecurso('Gerencias'))
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaGerencias()">Gerencias</a>
                                    </li>
                                @endif
            
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->buscarRecurso('Administrador'))
                        <li>
                            <a href="#ulAdministrador" data-toggle="collapse"><i class="fa fa-cogs nav_icon"></i>Administrador<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulAdministrador">

                                   @if(Auth::user()->buscarRecurso('Companias'))  
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaCompanias()" >Mis Negocios</a>
                                    </li>
                                @endif
                                @if(Auth::user()->buscarRecurso('TiposDeCitas'))
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaTiposCitas()" >Tipos de Citas</a>
                                    </li>
                                @endif
                                       @if(Auth::user()->buscarRecurso('ServiciosXColaborador'))
                                           <li>
                                               <a href="#" onclick="ajaxRenderSectionServiciosColaborador()" >Asignacion Servicios</a>
                                           </li>
                                       @endif

                            </ul>
                        </li> 
                @endif
                 @if(Auth::user()->buscarRecurso('Citas'))
                        <li>
                            <a href="#ulCitas" data-toggle="collapse"><i class="fa fa-calendar nav_icon"></i>Citas<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulCitas">

                                @if(Auth::user()->buscarRecurso('Jornadas'))
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaJornadas()" >Jornadas</a>
                                    </li>
                                @endif
                                @if(Auth::user()->buscarRecurso('Citas'))
                                   <li>
                                       <a href= "{{url('/citas')}}">Solicitar Citas</a>
                                    </li>
                                @endif
                                @if(Auth::user()->buscarRecurso('cancelarReserva'))
                                    <li>                                        
                                       <a href= "{{url('/cancelarReserva')}}">Mis Citas</a>
                                    </li>
                                @endif
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionMiCalendario()" >Mi Calendario</a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionMiAgenda()" >Mi Agenda</a>
                                    </li>
                            </ul>
                        </li> 
                @endif

                </ul>

            </nav>
        </div>
    </div>
    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <div class="sticky-header header-section ">
        <div class="header-left">
            <!--toggle button start-->
            <button id="showLeftPush"><i class="fa fa-bars"></i></button>
            <!--toggle button end-->
            <!--logo -->
            <div class="logo">
                <a href="{{ url('/welcome') }}">
                    <img src="{{ asset('images/Logo-home.png') }}"></img>
                </a>
            </div>
            <!--//logo-->

            <div class="clearfix"></div>
        </div>
        <div class="header-right">

            <div class="profile_details">
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <div class="profile_img">
                                <span class="prfil-img"><img src="images/a.png" alt=""> </span>
                                <div class="user-name">
                                    <p>{{ Auth::user()->name }} </p>
                                    <span>Bienvenido</span>
                                </div>
                                <i class="fa fa-angle-down lnr"></i>
                                <i class="fa fa-angle-up lnr"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="#"><i class="fa fa-cog"></i> Opciones</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i> Cerrar sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="page-wrapper">
        <div class="main-page">

            <div id="_loading" class="_loading" style="display:none;">
                <div id="capa_loading" class="capa_loading" style="display:none;">Procesando...</div>
                <img class="img_loading" src="{{ asset('images/loader.gif') }}" /><br>
            </div>
            <div id="principalPanel">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div class="footer">
    <p>RioBooking | Reserva de citas | Desarrollado por DPSoluciones
    </p>
</div>
<!--//footer-->
</div>
<!-- Classie -->
<script src="{{ asset('js/classie.js') }}"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };


    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<!--scrolling js-->

<script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<!--//scrolling js-->

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

<!-- js de la apliacion-->
<script src="{{ asset('js/MSistema/TipoCita.js') }}"></script>
<script src="{{ asset('js/MSistema/Rol.js') }}"></script>
<script src="{{ asset('js/MEmpresa/Regional.js') }}"></script>
<script src="{{ asset('js/MSistema/Usuario.js') }}"></script>
<script src="{{ asset('js/MEmpresa/Sede.js') }}"></script>
<script src="{{ asset('js/MEmpresa/Compania.js') }}"></script>
<script src="{{ asset('js/MEmpresa/Gerencia.js') }}"></script>
<script src="{{ asset('js/Transversal/generales.js') }}"></script>
<script src="{{ asset('js/Citas/Jornada.js') }}"></script>
<script src="{{ asset('js/Citas/Cita.js') }}"></script>
<script src="{{ asset('js/Citas/Agenda.js') }}"></script>
<script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>

</body>
</html>
