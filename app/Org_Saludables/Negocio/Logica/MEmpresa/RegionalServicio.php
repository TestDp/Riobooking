<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Datos\Repositorio\MEmpresa\IRegionalRepositorio;
use App\Org_Saludables\Negocio\DTO\MEmpresa\RegionalDTO;
use Org_Saludables\Datos\Modelos\MEmpresa\Sede;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IRegionalServicio;



class RegionalServicio implements IRegionalServicio
{
    protected  $regionalRepositorio;
    public function __construct(IRegionalRepositorio $regionalRepositorio){
        $this->regionalRepositorio = $regionalRepositorio;
    }

    public  function GuardarRegional(RegionalDTO $regionalDTO){
        $regionalModel = $regionalDTO->toModel(Sede::class);
        $regionalModel->activa = 1;
        return $this->regionalRepositorio->GuardarRegional($regionalModel);
    }

    public  function  ObtenerListaRegionales($idEmpreesa){
        return $this->regionalRepositorio->ObtenerListaRegionales($idEmpreesa);
    }
}