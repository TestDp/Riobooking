<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 3/01/2019
 * Time: 11:46 AM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;


use Org_Saludables\Datos\Modelos\MCitas\Jornada;
use Org_Saludables\Datos\Modelos\MCitas\Cita;

interface ICitasRepositorio
{
    /**
     * @param Jornada $jornada
     * @return verdadero o falso si la operacion fue correcta o no.
     */
    public function GuardarCita(Jornada $jornada);

    /**
     * @param $idEmpreesa : id o pk de la empresa
     * @return lista de sedes de la empresa
     */
   
}