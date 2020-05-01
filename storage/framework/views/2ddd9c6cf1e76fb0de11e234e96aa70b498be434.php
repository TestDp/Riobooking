<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Nutresa | Organizaciones Saludables</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel='stylesheet' type='text/css'/>
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="<?php echo e(asset('css/font-awesome.css')); ?>" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="<?php echo e(asset('js/jquery-1.11.1.min.js')); ?>"></script>

    <script src="<?php echo e(asset('js/modernizr.custom.js')); ?>"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:500,500,500italic,800italic,300,300italic'
          rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
    <!-- Metis Menu -->
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    <!-- sweet plugins-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Prueba autor del build -->
     <link href="<?php echo e(asset('js/Plugins/data-table/datatables.css')); ?>" rel="stylesheet">


</head>
<body class="cbp-spmenu-push" style="overflow: auto;">
    <div class="overflow-auto" style="overflow: auto;"></div>
 <div class="main-content">
    <div class=" sidebar" role="navigation">
        <div class="navbar-collapse">
            <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <ul class="nav" id="side-menu">
                    <?php if(Auth::user()->buscarRecurso('Empresa')): ?>
                        <li>
                            <a href="#ulEmpresa" data-toggle="collapse"><i class="fa fa-table nav_icon"></i>Compañia<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulEmpresa">

                              
                                <?php if(Auth::user()->buscarRecurso('Sedes')): ?>  
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaSedes()" >Regionales</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->buscarRecurso('Usuarios')): ?>
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaUsuarios()">Usuarios</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->buscarRecurso('Roles')): ?>
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaRoles()">Roles</a>
                                    </li>
                                <?php endif; ?>

                                 <?php if(Auth::user()->buscarRecurso('Gerencias')): ?>
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaGerencias()">Gerencias</a>
                                    </li>
                                <?php endif; ?>
            
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->buscarRecurso('Administrador')): ?>
                        <li>
                            <a href="#ulAdministrador" data-toggle="collapse"><i class="fa fa-cogs nav_icon"></i>Administrador<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulAdministrador">

                                   <?php if(Auth::user()->buscarRecurso('Companias')): ?>  
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaCompanias()" >Compañias</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->buscarRecurso('TiposDeCitas')): ?>
                                    <li>
                                        <a href="#" onclick="ajaxRenderSectionListaTiposCitas()" >Tipos de Citas</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li> 
                <?php endif; ?>
                 <?php if(Auth::user()->buscarRecurso('Citas')): ?>
                        <li>
                            <a href="#ulCitas" data-toggle="collapse"><i class="fa fa-calendar nav_icon"></i>Citas<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="ulCitas">

                                   <?php if(Auth::user()->buscarRecurso('Jornadas')): ?>  
                                    <li>
                                         <a href="#" onclick="ajaxRenderSectionListaJornadas()" >Jornadas</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->buscarRecurso('Citas')): ?>
                                   <li>
                                       <a href= "<?php echo e(url('/citas')); ?>">Solicitar Citas</a>
                                    </li>
                                <?php endif; ?>
                                    <?php if(Auth::user()->buscarRecurso('cancelarReserva')): ?>
                                    <li>                                        
                                       <a href= "<?php echo e(url('/cancelarReserva')); ?>">Mis Citas</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li> 
                <?php endif; ?>

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
                <a href="<?php echo e(url('/welcome')); ?>">
                    <img src="<?php echo e(asset('images/Logo-home.png')); ?>"></img>
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
                                    <p><?php echo e(Auth::user()->name); ?> </p>
                                    <span>Bienvenido</span>
                                </div>
                                <i class="fa fa-angle-down lnr"></i>
                                <i class="fa fa-angle-up lnr"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i> Logout</a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                      style="display: none;">
                                    <?php echo csrf_field(); ?>
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
                <img class="img_loading" src="<?php echo e(asset('images/loader.gif')); ?>" /><br>
            </div>
            <div id="principalPanel">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div class="footer">
    <p>Org Saludables | Grupo Nutresa- Equipo de desarrollo Servicios Nutresa
    </p>
</div>
<!--//footer-->
</div>
<!-- Classie -->
<script src="<?php echo e(asset('js/classie.js')); ?>"></script>
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

<script src="<?php echo e(asset('js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
<!--//scrolling js-->

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>

<!-- js de la apliacion-->
<script src="<?php echo e(asset('js/MSistema/TipoCita.js')); ?>"></script>
<script src="<?php echo e(asset('js/MSistema/Rol.js')); ?>"></script>
<script src="<?php echo e(asset('js/MEmpresa/Regional.js')); ?>"></script>
<script src="<?php echo e(asset('js/MSistema/Usuario.js')); ?>"></script>
<script src="<?php echo e(asset('js/MEmpresa/Sede.js')); ?>"></script>
<script src="<?php echo e(asset('js/MEmpresa/Compania.js')); ?>"></script>
<script src="<?php echo e(asset('js/MEmpresa/Gerencia.js')); ?>"></script>
<script src="<?php echo e(asset('js/Transversal/generales.js')); ?>"></script>
<script src="<?php echo e(asset('js/Citas/Jornada.js')); ?>"></script>
<script src="<?php echo e(asset('js/Citas/Cita.js')); ?>"></script>
<script src="<?php echo e(asset('js/Plugins/data-table/datatables.js')); ?>"></script>

</body>
</html>
