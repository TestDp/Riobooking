<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/05/2020
 * Time: 12:16 PM
 */

namespace App\Org_Saludables\Negocio\Logica\MCitas;


use App\Org_Saludables\Datos\Modelos\MCitas\Colaborador;
use App\Org_Saludables\Datos\Repositorio\MCitas\IColaboradorRepositorio;
use App\Org_Saludables\Negocio\DTO\MCitas\ColaboradorDTO;

class ColaboradorServicio
{
    public $iColaboradorRepositorio;
    public $colaboradorDTO;

    public function __construct(IColaboradorRepositorio $iColaboradorRepositorio)
    {
        $this->iColaboradorRepositorio = $iColaboradorRepositorio;
    }

    public  function GuardarColaborador(ColaboradorDTO $colaboradorDTO){
        $colaboradorModel = $colaboradorDTO->toModel(Colaborador::class);
        return $this->iColaboradorRepositorio->GuardarColaborador($colaboradorModel);
    }

}