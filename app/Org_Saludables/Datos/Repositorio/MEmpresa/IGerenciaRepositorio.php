<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 3/01/2019
 * Time: 11:46 AM
 */

namespace App\Org_Saludables\Datos\Repositorio\MEmpresa;


use Org_Saludables\Datos\Modelos\MEmpresa\Gerencia;

interface IGerenciaRepositorio
{
    /**
     * @param Gerencia $sede
     * @return verdadero o falso si la operacion fue correcta o no.
     */
    public function GuardarGerencia(Gerencia $gerencia);

    /**
     * @param $idEmpreesa : id o pk de la empresa
     * @return lista de sedes de la empresa
     */
    public  function  ObtenerListaGerencias($idEmpreesa);
}