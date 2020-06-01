<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 3/01/2019
 * Time: 11:46 AM
 */

namespace App\Org_Saludables\Datos\Repositorio\MEmpresa;


use Org_Saludables\Datos\Modelos\MEmpresa\Sede;

interface ISedeRepositorio
{
    /**
     * @param Sede $sede
     * @return verdadero o falso si la operacion fue correcta o no.
     */
    public function GuardarSede(Sede $sede);

    /**
     * @param $idEmpreesa : id o pk de la empresa
     * @return lista de sedes de la empresa
     */
    public  function  ObtenerListaSedes($idEmpreesa);

    public  function  ObtenerListaSedesCompa($idSede);

    public function ObtenerSedesEmpresas();
}