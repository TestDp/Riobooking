<?php
/**
 * Created by PhpStorm.
 * User: DPS-J
 * Date: 9/05/2020
 * Time: 11:34 AM
 */

namespace App\Http\Controllers\MSistema;
use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MCitas\ColaboradorDTO;
use App\Org_Saludables\Negocio\Logica\MCitas\ColaboradorServicio;
use App\User;
use Org_Saludables\Datos\Modelos\MSistema\Rol_Por_Usuario;
use Org_Saludables\Negocio\Logica\MEmpresa\SedeServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use Org_Saludables\Negocio\Logica\MSistema\RolServicio;
use Org_Saludables\Negocio\Logica\MSistema\UsuarioServicio;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;
use Org_Saludables\Validaciones\MSistema\UsuarioValidaciones;
use Org_Saludables\Validaciones\MSistema\ServiciosColaboradorValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ColaboradorController extends  Controller
{

    protected $usuarioServicio;
    protected $sedeServicio;
    protected $rolServicio;
    protected $usuarioValidaciones;
    protected $serviciosColaboradorValidaciones;
    public $iCompaniaServicio;
    public $colaboradorServicio;

    public function __construct(UsuarioServicio $usuarioServicio, SedeServicio $sedeServicio, RolServicio $rolServicio,
                                ServiciosColaboradorValidaciones $serviciosColaboradorValidaciones,
                                UsuarioValidaciones $usuarioValidaciones, ICompaniaServicio $iCompaniaServicio,
                                ColaboradorServicio $colaboradorServicio, TipoCitaServicio $tipoCitaServicio){
        $this->usuarioServicio = $usuarioServicio;
        $this->sedeServicio = $sedeServicio;
        $this->rolServicio = $rolServicio;
        $this->usuarioValidaciones = $usuarioValidaciones;
        $this->serviciosColaboradorValidaciones = $serviciosColaboradorValidaciones;
        $this->iCompaniaServicio = $iCompaniaServicio;
        $this->colaboradorServicio = $colaboradorServicio;
        $this->tipoCitaServicio = $tipoCitaServicio;
    }

    //Metodo para cargar  la vista de crear un rol
    public function CrearColaboradorEmpresa(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idSede = Auth::user()->Sede_id;
        $roles = $this->rolServicio->ObtenerListaRoles($idSede);
        $arrayCompaniasDTO = $this->iCompaniaServicio->ObtenerListaCompanias();
        //$sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MSistema/Usuario/crearColaborador',
            array('listRoles'=>$roles,'listCompanias'=> $arrayCompaniasDTO));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Usuario/crearColaborador');
    }

    //Metodo para crear un colaborador desde el perfil de una empresa
    public function GuardarColaboradorEmpresa(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->usuarioValidaciones->ValidarFormularioCrear($request->all())->validate();
        DB::beginTransaction();
        try
        {

            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->Sede_id=$request['Sede_id'];
            $user->save();
            $nombreFotoColaborador = "Foto_Colaborador".$user->name.'_'.$user->last_name.'.jpg';
            $colaborador = new ColaboradorDTO();
            $colaborador->user_id = $user->id;
            $colaborador->Nombre = $user->name.' '.$user->last_name;
            $colaborador->Nickname =  $user->username;
            $colaborador->Activo = 1;
            $colaborador->telefono = $user->telefono;
            $colaborador->ImagenColaborador = $nombreFotoColaborador;
            $colaborador->Calificacion = 1;
            $respuesta = $this->colaboradorServicio->GuardarColaborador($colaborador);
            foreach ($request->Roles_id as $rolid){
                $rolPorUsuario = new Rol_Por_Usuario();
                $rolPorUsuario->Rol_id = $rolid;
                $rolPorUsuario->user_id = $user->id;
                $rolPorUsuario->save();
            }
            DB::commit();
            if($respuesta == true){
                if($request->hasFile('imgColaborador')){
                    $file = $request->file('imgColaborador');
                    $nombre = $nombreFotoColaborador;
                    $file->move('FotosColaboradores', $nombre);
                }
            }else{
                DB::rollback();
                return ['respuesta' => false, 'error' => "No fue posible guardar el colaborador"];
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
        $idSede = Auth::user()->Sede_id;
        $idUsuario = Auth::user()->id;
        $usuarios = $this->usuarioServicio->ObtenerListaUsuarios($idSede,$idUsuario);
        $view = View::make('MSistema/Colaborador/listaColaboradores')->with('listColaboradores',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/listaColaboradores');
    }

    //Metodo para obtener todos  los usuarios por empresa
    public  function ObtenerColaboradores(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idSede = Auth::user()->Sede_id;
        $idUsuario = Auth::user()->id;
        $usuarios = null;
        if($request->user()->hasRole(env('IdRolSuperAdmin')))
        {
            $usuarios = $this->colaboradorServicio->ObtenerTodosLosColaboradores($idUsuario);
        }else{
            $usuarios = $this->colaboradorServicio->ObtenerListaColaboradores($idSede,$idUsuario);
        }
        $view = View::make('MSistema/Colaborador/listaColaboradores')->with('listColaboradores',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/listaColaboradores');
    }

    //Metodo para obtener todos  los usuarios por empresa
    public  function ObtenerServiciosPorColaborador(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idSede = Auth::user()->Sede_id;
        $idUsuario = Auth::user()->id;
        $usuarios = null;
        if($request->user()->hasRole(env('IdRolSuperAdmin')))
        {
            $serviciosColaboradores = $this->colaboradorServicio->ObtenerTodosLosServiciosPorColaborador($idUsuario);
        }else{
            $serviciosColaboradores = $this->colaboradorServicio->ObtenerListaServiciosPorColaborador($idSede);
        }
        $view = View::make('MSistema/Colaborador/listaServiciosColaborador')->with('listServiciosPorColaboradores',$serviciosColaboradores);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/listaServiciosColaborador');
    }

    //Metodo para cargar  la vista de crear la relacion entre colaboradores y servicios
    public function CrearServiciosPorColaboradores(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idSede = Auth::user()->Sede_id;
        $tipoServicios = $this->tipoCitaServicio->ObtenerListaTipoCitas($idSede);
        $arrayColaboradores = $this->colaboradorServicio->ObtenerListaColaboradores($idSede);
        $view = View::make('MSistema/Colaborador/crearServiciosColaborador',
            array('listServicios'=>$tipoServicios,'listColaboradores'=> $arrayColaboradores));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Colaborador/crearServiciosColaborador');


    }
    public function GuardarServiciosPorColaboradores(Request $request)
    {
        $urlinfo = $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->serviciosColaboradorValidaciones->ValidarFormularioCrear($request->all())->validate();
        if ($request->ajax()) {
            $idSede = Auth::user()->Sede_id;
            $repuesta = $this->colaboradorServicio->GuardarServiciosPorColaboradores($request);
            if ($repuesta == true) {
                $serviciosColaboradores = $this->colaboradorServicio->ObtenerListaServiciosPorColaborador($idSede);
                $view = View::make('MSistema/Colaborador/listaServiciosColaborador')->with('listServiciosPorColaboradores', $serviciosColaboradores);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' => 200, 'data' => $sections['content']]);
            } else {
                return Response::json(['codeStatus' => 500, 'data' => '']);
            }
        } else return view('MSistema/Colaborador/listaServiciosColaborador');

    }
}