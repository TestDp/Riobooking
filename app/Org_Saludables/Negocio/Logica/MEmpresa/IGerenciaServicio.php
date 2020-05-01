<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 3/01/2019
 * Time: 11:27 AM
 */

namespace App\Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Negocio\DTO\MEmpresa\GerenciaDTO;

interface IGerenciaServicio
{
    /**
     * @param GerenciaDTO $sedeDTO
     * @return  verdadero o falso si la operacion fue correcta o no.
     */
    public  function GuardarGerencia(GerenciaDTO $gerenciaDTO);


    /**
     * @param $idEmpreesa : id o pk de la empresa
     * @return lista de sedes de la empresa
     */
    public  function  ObtenerListaGerencias($idEmpreesa);
}