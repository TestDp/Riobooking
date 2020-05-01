<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 10:35 AM
 */

namespace Org_Saludables\Validaciones\MCitas;

use Illuminate\Support\Facades\Validator;

class CitaValidaciones
{
    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();

        return Validator::make($data, [
       
            'Regional_id' => 'required|string|max:255',
            'Tipo_Cita_id' => 'required|string|max:255'


           

  
            //'Telefono' => 'required|max:255'
        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return [
                'Regional_id.required' => 'La regional es obligatoria',
                'Tipo_Cita_id.required' => 'El tipo de cita es obligatorio'

           ];
    }
}