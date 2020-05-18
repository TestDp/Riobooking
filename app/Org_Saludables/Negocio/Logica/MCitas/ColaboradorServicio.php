<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:16 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;
use App\Org_Saludables\Datos\Repositorio\MCitas\IColaboradorRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\ColaboradorDTO;

class ColaboradorServicio
{
    public $iColaboradorRepositorio;
    public $colaboradorDTO;

    public function __construct(IColaboradorRepositorio $iColaboradorRepositorio)
    {
        $this->iColaboradorRepositorio = $iColaboradorRepositorio;
    }

    public  function GuardarColaborador(ColaboradorDTO $colaboradorDTO){
        $colaboradorModel = $colaboradorDTO->toModel(Colaborador::class);
        return $this->iColaboradorRepositorio->GuardarColaborador($colaboradorModel);
    }



    public function ObtenerListaColaboradores($idEmpresa){
        $arrayModelColaboradores= $this->iColaboradorRepositorio->ObtenerListaColaboradores($idEmpresa);
        $arrayDTOColaboradores = array();
        foreach ($arrayModelColaboradores as $modelColaborador){
            $colaboradorDTO = new ColaboradorDTO((array)$modelColaborador);
            $colaboradorDTO->RutaLogo= env('RutaLogo');
            $arrayDTOColaboradores[]=$colaboradorDTO;
        }
        return $arrayDTOColaboradores;
    }
    public function ObtenerListaColaboradoresPorServicio($idTipoServicio){
        $arrayModelColaboradores= $this->iColaboradorRepositorio->ObtenerListaColaboradoresPorServicio($idTipoServicio);
        $arrayDTOColaboradores = array();
        foreach ($arrayModelColaboradores as $modelColaborador){
            $colaboradorDTO = new ColaboradorDTO((array)$modelColaborador);
            $colaboradorDTO->rutaImagen= env('RutaImgColaboradorPerfil');
            $arrayDTOColaboradores[]=$colaboradorDTO;
        }
        return $arrayDTOColaboradores;
    }
    public function GuardarServiciosPorColaboradores($request)
    {
        return $this->iColaboradorRepositorio->GuardarServiciosPorColaboradores($request);

    }

    public function ObtenerListaServiciosPorColaborador($idSede){
        $arrayModelServiciosColaborador= $this->iColaboradorRepositorio->ObtenerListaServiciosPorColaborador($idSede);

        return $arrayModelServiciosColaborador;
    }

    public function ObtenerTodosLosServiciosPorColaborador($idusuario){
        $arrayModelTodosServiciosColaborador= $this->iColaboradorRepositorio->ObtenerTodosLosServiciosPorColaborador($idusuario);

        return $arrayModelTodosServiciosColaborador;
    }

}