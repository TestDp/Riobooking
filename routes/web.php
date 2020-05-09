<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('auth.login');
});*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {return view('riobooking');});
Route::get('/', 'InicioController@cargarVistaNegocios');

//CONTROLADOR TIPOCITAS
Route::get('crearTipoCita', 'MSistema\TipoCitaController@CrearTipoCita')->name('crearTipoCita');//cargar la vista para crear un tipo de cita
Route::post('guardarTipoCita', 'MSistema\TipoCitaController@GuardarTipoCita')->name('guardarTipoCita');//Guardar la informacion del tipo cita
Route::get('tiposCitas', 'MSistema\TipoCitaController@ObtenerTiposCitas')->name('tiposCitas');//Obtiene la lista de tipos de citas
Route::get('tiposCitasR/{idRegional}', 'MSistema\TipoCitaController@ObtenerTiposCitasR')->name('tiposCitasR');//Obtiene la lista de tipos de citas X Regional


//CONTROLADOR UNIDADDEMEDIDA
Route::get('crearUnidad', 'MSistema\UnidadDeMedidaController@CrearUnidad')->name('crearUnidad');//cargar la vista para crear una unidad
Route::post('guardarUnidad', 'MSistema\UnidadDeMedidaController@GuardarUnidad')->name('guardarUnidad');//Guardar la informacion de la unidad
Route::get('unidades', 'MSistema\UnidadDeMedidaController@ObtenerUnidades')->name('unidades');//Obtiene la lista de tipos de la unidad

//CONTROLADOR ROL
Route::get('crearRol', 'MSistema\RolController@CrearRol')->name('crearRol');//cargar la vista para crear un rol
Route::get('editarRol/{idRol}', 'MSistema\RolController@EditarRol')->name('editarRol');//cargar la vista para editar un rol
Route::post('guardarRol', 'MSistema\RolController@GuardarRol')->name('guardarRol');//Guardar la informacion del rol
Route::get('roles', 'MSistema\RolController@ObtenerRoles')->name('roles');//Obtiene la lista de tipos de roles

//CONTROLADOR USUARIOS
Route::get('crearUsuario', 'MSistema\UsuarioController@CrearUsuarioEmpresa')->name('crearUsuario');//cargar la vista para crear un usuario
Route::post('guardarUsuario', 'MSistema\UsuarioController@GuardarUsuarioEmpresa')->name('guardarUsuario');//Guardar la informacion del usuario
Route::get('usuarios', 'MSistema\UsuarioController@ObtenerUsuarios')->name('usuarios');//Obtiene la lista de usuarios
Route::get('/register/verify/{code}', 'MSistema\UsuarioController@verifarCorreo'); //verificar correo electronico

//CONTROLADOR SEDES
Route::get('crearSede', 'MEmpresa\SedeController@CrearSede')->name('crearSede');//cargar la vista para crear una sede
Route::post('guardarSede', 'MEmpresa\SedeController@GuardarSede')->name('guardarSede');//Guardar la informacion de la sede
Route::get('sedes', 'MEmpresa\SedeController@ObtenerSedes')->name('sedes');//Obtiene la lista de sedes


//CONTROLADOR COMPANIAS
Route::get('crearCompania', 'MEmpresa\CompaniaController@CrearCompania')->name('crearCompania');//cargar la vista para crear una Compania
Route::post('guardarCompania', 'MEmpresa\CompaniaController@GuardarCompania')->name('guardarCompania');//Guardar la informacion de la Compania
Route::get('Companias', 'MEmpresa\CompaniaController@ObtenerCompanias')->name('companias');//Obtiene la lista de Companias


//CONTROLADOR REGIONALES
Route::get('crearRegional', 'MEmpresa\RegionalController@CrearRegional')->name('crearRegional');//cargar la vista para crear una sede
Route::post('guardarRegional', 'MEmpresa\RegionalController@GuardarRegional')->name('guardarRegional');//Guardar la informacion de la sede
Route::get('regionales', 'MEmpresa\RegionalController@ObtenerRegionales')->name('regionales');//Obtiene la lista de sedes



//CONTROLADOR GERENCIAS 
Route::get('crearGerencia', 'MEmpresa\GerenciaController@CrearGerencia')->name('crearGerencia');//cargar la vista para crear una gerencia
Route::post('guardarGerencia', 'MEmpresa\GerenciaController@GuardarGerencia')->name('guardarGerencia');//Guardar la informacion de la gerencia
Route::get('gerencias', 'MEmpresa\GerenciaController@ObtenerGerencias')->name('gerencias');//Obtiene la lista de gerencias 


//CONTROLADOR JORNADAS
Route::get('crearJornada', 'MCitas\JornadaController@CrearJornada')->name('crearJornada');//cargar la vista para crear una jornada
Route::post('guardarJornada', 'MCitas\JornadaController@GuardarJornada')->name('guardarJornada');//Guardar la informacion de la jornada
Route::get('jornadas', 'MCitas\JornadaController@ObtenerJornadas')->name('jornadas');//Obtiene la lista de jornadas
Route::get('miCalendario', 'MCitas\JornadaController@ObtenerMiCalendario')->name('miCalendario');

Route::get('detalleJornada/{idJornada}', 'MCitas\JornadaController@DetalleJornada')->name('detalleJornada');//cargar la vista con el detalle de la jornada
Route::get('exportarJornada/{idJornada}', 'MCitas\JornadaController@ExportarJornada')->name('exportarJornada');//permite descargar la jornada
Route::get('editarJornada/{idJornada}', 'MCitas\JornadaController@EditarJornada')->name('editarJornada');//cargar la vista para editar una jornada

//CONTROLADOR CITAS
Route::get('crearReserva', 'MCitas\CitaController@CrearReserva')->name('crearReserva');//cargar la vista para reservar una cita
Route::get('guardarReserva/{idCita}', 'MCitas\CitaController@GuardarReserva')->name('guardarReserva');//Guardar la informacion de reserva
Route::get('guardarCancelacion/{idCita}', 'MCitas\CitaController@GuardarCancelacion')->name('guardarCancelacion');//guarda la información para cancelar una reserva 
Route::get('guardarBorrado/{idCita}', 'MCitas\CitaController@GuardarBorrado')->name('guardarBorrado');//se elimina una de las citas de la jornada 
Route::get('citas', 'MCitas\CitaController@ObtenerCitas')->name('citas');//Obtiene la lista de citas
Route::get('cancelarReserva', 'MCitas\CitaController@ObtenerCitasUsuario')->name('cancelarReserva');//Obtiene la lista de citas
Route::post('buscarCitas', 'MCitas\CitaController@BuscarCistas')->name('buscarCitas');
//Route::match(array('GET', 'POST'), 'buscarCitas', 'MCitas\CitaController@BuscarCistas')->name('buscarCitas');

//CONTROLADOR CALENDARIO

Route::resource('gcalendar', 'gCalendarController');
Route::get('index', 'gCalendarController@index');
//Route::get('gcalendar', 'gCalendarController@index');
Route::get('gcalendar', ['as' => 'gcalendar', 'uses' => 'gCalendarController@index']);
Route::post('guardarCita', 'gCalendarController@store');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);

//CONTROLADOR AGENDA
Route::get('agenda', 'MCitas\AgendaController@ObtenerAgenda')->name('agenda');

//CONTROLADOR COLABORADOR
Route::get('crearServiciosColaborador', 'MSistema\UsuarioController@CrearServiciosPorColaboradores')->name('crearServiciosColaborador');//cargar la vista para crear un usuario
