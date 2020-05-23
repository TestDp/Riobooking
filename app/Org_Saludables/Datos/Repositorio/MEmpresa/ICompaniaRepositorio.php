<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:12 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MEmpresa;
use Org_Saludables\Datos\Modelos\MEmpresa\Compania;

interface ICompaniaRepositorio
{
    public function GuardarCompania(Compania $compania);
    public function ObtenerListaCompanias();
    public function ObtenerCompania($idCompania);
    public function ObtenerListaCategorias();

    
}