<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:20 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Datos\Repositorio\MEmpresa\ICompaniaRepositorio;
use App\Org_Saludables\Negocio\DTO\MEmpresa\CompaniaDTO;
use Org_Saludables\Datos\Modelos\MEmpresa\Compania;

class CompaniaServicio implements ICompaniaServicio
{
    public $iCompaniaRepositorio;
    public $companiaDTO;

    public function __construct(ICompaniaRepositorio $iCompaniaRepositorio)
    {
        $this->iCompaniaRepositorio = $iCompaniaRepositorio;

    }

    
    public  function GuardarCompania(CompaniaDTO $companiaDTO){
        $companiaModel = $companiaDTO->toModel(Compania::class);
        $companiaModel->Activa = 1;
        return $this->iCompaniaRepositorio->GuardarCompania($companiaModel);
    }

    public function ObtenerListaCompanias(){
       $arrayModelCompanias = $this->iCompaniaRepositorio->ObtenerListaCompanias();
       $arrayDTOCompnias = array();
       foreach ($arrayModelCompanias as $modelCompania){
           $companiaDTO = new CompaniaDTO($modelCompania->toArray());
           $companiaDTO->RutaLogo= env('RutaLogo');
           $arrayDTOCompnias[]=$companiaDTO;
       }
       return $arrayDTOCompnias;

    }

}