<?php
/**
 * Created by PhpStorm.
 * User: DPS-J
 * Date: 17/05/2020
 * Time: 6:30 PM
 */


namespace Org_Saludables\Validaciones\MSistema;
use Illuminate\Support\Facades\Validator;

class ServiciosColaboradorValidaciones
{

    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();
        return Validator::make($data, [
            'Colaborador_id' => 'required|string|max:255',
            'TipoCita_id' =>'required|max:255'
        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return ['Colaborador_id.required' => 'El nombre es obligatorio',
            'TipoCita_id.required' => 'El Servicio es obligatoria',];
    }
}