<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */
namespace App\Http\Controllers\MCitas;


use App\Http\Controllers\Controller;
use App\Org_Saludables\Negocio\DTO\MCitas\CitaDTO;
use App\Org_Saludables\Negocio\DTO\MCitas\JornadaDTO;
use App\Org_Saludables\Negocio\Logica\MCitas\ColaboradorServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\IJornadaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\JornadaServicio;
use Org_Saludables\Validaciones\MCitas\JornadaValidaciones;
use Org_Saludables\Negocio\Logica\MSistema\TipoCitaServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;




class JornadaController extends Controller
{
    protected  $jornadaServicio;
    protected  $jornadaValidaciones;
    protected  $sedeServicio;
    protected  $TipoCitaServicio;
    protected  $colaboradorServicio;


    public function __construct(IJornadaServicio $jornadaServicio,JornadaValidaciones $jornadaValidaciones,
                                ISedeServicio $sedeServicio,TipoCitaServicio $TipoCitaServicio,
                                ColaboradorServicio $colaboradorServicio){
        $this->jornadaServicio =  $jornadaServicio;
        $this->jornadaValidaciones = $jornadaValidaciones;
        $this->sedeServicio = $sedeServicio;
        $this->TipoCitaServicio = $TipoCitaServicio;
        $this->colaboradorServicio = $colaboradorServicio;
    }

    //Metodo para cargar  la vista de crear Compania
    public function CrearJornada(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
         $idEmpreesa = Auth::user()->Compania_id;
         $regionales = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
         $colaboradores = $this->colaboradorServicio->ObtenerListaColaboradores($idEmpreesa);
         $view = View::make('Citas/crearJornada')->with('listRegionales',$regionales)
             ->with('listColaboradores',$colaboradores);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Citas/crearJornada');
    }

    //Metodo para guardar la compania
    public  function GuardarJornada(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->jornadaValidaciones->ValidarFormularioCrear($request->all())->validate();
        if($request->ajax()){
            $idEmpreesa = Auth::user()->Compania_id;
            $jornada = new JornadaDTO($request->all());
            $repuesta = $this->jornadaServicio->GuardarJornada($jornada, $request);
            if($repuesta == true){
                $jornadas = $this->jornadaServicio->ObtenerListaJornadas($idEmpreesa);
                $view = View::make('Citas/listaJornadas')->with('listJornadas',$jornadas);
                $sections = $view->renderSections();
                return Response::json(['codeStatus' =>200,'data'=>$sections['content']]);
            }
            else{
                return Response::json(['codeStatus' =>500,'data'=>'']);
            }
        }else return view('Citas/listaJornadas');
    }

    //Metodo para obtener toda  la lista de compañias
    public  function ObtenerJornadas(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Compania_id;
        $jornadas = $this->jornadaServicio->ObtenerListaJornadas($idEmpreesa);
        $view = View::make('Citas/listaJornadas')->with('listJornadas',$jornadas);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Citas/listaJornadas');

    }

      public function DetalleJornada(Request $request,$idJornada)
    {
        $urlinfo = $request->getPathInfo();
        $urlinfo = explode('/'.$idJornada,$urlinfo)[0];//se parte la url para quitarle el parametro y porder consultarla NOTA:provicional mientras se encuentra otra forma
        $request->user()->AutorizarUrlRecurso($urlinfo);
         $idEmpreesa = Auth::user()->Compania_id;
        $jornada = $this->jornadaServicio->ObtenerJornada($idEmpreesa, $idJornada);
      
        $view = View::make('Citas/detalleJornada')->with('jornada',$jornada);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Citas/detalleJornada');
    }

    public function ExportarJornada(Request $request, $idJornada)
    {

         $urlinfo = $request->getPathInfo();
        $urlinfo = explode('/'.$idJornada,$urlinfo)[0];//se parte la url para quitarle el parametro y porder consultarla NOTA:provicional mientras se encuentra otra forma
        $request->user()->AutorizarUrlRecurso($urlinfo);

         //$idEmpreesa = Auth::user()->Compania_id;
        //$jornada = $this->jornadaServicio->ObtenerJornada($idEmpreesa, $idJornada);
      
         //Excel::create('Jornada', function ($excel) use ($idJornada) {
            
            /** La hoja se llamará Usuarios */
           // $excel->sheet('Jornada', function ($sheet) use ($idJornada) {
                /** El método loadView nos carga la vista blade a utilizar */
                         $idEmpreesa = Auth::user()->Compania_id;
                      //$jornadaData= array();
                      $jornadaData = $this->jornadaServicio->ObtenerJornada($idEmpreesa, $idJornada);
                       $jornadaData ->toArray();
                       $jornada_array[] = array('Fecha','Inicio','Fin','NombreCita','EstadoReserva','Cedula','Nombre','Email','Telefono','Lugar');

                      $data=[];
                      foreach ($jornadaData as $jornada){
                         $jornada_array[] = array(
                        'Fecha'  => $jornada->Fecha,
                       'Inicio' => $jornada->Inicio,
                        'Fin' => $jornada->Fin,
                        'NombreCita'=>$jornada->NombreCita,
                        'EstadoReserva' =>$jornada->EstadoReserva,
                         'Cedula' => $jornada->cedula,
                        'Nombre' => $jornada->Nombre.' '.$jornada->Apellidos,
                        'Email' => $jornada->email,
                        'Telefono' => $jornada->Telefono,
                        'Lugar' => $jornada->Lugar

                         );

                       }

                Excel::create('Jornada', function ($excel) use ($jornada_array) {
                    $excel->setTitle('Jornada');
                    $excel->sheet('Jornada', function ($sheet) use ($jornada_array){
                    
                      $sheet->fromArray($jornada_array, null, 'A1', false, false);
                    });
                      
                })->export('xlsx');

              //  $sheet->fromArray($data);
            // });
            /** Agregará una segunda hoja y se llamará Productos */
          
        //})->export('xlsx');
      
       

      
    }



    public  function ObtenerMiCalendario(Request $request){
       // $urlinfo= $request->getPathInfo();
        //$request->user()->AutorizarUrlRecurso($urlinfo);
        $view = View::make('Citas/MiCalendario');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Citas/listaJornadas');

    }
}