<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 5:35 PM
 */

namespace Org_Saludables\Validaciones\MSistema;
use Illuminate\Support\Facades\Validator;

class UsuarioValidaciones
{
    public function ValidarFormularioCrear(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Roles_id' => 'required|max:255',
            'Sede_id' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',

        ],$mensajes);
    }

    public  function  mensajesFormularioCrear(){
        return ['name.required' => 'El nombre es obligatorio',
                'last_name.required' => 'El apellido es obligatorio',
                'username.required' => 'El usuario es obligatorio',
                'username.unique' => 'El usuario ya se encuentra registrado',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.unique' => 'El correo electrónico ya se encuentra registrado',
                'password.required' => 'La contraseña es obligatoria',
                'password.confirmed' => 'Las contraseñas no son iguales',
                'Roles_id.required' => 'Los roles son obligatorios',
                'Sede_id.required' => 'La Compañia es obligatoria',
                  'telefono.required' => 'El Telefono es obligatorio',

                ];
    }
}