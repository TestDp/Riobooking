<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:28 PM
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
use Org_Saludables\Validaciones\MSistema\UsuarioValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends  Controller
{

    protected $usuarioServicio;
    protected $sedeServicio;
    protected $rolServicio;
    protected $usuarioValidaciones;
    public $iCompaniaServicio;
    public $colaboradorServicio;

    public function __construct(UsuarioServicio $usuarioServicio, SedeServicio $sedeServicio, RolServicio $rolServicio,
                                UsuarioValidaciones $usuarioValidaciones, ICompaniaServicio $iCompaniaServicio,
                                ColaboradorServicio $colaboradorServicio){
        $this->usuarioServicio = $usuarioServicio;
        $this->sedeServicio = $sedeServicio;
        $this->rolServicio = $rolServicio;
        $this->usuarioValidaciones = $usuarioValidaciones;
        $this->iCompaniaServicio = $iCompaniaServicio;
        $this->colaboradorServicio = $colaboradorServicio;
    }

    //Metodo para cargar  la vista de crear un rol
    public function CrearUsuarioEmpresa(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $roles = $this->rolServicio->ObtenerListaRoles($idEmpreesa);
        $arrayCompaniasDTO = $this->iCompaniaServicio->ObtenerListaCompanias();
        //$sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MSistema/Usuario/crearUsuario',
            array('listRoles'=>$roles,'listCompanias'=> $arrayCompaniasDTO));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Usuario/crearUsuario');
    }

    //Metodo para crear un usuario desde el perfil de una empresa
    public function GuardarUsuarioEmpresa(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->usuarioValidaciones->ValidarFormularioCrear($request->all())->validate();
        DB::beginTransaction();
        try 
        {

            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->Compania_id=$request['Sede_id'];
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
        $idEmpreesa = Auth::user()->Compania_id;
        $idUsuario = Auth::user()->id;
        $usuarios = $this->usuarioServicio->ObtenerListaUsuarios($idEmpreesa,$idUsuario);
        $view = View::make('MSistema/Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Usuario/listaUsuarios');
    }

    //Metodo para obtener todos  los usuarios por empresa
    public  function ObtenerUsuarios(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $idUsuario = Auth::user()->id;
        $usuarios = null;
        if($request->user()->hasRole(env('IdRolSuperAdmin')))
        {
            $usuarios = $this->usuarioServicio->ObtenerTodosLosUsuarios($idUsuario);
        }else{
            $usuarios = $this->usuarioServicio->ObtenerListaUsuarios($idEmpreesa,$idUsuario);
        }
        $view = View::make('MSistema/Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Usuario/listaUsuarios');
    }

    //Funcion para verificar el correo del usuario registrado
    public function verifarCorreo($code)
    {
        $user = User::where('CodigoConfirmacion', $code)->first();
        if (! $user)
            return redirect('/');
        $user->CorreoConfirmado = true;
        $user->CodigoConfirmacion = null;
        $user->save();
        return redirect('/home')->with('notification', 'Has confirmado correctamente tu correo!');
    }
}