<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:14 PM
 */

namespace App\Org_Saludables\Datos\Repositorio\MCitas;


use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;

interface IColaboradorRepositorio
{
    public  function GuardarColaborador(Colaborador $colaborador);
    public  function ObtenerListaColaboradores($idEmpresa);
}