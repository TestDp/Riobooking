<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:18 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MEmpresa;
use App\Org_Saludables\Negocio\DTO\MEmpresa\CompaniaDTO;


interface ICompaniaServicio
{
    public function GuardarCompania(CompaniaDTO $companiaDTO);
    public function ObtenerListaCompanias();
    public function ObtenerCompania($idCompania);
}