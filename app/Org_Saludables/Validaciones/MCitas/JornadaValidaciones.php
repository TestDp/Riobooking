<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 10:35 AM
 */

namespace Org_Saludables\Validaciones\MCitas;

use Illuminate\Support\Facades\Validator;

class JornadaValidaciones
{
    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();

        return Validator::make($data, [
            'Sede_id' => 'required|string|max:255',
            'Colaborador_id' => 'required|max:255',
            'Duracion' => 'required',
            'Descanso' => 'required',
            'Lugar' => 'required|string|max:255'
        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return [
            'Sede_id.required' => 'La regional es obligatoria',
            'Colaborador_id.required' => 'El colaborador es obligatorio',
            'Duracion.required' => 'La duración de la cita es obligatoria',
            'Descanso.required' => 'El descanso es obligatorio',
            'Lugar.required' => 'El lugar es obligatorio'
        ];
    }
}