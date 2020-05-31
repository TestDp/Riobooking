<?php

namespace App\Http\Controllers\Auth;

use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Org_Saludables\Datos\Modelos\MSistema\Rol;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public $iCompaniaServicio;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ICompaniaServicio $iCompaniaServicio)
    {
        $this->middleware('guest');
        $this->iCompaniaServicio = $iCompaniaServicio;
    }


    public function showRegistrationForm()
    {
        $arrayCompaniasDTO = $this->iCompaniaServicio->ObtenerListaCompanias();
        return view('auth.register',array('companias'=>$arrayCompaniasDTO));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return: redirecciona al usuario al inicio de sesión
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        if($request->ajax()){
            $view = View::make('MSistema/Colaborador/crearReservaColaboradorVP');
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mensajes = $this->mensajesFormularioCrear();
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Sede_id' =>'required|string|max:255',
            'telefono' => 'required|max:255',
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {

            $data['CodigoConfirmacion'] = str_random(25);
            $user = User::create([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'telefono'=> $data['telefono'],
                'password' => Hash::make($data['password']),
                'Sede_id' =>$data['Sede_id'],
                'activo'=>1
            ]);
            $user
                ->roles()
                ->attach(Rol::where('Nombre', 'colaborador')->first());
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            $error = $e->getMessage();

            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
            console.('$error');
        }
    }



}
