<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 10:15 AM
 */

namespace Org_Saludables\Negocio\Logica\MSistema;


use Org_Saludables\Datos\Modelos\MSistema\TipoCita;
use Org_Saludables\Datos\Repositorio\MSistema\TipoCitaRepositorio;

class TipoCitaServicio
{
    protected  $TipoCitaRepositorio;
    public function __construct(TipoCitaRepositorio $TipoCitaRepositorio){
        $this->TipoCitaRepositorio = $TipoCitaRepositorio;
    }

    public  function GuardarTipoCita($request)
    {
         return $this->TipoCitaRepositorio->GuardarTipoCita($request);
    }

    public  function  ObtenerListaTipoCitas($idEmpreesa)
    {
        return $this->TipoCitaRepositorio->ObtenerListaTipoCitas($idEmpreesa);
    
    }

       public  function  ObtenerListaTipoCitasR($idRegional)
    {
        return $this->TipoCitaRepositorio->ObtenerListaTipoCitasR($idRegional);
    }

}