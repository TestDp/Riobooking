<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Datos\Repositorio\MEmpresa\IGerenciaRepositorio;
use App\Org_Saludables\Negocio\DTO\MEmpresa\GerenciaDTO;
use Org_Saludables\Datos\Modelos\MEmpresa\Gerencia;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IGerenciaServicio;



class GerenciaServicio implements IGerenciaServicio
{
    protected  $gerenciaRepositorio;
    public function __construct(IGerenciaRepositorio $gerenciaRepositorio){
        $this->gerenciaRepositorio = $gerenciaRepositorio;
    }

    public  function GuardarGerencia(GerenciaDTO $gerenciaDTO){
        $gerenciaModel = $gerenciaDTO->toModel(Gerencia::class);
        $gerenciaModel->activa = 1;
        return $this->gerenciaRepositorio->GuardarGerencia($gerenciaModel);
    }

    public  function  ObtenerListaGerencias($idEmpreesa){
        return $this->gerenciaRepositorio->ObtenerListaGerencias($idEmpreesa);
    }
}