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
use App\Org_Saludables\Negocio\DTO\MEmpresa\CategoriaDTO;
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
           $companiaDTO = new CompaniaDTO((array)$modelCompania);
           $companiaDTO->RutaLogo= env('RutaLogo');
           $arrayDTOCompnias[]=$companiaDTO;
       }
       return $arrayDTOCompnias;

    }

    public function ObtenerListaCompaniasXStrNombre($strNegocios){
        $arrayModelCompanias = $this->iCompaniaRepositorio->ObtenerListaCompaniasXStrNombre($strNegocios);
        $arrayDTOCompnias = array();
        foreach ($arrayModelCompanias as $modelCompania){
            $companiaDTO = new CompaniaDTO((array)$modelCompania);
            $companiaDTO->RutaLogo= env('RutaLogo');
            $arrayDTOCompnias[]=$companiaDTO;
        }
        return $arrayDTOCompnias;
    }

    public function ObtenerCompania($idCompania)
    {
        $companiaModel = $this->iCompaniaRepositorio->ObtenerCompania($idCompania);
        $companiaDTO = new CompaniaDTO((array)$companiaModel);
        $companiaDTO->RutaLogo= env('RutaLogoPerfil');
        return $companiaDTO;
    }

    public function ObtenerListaCategorias(){
        $arrayModelCategorias = $this->iCompaniaRepositorio->ObtenerListaCategorias();
        $arrayDTOCategorias = array();
        foreach ($arrayModelCategorias as $modelCategoria){
            $categoriaDTO = new CategoriaDTO((array)$modelCategoria);

            $arrayDTOCategorias[]=$categoriaDTO;
        }
        return $arrayDTOCategorias;

    }

}