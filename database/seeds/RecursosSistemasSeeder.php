<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class RecursosSistemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $arrayCompaniaIds = ['1','2','3','4','5','6','7','8','9','10',
        '11','12','13','14','15','16','17','18',
        '19','20','21','22','23','24','25','26',
        '27','28','29','30','31','32', '33','34','35','36', '37','38'];

        $arrayCompaniaNombres = ['Administrador','CrearTipoCita','TiposDeCitas',
        'GuardarTipoCita','Empresa','Sedes','CrearSede','GuardarSede','Roles','CrearRol',
        'GuardarRol','Usuarios','CrearUsuario','GuardarUsuario','EditarRol','EditarUsuario','Companias','CrearCompania',
        'GuardarCompania','Regionales','CrearRegional','GuardarRegional','Gerencias','CrearGerencia','GuardarGerencia',
        'Citas','Jornadas','CrearJornada','GuardarJornada','Cita','ReservarCita','GuardarReserva', 'DetalleJornada',
        'CancelarReserva', 'GuardarCancelacion','ExportarJornada', 'EditarRol','BorrarCitas'];

        $arrayCompaniaDescrip = ['Modulo de administrador','Funcion para crear tipos de citas','Recursos para mostrar los tipos de Citas','Recurso para visualizar la vista para crear un tipo de cita','Modulo empresa','Recurso para mostrar la lista de sedes','Recurso para cargar la vista de crear sede','Recurso para guardar la informacion de la sede','Recurso para mostrar lista de roles','Recurso para cargar la vista de crear rol',
        'Recurso para hacer el guardado del rol','Recurso para visualizar la lista de usuarios','Recurso para mostrar la vista de crear usuario','Recurso para guardar la información del usuario','Editar rol','Recursos para editar los usuarios','Recurso para mostrar la lista de Compañias','Recurso para cargar la vista de crear Compania',
        'Recurso para guarda la informacion de la Compania','Recurso para mostrar la lista de Regionales','Recurso para cargar la vista de crear Regional','Recurso para guarda la informacion de la regional','Recurso para mostrar la lista de gerencias','Recurso para cargar la vista de crear gerencia','Recurso para guardar la información de la gerencia','Modulo de citas',
        'Recurso para mostrar la lista de jornadas','Recurso para cargar la vista de crear Jornada','Recurso para guarda la informacion de la Jornada','Recurso para mostrar la lista de Citas','Recurso para cargar la vista de reservar cita','Recurso para guarda la información de la reserva', 'Recurso para ver el detalle de la jornada','Recurso para guarda la informacion de la reserva','Recurso para guarda la información de la cancelacion de lar reserva','Recurso para exportar la jornada', 'Recurso para editar los roles','Recurso para borrar citas'];

        $arrayCompaniaUrl = ['','/crearTipoCita','/tiposCitas','/guardarTipoCita','','/sedes','/crearSede','/guardarSede','/roles','/crearRol',
        '/guardarRol','/usuarios','/crearUsuario','/guardarUsuario','/editarRol','/editarUsuario','/companias','/crearCompania',
        '/guardarCompania','/regionales','/crearRegional','/guardarRegional','/gerencias','/crearGerencia','/guardarGerencia','',
        '/jornadas','/crearJornada','/guardarJornada','/citas','/crearJornada','/guardarReserva','/detalleJornada','/cancelarReserva','/guardarCancelacion','/exportarJornada', '/editarRol','/guardarBorrado'];  
         
        $arrayCompaniaPadreId = [NULL,1,1,1,NULL,5,5,5,5,5,
        5,5,5,5,5,5,1,1,
        1,5,5,5,5,5,5,NULL,
        26,26,26,26,26,26,26,26,26,26,5,26];


        for($i=0;$i < count($arrayCompaniaIds);$i++)
        {
            DB::table('Tbl_Recursos_Sistemas')->insert([
                'id' => $arrayCompaniaIds[$i],
                'Nombre' => $arrayCompaniaNombres[$i],
                'Descripcion' => $arrayCompaniaDescrip[$i],
                'UrlRecurso' => $arrayCompaniaUrl[$i],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
                'RecursoSistemaPadre_id' => $arrayCompaniaPadreId[$i],
            ]);
        }

        
    }

    
}
