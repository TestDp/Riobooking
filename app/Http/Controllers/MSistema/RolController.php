<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 1:33 PM
 */

namespace App\Http\Controllers\MSistema;


use App\Http\Controllers\Controller;
use Org_Saludables\Negocio\Logica\MSistema\RolServicio;
use Org_Saludables\Validaciones\MSistema\RolValidaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller
{
    protected  $rolServicio;
    protected  $rolValidaciones;
    public function __construct(RolServicio $rolServicio, RolValidaciones $rolValidaciones){
        $this->rolServicio = $rolServicio;
        $this->rolValidaciones = $rolValidaciones;
    }

    //Metodo para cargar  la vista de crear un rol
    public function CrearRol(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $recursos = $request->user()->ListaRecursos();
        $view = View::make('MSistema/Rol/crearRol')->with('listRecursos',$recursos);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Rol/crearRol');
    }

       //Metodo para cargar  la vista de editar un rol
     public function EditarRol(Request $request,$idRol)
    {
        $urlinfo = $request->getPathInfo();
        $urlinfo = explode('/'.$idRol,$urlinfo)[0];//se parte la url para quitarle el parametro y porder consultarla NOTA:provicional mientras se encuentra otra forma
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $rol = $this->rolServicio->ObtenerRol($idRol);
        $recursos = $request->user()->ListaRecursos();
        $recursosDelRol = $this->rolServicio->ObtenerListaRecursosDelRol($idRol);
        $view = View::make('MSistema/Rol/editarRol',array('listRecursos'=>$recursos,'rol'=>$rol,'recursosDelRol'=>$recursosDelRol));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Rol/crearRol');
    }

    //Metodo para guarda la informacion del rol
    public  function GuardarRol(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->rolValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $rol = $request->all();
            $idEmpreesa = Auth::user()->Compania_id;
            $rol['Compania_id'] = $idEmpreesa;
            $repuesta = $this->rolServicio->GuardarRol($rol);
            if($repuesta == true){
                $roles = $this->rolServicio->ObtenerListaRoles($idEmpreesa);
                $view = View::make('MSistema/Rol/listaRoles')->with('listRoles',$roles);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('MInventario/Categoria/listaCategorias');
    }

    //Metodo para obtener todos  los roles
    public  function ObtenerRoles(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $roles = $this->rolServicio->ObtenerListaRoles($idEmpreesa);
        $view = View::make('MSistema/Rol/listaRoles')->with('listRoles',$roles);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MSistema/Rol/listaRoles');
    }
}