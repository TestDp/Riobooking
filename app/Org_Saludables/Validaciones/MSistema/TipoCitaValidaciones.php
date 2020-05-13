<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 31/08/2018
 * Time: 4:07 PM
 */

namespace Org_Saludables\Validaciones\MSistema;

use Illuminate\Support\Facades\Validator;

class TipoCitaValidaciones
{

    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();
        return Validator::make($data, [
            //'Nombre' => 'required|string|max:255',
            'Nombre' => 'required|max:255', 
            'Sede_id' =>'required|string|max:255'
        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return ['Nombre.required' => 'El nombre es obligatorio', 
                  'Regional_id.required' => 'La regional es obligatoria',];
    }
}