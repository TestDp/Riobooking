<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Datos\Repositorio\MEmpresa\ISedeRepositorio;
use App\Org_Saludables\Negocio\DTO\MEmpresa\SedeDTO;
use Org_Saludables\Datos\Modelos\MEmpresa\Sede;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;



class SedeServicio implements ISedeServicio
{
    protected  $sedeRepositorio;
    public function __construct(ISedeRepositorio $sedeRepositorio){
        $this->sedeRepositorio = $sedeRepositorio;
    }

    public  function GuardarSede(SedeDTO $sedeDTO){
        $sedeModel = $sedeDTO->toModel(Sede::class);
        $sedeModel->activa = 1;
        return $this->sedeRepositorio->GuardarSede($sedeModel);
    }

    public  function  ObtenerListaSedes($idEmpreesa){
        return $this->sedeRepositorio->ObtenerListaSedes($idEmpreesa);
    }

    public  function  ObtenerListaSedesCompa($idSede){
        return $this->sedeRepositorio->ObtenerListaSedesCompa($idSede);
    }

    public function ObtenerSedesEmpreas(){
        return $this->sedeRepositorio->ObtenerSedesEmpreas();
    }
}