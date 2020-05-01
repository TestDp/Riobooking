<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 10:35 AM
 */

namespace Org_Saludables\Validaciones\MEmpresa;

use Illuminate\Support\Facades\Validator;

class GerenciaValidaciones
{
    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();

        return Validator::make($data, [
            'Nombre' => 'required|string|max:255',
            'Regional_id' => 'required|string|max:255'
  
            //'Telefono' => 'required|max:255'
        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return ['Nombre.required' => 'El nombre es obligatorio',
                'Regional_id.required' => 'La regional es obligatoria'
           ];
    }
}