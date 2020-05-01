<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 13/01/2019
 * Time: 6:18 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;
use App\Org_Saludables\Negocio\DTO\MCitas\JornadaDTO;


interface IJornadaServicio
{
    public function GuardarJornada(JornadaDTO $jornadaDTO,$request);
    public function ObtenerListaJornadas($idEmpreesa);
    public function ObtenerJornada ($idEmpreesa, $idJornada);
    public function ObtenerJornadaC($idJornada);
}