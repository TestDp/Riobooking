<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 3/01/2019
 * Time: 11:27 AM
 */

namespace App\Org_Saludables\Negocio\Logica\MEmpresa;


use App\Org_Saludables\Negocio\DTO\MEmpresa\SedeDTO;

interface ISedeServicio
{
    /**
     * @param SedeDTO $sedeDTO
     * @return  verdadero o falso si la operacion fue correcta o no.
     */
    public  function GuardarSede(SedeDTO $sedeDTO);


    /**
     * @param $idEmpreesa : id o pk de la empresa
     * @return lista de sedes de la empresa
     */
    public  function  ObtenerListaSedes($idEmpreesa);

    public function ObtenerSedesEmpresas();
}