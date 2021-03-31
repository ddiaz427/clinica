<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


Route::get('/', function () {
    return view('welcome');
});
*/
  
  
  
// Home routes...
Route::get('/', [
	'uses' 	=>	'HomeController@index',
	'as'	=>	'home'
]);

// Authentication routes...
Route::get('login', [
	'uses' 	=>	'Auth\AuthController@getLogin',
	'as'	=>	'login'
]);
Route::post('login', 'Auth\AuthController@postLogin');

// Authentication routes...
Route::get('logout', [
	'uses' 	=>	'Auth\AuthController@getLogout',
	'as'	=>	'logout'
]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Modulos Routes
route::get('modulos', [
	'uses' 	=>	'glb\ModuloController@index',
	'as'	=>	'modulos'
]);
route::get('modulos/{id}', [
	'uses' 	=>	'glb\ModuloController@show',
	'as'	=>	'ver-modulo'
])->where(['id' => '[0-9]+']);

route::get('modulos/editar/{id}', [
	'uses' 	=>	'glb\ModuloController@edit',
	'as'	=>	'editar-modulo'
])->where(['id' => '[0-9]+']);

route::post('modulos/update/{id}', [
	'uses' 	=>	'glb\ModuloController@update',
	'as'	=>	'actualizar-modulo'
])->where(['id' => '[0-9]+']);


route::get('modulos/crear', [
	'uses' 	=>	'glb\ModuloController@create',
	'as'	=>	'crear-modulo'
]);
route::post('modulos/crear', [
	'uses' 	=>	'glb\ModuloController@store',
	'as'	=>	'crear-modulo'
]);
route::get('modulos/eliminar/{id}', [
	'uses' 	=>	'glb\ModuloController@destroy',
	'as'	=>	'eliminar-modulo'
]);

//Roles Routes
route::get('roles', [
	'uses' 	=>	'glb\RolController@index',
	'as'	=>	'roles'
]);
route::get('roles/{id}', [
	'uses' 	=>	'glb\RolController@show',
	'as'	=>	'ver-rol'
])->where(['id' => '[0-9]+']);

route::get('roles/editar/{id}', [
	'uses' 	=>	'glb\RolController@edit',
	'as'	=>	'editar-rol'
])->where(['id' => '[0-9]+']);

route::post('roles/update/{id}', [
	'uses' 	=>	'glb\RolController@update',
	'as'	=>	'actualizar-rol'
])->where(['id' => '[0-9]+']);


route::get('roles/crear', [
	'uses' 	=>	'glb\RolController@create',
	'as'	=>	'crear-rol'
]);
route::post('roles/crear', [
	'uses' 	=>	'glb\RolController@store',
	'as'	=>	'crear-rol'
]);
route::get('roles/eliminar/{id}', [
	'uses' 	=>	'glb\RolController@destroy',
	'as'	=>	'eliminar-rol'
]);

//Usuarios Routes
route::get('usuarios', [
	'uses' 	=>	'glb\UsuarioController@index',
	'as'	=>	'usuarios'
]);
route::get('usuarios/ver/{id}', [
	'uses' 	=>	'glb\UsuarioController@show',
	'as'	=>	'ver-usuario'
])->where(['id' => '[0-9]+']);

route::get('usuarios/ver/', [
	'uses' 	=>	'glb\UsuarioController@show',
	'as'	=>	'ver-perfil'
])->where(['id' => '[0-9]+']);

route::get('usuarios/editar/{id}', [
	'uses' 	=>	'glb\UsuarioController@edit',
	'as'	=>	'editar-usuario'
])->where(['id' => '[0-9]+']);

route::post('usuarios/update/{id}', [
	'uses' 	=>	'glb\UsuarioController@update',
	'as'	=>	'actualizar-usuario'
])->where(['id' => '[0-9]+']);

route::get('usuarios/crear', [
	'uses' 	=>	'glb\UsuarioController@create',
	'as'	=>	'crear-usuario'
]);
route::post('usuarios/crear', [
	'uses' 	=>	'glb\UsuarioController@store',
	'as'	=>	'crear-usuario'
]);
route::get('usuarios/eliminar/{id}', [
	'uses' 	=>	'glb\UsuarioController@destroy',
	'as'	=>	'eliminar-usuario'
]);
route::get('usuarios/editar-perfil', [
	'uses' 	=>	'glb\UsuarioController@editarPerfil',
	'as'	=>	'editar-perfil'
]);
route::post('usuarios/editar-perfil', [
	'uses' 	=>	'glb\UsuarioController@editarPerfil',
	'as'	=>	'editar-perfil'
]);

//Grupomodulos Routes
route::get('grupomodulos', [
	'uses' 	=>	'glb\GrupomoduloController@index',
	'as'	=>	'grupomodulos'
]);
route::get('grupomodulos/{id}', [
	'uses' 	=>	'glb\GrupomoduloController@show',
	'as'	=>	'ver-grupomodulo'
])->where(['id' => '[0-9]+']);

route::get('grupomodulos/editar/{id}', [
	'uses' 	=>	'glb\GrupomoduloController@edit',
	'as'	=>	'editar-grupomodulo'
])->where(['id' => '[0-9]+']);

route::post('grupomodulos/update/{id}', [
	'uses' 	=>	'glb\GrupomoduloController@update',
	'as'	=>	'actualizar-grupomodulo'
])->where(['id' => '[0-9]+']);

route::get('grupomodulos/crear', [
	'uses' 	=>	'glb\GrupomoduloController@create',
	'as'	=>	'crear-grupomodulo'
]);
route::post('grupomodulos/crear', [
	'uses' 	=>	'glb\GrupomoduloController@store',
	'as'	=>	'crear-grupomodulo'
]);
route::get('grupomodulos/eliminar/{id}', [
	'uses' 	=>	'glb\GrupomoduloController@destroy',
	'as'	=>	'eliminar-grupomodulo'
]);

//Modulo Presupuesto Tipo transacciones
route::get('transacciones', [
	'uses' 	=>	'pto\TipotransaccionesController@index',
	'as'	=>	'transacciones'
]);

Route::get('transacciones/index', 'pto\TipotransaccionesController@index');

route::get('transacciones/crear', [
	'uses' 	=>	'pto\TipotransaccionesController@create',
	'as'	=>	'crear-transacciones'
]);

route::post('transacciones/crear', [
	'uses' 	=>	'pto\TipotransaccionesController@store',
	'as'	=>	'crear-transacciones'
]);

route::get('transacciones/{id}', [
	'uses' 	=>	'pto\TipotransaccionesController@show',
	'as'	=>	'ver-transacciones'
])->where(['id' => '[0-9]+']);

route::get('transacciones/editar/{id}', [
	'uses' 	=>	'pto\TipotransaccionesController@edit',
	'as'	=>	'editar-transacciones'
])->where(['id' => '[0-9]+']);

route::post('transacciones/update/{id}', [
	'uses' 	=>	'pto\TipotransaccionesController@update',
	'as'	=>	'actualizar-transacciones'
])->where(['id' => '[0-9]+']);

//Modulo Presupuesto Tiempo Extra
route::get('PtoTiempoExtra', [
	'uses' 	=>	'pto\PtoTiempoExtraController@index',
	'as'	=>	'tiempo'
]);

Route::get('PtoTiempoExtraPtoTiempoExtra/index', 'pto\PtoTiempoExtraController@index');

route::get('PtoTiempoExtra/crear', [
	'uses' 	=>	'pto\PtoTiempoExtraController@create',
	'as'	=>	'crear-tiempo'
]);

route::post('PtoTiempoExtra/crear', [
	'uses' 	=>	'pto\PtoTiempoExtraController@store',
	'as'	=>	'crear-tiempo'
]);

route::get('PtoTiempoExtra/{id}', [
	'uses' 	=>	'pto\PtoTiempoExtraController@show',
	'as'	=>	'ver-tiempo'
])->where(['id' => '[0-9]+']);

route::get('PtoTiempoExtra/editar/{id}', [
	'uses' 	=>	'pto\PtoTiempoExtraController@edit',
	'as'	=>	'editar-transacciones'
])->where(['id' => '[0-9]+']);

route::post('PtoTiempoExtra/update/{id}', [
	'uses' 	=>	'pto\PtoTiempoExtraController@update',
	'as'	=>	'actualizar-PtoTiempoExtraController'
])->where(['id' => '[0-9]+']);

//Modulo Presupuesto Tipos de Procesos
route::get('pto-tipo-proceso', [
	'uses' 	=>	'pto\PtoTipoProcesoController@index',
	'as'	=>	'tipoProceso'
]);

route::get('pto-tipo-proceso/crear', [
	'uses' 	=>	'pto\PtoTipoProcesoController@create',
	'as'	=>	'crear-tipo'
]);

route::post('pto-tipo-proceso/crear', [
	'uses' 	=>	'pto\PtoTipoProcesoController@store',
	'as'	=>	'crear-tipo'
]);

route::get('pto-tipo-proceso/editar/{id}', [
	'uses' 	=>	'pto\PtoTipoProcesoController@edit',
	'as'	=>	'editar-tipo'
])->where(['id' => '[0-9]+']);

route::post('pto-tipo-proceso/update/{id}', [
	'uses' 	=>	'pto\PtoTipoProcesoController@update',
	'as'	=>	'actualizar-tipo'
])->where(['id' => '[0-9]+']);

route::get('pto-tipo-proceso/eliminar/{id}', [
	'uses' 	=>	'pto\PtoTipoProcesoController@destroy',
	'as'	=>	'eliminar-tipo'
]);

//Modulo Presupuesto Tipos de Entidad
route::get('pto-tipo-entidad', [
	'uses' 	=>	'pto\PtoTipoEntidadController@index',
	'as'	=>	'pto-tipo-entidad'
]);

route::get('pto-tipo-entidad/crear', [
	'uses' 	=>	'pto\PtoTipoEntidadController@create',
	'as'	=>	'crear-pto-tipo-entidad'
]);

route::post('pto-tipo-entidad/crear', [
	'uses' 	=>	'pto\PtoTipoEntidadController@store',
	'as'	=>	'crear-pto-tipo-entidad'
]);

route::get('pto-tipo-entidad/editar/{id}', [
	'uses' 	=>	'pto\PtoTipoEntidadController@edit',
	'as'	=>	'editar-pto-tipo-entidad'
])->where(['id' => '[0-9]+']);

route::post('pto-tipo-entidad/update/{id}', [
	'uses' 	=>	'pto\PtoTipoEntidadController@update',
	'as'	=>	'actualizar-pto-tipo-entidad'
])->where(['id' => '[0-9]+']);

route::get('pto-tipo-entidad/eliminar/{id}', [
	'uses' 	=>	'pto\PtoTipoEntidadController@destroy',
	'as'	=>	'eliminar-pto-tipo-entidad'
]);

//Modulo Presupuesto NIveles de estructura
route::get('pto-nivel-estructura', [
	'uses' 	=>	'pto\PtoNivelEstrucController@index',
	'as'	=>	'pto-nivel-estructura'

]);

route::get('pto-nivel-estructura/crear', [
	'uses' 	=>	'pto\PtoNivelEstrucController@create',
	'as'	=>	'crear-pto-nivel-estructura'
]);

route::post('pto-nivel-estructura/crear', [
	'uses' 	=>	'pto\PtoNivelEstrucController@store',
	'as'	=>	'crear-pto-nivel-estructura'
]);

route::get('pto-nivel-estructura/editar/{id}', [
	'uses' 	=>	'pto\PtoNivelEstrucController@edit',
	'as'	=>	'editar-pto-nivel-estructura'
])->where(['id' => '[0-9]+']);

route::post('pto-nivel-estructura/update/{id}', [
	'uses' 	=>	'pto\PtoNivelEstrucController@update',
	'as'	=>	'actualizar-pto-nivel-estructura'
])->where(['id' => '[0-9]+']);

route::get('pto-nivel-estructura/eliminar/{id}', [
	'uses' 	=>	'pto\PtoNivelEstrucController@destroy',
	'as'	=>	'eliminar-pto-nivel-estructura'
]);

//Modulo Presupuesto CDP
route::get('pto-cdp/crear', [
	'uses' 	=>	'pto\PtoMovtoController@create',
	'as'	=>	'crear-pto-cdp'
]);

route::post('pto-cdp/crear', [
	'uses' 	=>	'pto\PtoMovtoController@store',
	'as'	=>	'crear-pto-cdp'
]);

route::get('pto-cdp', [
	'uses' 	=>	'pto\PtoMovtoController@create',
	'as'	=>	'pto-cdp'
]);

//Modulo Presupuesto Estados
route::get('pto-estado', [
	'uses' 	=>	'pto\PtoEstadoController@index',
	'as'	=>	'pto-estado'
]);

route::get('pto-estado/crear', [
	'uses' 	=>	'pto\PtoEstadoController@create',
	'as'	=>	'crear-pto-estado'
]);

route::post('pto-estado/crear', [
	'uses' 	=>	'pto\PtoEstadoController@store',
	'as'	=>	'crear-pto-estado'
]);

route::get('pto-estado/editar/{id}', [
	'uses' 	=>	'pto\PtoEstadoController@edit',
	'as'	=>	'editar-pto-estado'
])->where(['id' => '[0-9]+']);

route::post('pto-estado/update/{id}', [
	'uses' 	=>	'pto\PtoEstadoController@update',
	'as'	=>	'actualizar-pto-estado'
])->where(['id' => '[0-9]+']);

route::get('pto-estado/eliminar/{id}', [
	'uses' 	=>	'pto\PtoEstadoController@destroy',
	'as'	=>	'eliminar-pto-estado'
]);



//Modulo Presupuesto Rubros
route::get('pto-rubros/crear', [
	'uses' 	=>	'pto\PtoRubrosController@create',
	'as'	=>	'crear-pto-rubros'
]);
route::post('pto-rubros/cargar', [
	'uses' 	=>	'pto\PtoRubrosController@cargarRubros',
	'as'	=>	'cargar-pto-rubros'
]);



route::post('pto-rubros/validar', [
	'uses' 	=>	'pto\PtoRubrosController@validarRubros',
	'as'	=>	'validar-pto-rubros'
]);

//Modulo Presupuesto Tipo Movimiento
route::post('pto-tipo-mov/update/{id}', [
	'uses' 	=>	'pto\PtoTiposMovController@update',
	'as'	=>	'actualizar-pto-tipo-mov'
])->where(['id' => '[0-9]+']);

route::get('pto-tipo-mov/eliminar/{id}', [
	'uses' 	=>	'pto\PtoTiposMovController@destroy',
	'as'	=>	'eliminar-pto-tipo-mov'
]);

//Modulo Presupuesto Movimientos
route::get('pto-cdp', [
	'uses' 	=>	'pto\PtoMovtoController@index',
	'as'	=>	'pto-cdp'
]);
route::get('pto-cdp/crear', [
	'uses' 	=>	'pto\PtoMovtoController@create',
	'as'	=>	'crear-pto-cdp'
]);

route::get('pto-estado/editar/{id}', [
	'uses' 	=>	'pto\PtoMovtoController@edit',
	'as'	=>	'editar-pto-cdp'
])->where(['id' => '[0-9]+']);

route::post('pto-estado/update/{id}', [
	'uses' 	=>	'pto\PtoMovtoController@update',
	'as'	=>	'actualizar-pto-cdp'
])->where(['id' => '[0-9]+']);

route::get('pto-cdp/eliminar', [
	'uses' 	=>	'pto\PtoMovtoController@delete',
	'as'	=>	'eliminar-pto-cdp'
]);
route::get('get-rubros', [
	'uses' 	=>	'pto\PtoMovtoController@getRubros',
	'as'	=>	'get-rubros'
]);

/*Incripciones route*/
Route::get('pacientes', [
	'uses' 	=>	'PacientesController@index',
	'as'	=>	'pacientes'
]);

route::get('pacientes/crear', [
	'uses' 	=>	'PacientesController@create',
	'as'	=>	'crear-pacientes'
]);

route::post('pacientes/crear', [
	'uses' 	=>	'PacientesController@store',
	'as'	=>	'crear-paciente'
]);

route::get('pacientes/editar/{id}', [
	'uses' 	=>	'PacientesController@edit',
	'as'	=>	'editar-paciente'
])->where(['id' => '[0-9]+']);

route::get('pacientes/eliminar/{id}', [
	'uses' 	=>	'PacientesController@destroy',
	'as'	=>	'eliminar-paciente'
]);

route::post('pacientes/editar/{id}', [
	'uses' 	=>	'PacientesController@update',
	'as'	=>	'editar-paciente'
])->where(['id' => '[0-9]+']);

route::post('municipios', [
	'uses' 	=>	'PacientesController@get_municipios',
	'as'	=>	'municipios'
]);

route::post('calcularedad', [
	'uses' 	=>	'PacientesController@calcularedad',
	'as'	=>	'calcularedad'
]);

/*Fin de la ruta Inscripcion Controller*/

Route::get('tipodocumentos', [
	'uses' 	=>	'TipoDocumentosController@index',
	'as'	=>	'tipodocumentos'
]);

route::get('tipodocumentos/crear', [
	'uses' 	=>	'TipoDocumentosController@create',
	'as'	=>	'crear-tipodocumento'
]);

route::post('tipodocumentos/crear', [
	'uses' 	=>	'TipoDocumentosController@store',
	'as'	=>	'crear-tipodocumento'
]);

route::get('tipodocumentos/editar/{id}', [
	'uses' 	=>	'TipoDocumentosController@edit',
	'as'	=>	'editar-tipodocumento'
])->where(['id' => '[0-9]+']);

route::post('tipodocumentos/editar/{id}', [
	'uses' 	=>	'TipoDocumentosController@update',
	'as'	=>	'editar-tipodocumento'
])->where(['id' => '[0-9]+']);

route::get('tipodocumentos/eliminar/{id}', [
	'uses' 	=>	'TipoDocumentosController@destroy',
	'as'	=>	'eliminar-tipodocumento'
]);

Route::get('sexos', [
	'uses' 	=>	'SexoController@index',
	'as'	=>	'sexos'
]);

route::get('sexos/crear', [
	'uses' 	=>	'SexoController@create',
	'as'	=>	'crear-sexo'
]);

route::post('sexos/crear', [
	'uses' 	=>	'SexoController@store',
	'as'	=>	'crear-sexo'
]);

route::get('sexos/editar/{id}', [
	'uses' 	=>	'SexoController@edit',
	'as'	=>	'editar-sexo'
])->where(['id' => '[0-9]+']);

route::post('sexos/editar/{id}', [
	'uses' 	=>	'SexoController@update',
	'as'	=>	'editar-sexo'
])->where(['id' => '[0-9]+']);

route::get('sexos/eliminar/{id}', [
	'uses' 	=>	'SexoController@destroy',
	'as'	=>	'eliminar-sexo'
]);

Route::get('gruposanguinios', [
	'uses' 	=>	'GrupoSanguinioController@index',
	'as'	=>	'gruposanguinios'
]);

route::get('gruposanguinio/crear', [
	'uses' 	=>	'GrupoSanguinioController@create',
	'as'	=>	'crear-gruposanguinio'
]);

route::post('gruposanguinio/crear', [
	'uses' 	=>	'GrupoSanguinioController@store',
	'as'	=>	'crear-gruposanguinio'
]);

route::get('gruposanguinio/editar/{id}', [
	'uses' 	=>	'GrupoSanguinioController@edit',
	'as'	=>	'editar-gruposanguinio'
])->where(['id' => '[0-9]+']);

route::post('gruposanguinio/editar/{id}', [
	'uses' 	=>	'GrupoSanguinioController@update',
	'as'	=>	'editar-sexo'
])->where(['id' => '[0-9]+']);

route::get('gruposanguinio/eliminar/{id}', [
	'uses' 	=>	'GrupoSanguinioController@destroy',
	'as'	=>	'eliminar-gruposanguinio'
]);

Route::get('estadociviles', [
	'uses' 	=>	'EstadoCivilController@index',
	'as'	=>	'estadociviles'
]);

route::get('estadociviles/crear', [
	'uses' 	=>	'EstadoCivilController@create',
	'as'	=>	'crear-estadocivil'
]);

route::post('estadociviles/crear', [
	'uses' 	=>	'EstadoCivilController@store',
	'as'	=>	'crear-estadocivil'
]);

route::get('estadociviles/editar/{id}', [
	'uses' 	=>	'EstadoCivilController@edit',
	'as'	=>	'editar-estadocivil'
])->where(['id' => '[0-9]+']);

route::post('estadociviles/editar/{id}', [
	'uses' 	=>	'EstadoCivilController@update',
	'as'	=>	'editar-estadocivil'
])->where(['id' => '[0-9]+']);

route::get('estadociviles/eliminar/{id}', [
	'uses' 	=>	'EstadoCivilController@destroy',
	'as'	=>	'eliminar-estadocivil'
]);

Route::get('ocupaciones', [
	'uses' 	=>	'ocupacionController@index',
	'as'	=>	'ocupaciones'
]);

route::get('ocupaciones/crear', [
	'uses' 	=>	'ocupacionController@create',
	'as'	=>	'crear-ocupacion'
]);

route::post('ocupaciones/crear', [
	'uses' 	=>	'ocupacionController@store',
	'as'	=>	'crear-ocupacion'
]);

route::get('ocupaciones/editar/{id}', [
	'uses' 	=>	'ocupacionController@edit',
	'as'	=>	'editar-ocupacion'
])->where(['id' => '[0-9]+']);

route::post('ocupaciones/editar/{id}', [
	'uses' 	=>	'ocupacionController@update',
	'as'	=>	'editar-ocupacion'
])->where(['id' => '[0-9]+']);

route::get('ocupaciones/eliminar/{id}', [
	'uses' 	=>	'ocupacionController@destroy',
	'as'	=>	'eliminar-ocupacion'
]);

Route::get('religiones', [
	'uses' 	=>	'religionController@index',
	'as'	=>	'religiones'
]);

route::get('religiones/crear', [
	'uses' 	=>	'religionController@create',
	'as'	=>	'crear-religion'
]);

route::post('religiones/crear', [
	'uses' 	=>	'religionController@store',
	'as'	=>	'crear-religion'
]);

route::get('religiones/editar/{id}', [
	'uses' 	=>	'religionController@edit',
	'as'	=>	'editar-religion'
])->where(['id' => '[0-9]+']);

route::post('religiones/editar/{id}', [
	'uses' 	=>	'religionController@update',
	'as'	=>	'editar-religion'
])->where(['id' => '[0-9]+']);

route::get('religiones/eliminar/{id}', [
	'uses' 	=>	'religionController@destroy',
	'as'	=>	'eliminar-religion'
]);

Route::get('departamentos', [
	'uses' 	=>	'departamentoController@index',
	'as'	=>	'departamentos'
]);

route::get('departamentos/crear', [
	'uses' 	=>	'departamentoController@create',
	'as'	=>	'crear-departamento'
]);

route::post('departamentos/crear', [
	'uses' 	=>	'departamentoController@store',
	'as'	=>	'crear-departamento'
]);

route::get('departamentos/editar/{id}', [
	'uses' 	=>	'departamentoController@edit',
	'as'	=>	'editar-departamento'
])->where(['id' => '[0-9]+']);

route::post('departamentos/editar/{id}', [
	'uses' 	=>	'departamentoController@update',
	'as'	=>	'editar-departamento'
])->where(['id' => '[0-9]+']);

route::get('departamentos/eliminar/{id}', [
	'uses' 	=>	'departamentoController@destroy',
	'as'	=>	'eliminar-departamento'
]);

route::get('municipios', [
	'uses' 	=>	'MunicipioController@index',
	'as'	=>	'municipios'
]);

route::get('municipios/crear', [
	'uses' 	=>	'MunicipioController@create',
	'as'	=>	'crear-municipio'
]);

route::post('municipios/crear', [
	'uses' 	=>	'MunicipioController@store',
	'as'	=>	'crear-municipio'
]);

route::get('municipios/editar/{id}', [
	'uses' 	=>	'MunicipioController@edit',
	'as'	=>	'editar-municipio'
])->where(['id' => '[0-9]+']);

route::post('municipios/editar/{id}', [
	'uses' 	=>	'MunicipioController@update',
	'as'	=>	'editar-municipio'
])->where(['id' => '[0-9]+']);

route::get('municipios/eliminar/{id}', [
	'uses' 	=>	'MunicipioController@destroy',
	'as'	=>	'eliminar-municipio'
]);

route::get('barrios', [
	'uses' 	=>	'BarrioController@index',
	'as'	=>	'barrios'
]);

route::get('barrios/crear', [
	'uses' 	=>	'BarrioController@create',
	'as'	=>	'crear-barrio'
]);

route::post('barrios/crear', [
	'uses' 	=>	'BarrioController@store',
	'as'	=>	'crear-barrio'
]);

route::get('barrios/editar/{id}', [
	'uses' 	=>	'BarrioController@edit',
	'as'	=>	'editar-barrio'
])->where(['id' => '[0-9]+']);

route::post('barrios/editar/{id}', [
	'uses' 	=>	'BarrioController@update',
	'as'	=>	'editar-barrio'
])->where(['id' => '[0-9]+']);

route::get('barrios/eliminar/{id}', [
	'uses' 	=>	'BarrioController@destroy',
	'as'	=>	'eliminar-barrio'
]);

route::get('zonaresidenciales', [
	'uses' 	=>	'ZonaResidencialController@index',
	'as'	=>	'zonaresidenciales'
]);

route::get('zonaresidenciales/crear', [
	'uses' 	=>	'ZonaResidencialController@create',
	'as'	=>	'crear-zonaresidencial'
]);

route::post('zonaresidenciales/crear', [
	'uses' 	=>	'ZonaResidencialController@store',
	'as'	=>	'crear-zonaresidencial'
]);

route::get('zonaresidenciales/editar/{id}', [
	'uses' 	=>	'ZonaResidencialController@edit',
	'as'	=>	'editar-zonaresidencial'
])->where(['id' => '[0-9]+']);

route::post('zonaresidenciales/editar/{id}', [
	'uses' 	=>	'ZonaResidencialController@update',
	'as'	=>	'editar-zonaresidencial'
])->where(['id' => '[0-9]+']);

route::get('zonaresidenciales/eliminar/{id}', [
	'uses' 	=>	'ZonaResidencialController@destroy',
	'as'	=>	'eliminar-zonaresidencial'
]);

route::get('instituciones', [
	'uses' 	=>	'InstitucionesController@index',
	'as'	=>	'instituciones'
]);

route::get('instituciones/crear', [
	'uses' 	=>	'InstitucionesController@create',
	'as'	=>	'crear-institucion'
]);

route::post('instituciones/crear', [
	'uses' 	=>	'InstitucionesController@store',
	'as'	=>	'crear-institucion'
]);

route::get('instituciones/editar/{id}', [
	'uses' 	=>	'InstitucionesController@edit',
	'as'	=>	'editar-institucion'
])->where(['id' => '[0-9]+']);

route::post('instituciones/editar/{id}', [
	'uses' 	=>	'InstitucionesController@update',
	'as'	=>	'editar-institucion'
])->where(['id' => '[0-9]+']);

route::get('instituciones/eliminar/{id}', [
	'uses' 	=>	'InstitucionesController@destroy',
	'as'	=>	'eliminar-institucion'
]);

route::get('regimen', [
	'uses' 	=>	'RegimenController@index',
	'as'	=>	'regimen'
]);

route::get('regimen/crear', [
	'uses' 	=>	'RegimenController@create',
	'as'	=>	'crear-regimen'
]);

route::post('regimen/crear', [
	'uses' 	=>	'RegimenController@store',
	'as'	=>	'crear-regimen'
]);

route::get('regimen/editar/{id}', [
	'uses' 	=>	'RegimenController@edit',
	'as'	=>	'editar-regimen'
])->where(['id' => '[0-9]+']);

route::post('regimen/editar/{id}', [
	'uses' 	=>	'RegimenController@update',
	'as'	=>	'editar-regimen'
])->where(['id' => '[0-9]+']);

route::get('regimen/eliminar/{id}', [
	'uses' 	=>	'RegimenController@destroy',
	'as'	=>	'eliminar-regimen'
]);

route::get('tipoafiliaciones', [
	'uses' 	=>	'TipoAfiliacionController@index',
	'as'	=>	'tipoafiliaciones'
]);

route::get('tipoafiliaciones/crear', [
	'uses' 	=>	'TipoAfiliacionController@create',
	'as'	=>	'crear-tipoafiliacion'
]);

route::post('tipoafiliaciones/crear', [
	'uses' 	=>	'TipoAfiliacionController@store',
	'as'	=>	'crear-tipoafiliacion'
]);

route::get('tipoafiliaciones/editar/{id}', [
	'uses' 	=>	'TipoAfiliacionController@edit',
	'as'	=>	'editar-tipoafiliacion'
])->where(['id' => '[0-9]+']);

route::post('tipoafiliaciones/editar/{id}', [
	'uses' 	=>	'TipoAfiliacionController@update',
	'as'	=>	'editar-tipoafiliacion'
])->where(['id' => '[0-9]+']);

route::get('tipoafiliaciones/eliminar/{id}', [
	'uses' 	=>	'TipoAfiliacionController@destroy',
	'as'	=>	'eliminar-tipoafiliacion'
]);

route::get('niveles', [
	'uses' 	=>	'NivelController@index',
	'as'	=>	'niveles'
]);

route::get('niveles/crear', [
	'uses' 	=>	'NivelController@create',
	'as'	=>	'crear-nivel'
]);

route::post('niveles/crear', [
	'uses' 	=>	'NivelController@store',
	'as'	=>	'crear-nivel'
]);

route::get('niveles/editar/{id}', [
	'uses' 	=>	'NivelController@edit',
	'as'	=>	'editar-nivel'
])->where(['id' => '[0-9]+']);

route::post('niveles/editar/{id}', [
	'uses' 	=>	'NivelController@update',
	'as'	=>	'editar-nivel'
])->where(['id' => '[0-9]+']);

route::get('niveles/eliminar/{id}', [
	'uses' 	=>	'NivelController@destroy',
	'as'	=>	'eliminar-nivel'
]);


route::get('tipoatenciones', [
	'uses' 	=>	'TipoAtencionController@index',
	'as'	=>	'tipoatenciones'
]);

route::get('tipoatenciones/crear', [
	'uses' 	=>	'TipoAtencionController@create',
	'as'	=>	'crear-tipoatencion'
]);

route::post('tipoatenciones/crear', [
	'uses' 	=>	'TipoAtencionController@store',
	'as'	=>	'crear-tipoatencion'
]);

route::get('tipoatenciones/editar/{id}', [
	'uses' 	=>	'TipoAtencionController@edit',
	'as'	=>	'editar-tipoatencion'
])->where(['id' => '[0-9]+']);

route::post('tipoatenciones/editar/{id}', [
	'uses' 	=>	'TipoAtencionController@update',
	'as'	=>	'editar-tipoatencion'
])->where(['id' => '[0-9]+']);

route::get('tipoatenciones/eliminar/{id}', [
	'uses' 	=>	'TipoAtencionController@destroy',
	'as'	=>	'eliminar-tipoatencion'
]);


route::get('viaingresos', [
	'uses' 	=>	'ViaIngresoController@index',
	'as'	=>	'viaingresos'
]);

route::get('viaingresos/crear', [
	'uses' 	=>	'ViaIngresoController@create',
	'as'	=>	'crear-viaingreso'
]);

route::post('viaingresos/crear', [
	'uses' 	=>	'ViaIngresoController@store',
	'as'	=>	'crear-viaingreso'
]);

route::get('viaingresos/editar/{id}', [
	'uses' 	=>	'ViaIngresoController@edit',
	'as'	=>	'editar-viaingreso'
])->where(['id' => '[0-9]+']);

route::post('viaingresos/editar/{id}', [
	'uses' 	=>	'ViaIngresoController@update',
	'as'	=>	'editar-viaingreso'
])->where(['id' => '[0-9]+']);

route::get('viaingresos/eliminar/{id}', [
	'uses' 	=>	'ViaIngresoController@destroy',
	'as'	=>	'eliminar-viaingreso'
]);


route::get('origenatenciones', [
	'uses' 	=>	'OrigenAtencionController@index',
	'as'	=>	'origenatenciones'
]);

route::get('origenatenciones/crear', [
	'uses' 	=>	'OrigenAtencionController@create',
	'as'	=>	'crear-origenatencion'
]);

route::post('origenatenciones/crear', [
	'uses' 	=>	'OrigenAtencionController@store',
	'as'	=>	'crear-origenatencion'
]);

route::get('origenatenciones/editar/{id}', [
	'uses' 	=>	'OrigenAtencionController@edit',
	'as'	=>	'editar-origenatencion'
])->where(['id' => '[0-9]+']);

route::post('origenatenciones/editar/{id}', [
	'uses' 	=>	'OrigenAtencionController@update',
	'as'	=>	'editar-origenatencion'
])->where(['id' => '[0-9]+']);

route::get('origenatenciones/eliminar/{id}', [
	'uses' 	=>	'OrigenAtencionController@destroy',
	'as'	=>	'eliminar-origenatencion'
]);

route::get('ingresopacientes', [
	'uses' 	=>	'IngresoPacienteController@index',
	'as'	=>	'ingresopacientes'
]);

route::get('ingresopacientes/crear', [
	'uses' 	=>	'IngresoPacienteController@create',
	'as'	=>	'crear-ingresopaciente'
]);

route::post('ingresopacientes/crear', [
	'uses' 	=>	'IngresoPacienteController@store',
	'as'	=>	'crear-ingresopaciente'
]);

route::get('ingresopacientes/editar/{id}', [
	'uses' 	=>	'IngresoPacienteController@edit',
	'as'	=>	'editar-ingresopaciente'
])->where(['id' => '[0-9]+']);

route::post('ingresopacientes/editar/{id}', [
	'uses' 	=>	'IngresoPacienteController@update',
	'as'	=>	'editar-ingresopaciente'
])->where(['id' => '[0-9]+']);

route::get('ingresopacientes/eliminar/{id}', [
	'uses' 	=>	'IngresoPacienteController@destroy',
	'as'	=>	'eliminar-ingresopaciente'
]);

route::get('procedimientos', [
	'uses' 	=>	'ProcedimientoController@index',
	'as'	=>	'procedimientos'
]);

route::get('crear-procedimiento', [
	'uses' 	=>	'ProcedimientoController@create',
	'as'	=>	'crear-procedimiento'
]);

route::post('crear-procedimiento', [
	'uses' 	=>	'ProcedimientoController@store',
	'as'	=>	'crear-procedimiento'
]);

route::get('editar-procedimiento/{id}', [
	'uses' 	=>	'ProcedimientoController@edit',
	'as'	=>	'editar-procedimiento'
])->where(['id' => '[0-9]+']);

route::post('editar-procedimiento/{id}', [
	'uses' 	=>	'ProcedimientoController@update',
	'as'	=>	'editar-procedimiento'
])->where(['id' => '[0-9]+']);

route::get('eliminar-procedimiento/{id}', [
	'uses' 	=>	'ProcedimientoController@destroy',
	'as'	=>	'eliminar-procedimiento'
]);

route::get('diagnosticos', [
	'uses' 	=>	'DiagnosticoController@index',
	'as'	=>	'diagnosticos'
]);

route::get('crear-diagnostico', [
	'uses' 	=>	'DiagnosticoController@create',
	'as'	=>	'crear-diagnostico'
]);

route::post('crear-diagnostico', [
	'uses' 	=>	'DiagnosticoController@store',
	'as'	=>	'crear-diagnostico'
]);

route::get('editar-diagnostico/{id}', [
	'uses' 	=>	'DiagnosticoController@edit',
	'as'	=>	'editar-diagnostico'
])->where(['id' => '[0-9]+']);

route::post('editar-diagnostico/{id}', [
	'uses' 	=>	'DiagnosticoController@update',
	'as'	=>	'editar-diagnostico'
])->where(['id' => '[0-9]+']);

route::get('eliminar-diagnostico/{id}', [
	'uses' 	=>	'DiagnosticoController@destroy',
	'as'	=>	'eliminar-diagnostico'
]);

route::get('tipodiagnosticos', [
	'uses' 	=>	'TipoDiagnosticoController@index',
	'as'	=>	'tipodiagnosticos'
]);

route::get('crear-tipodiagnostico', [
	'uses' 	=>	'TipoDiagnosticoController@create',
	'as'	=>	'crear-tipodiagnostico'
]);

route::post('crear-tipodiagnostico', [
	'uses' 	=>	'TipoDiagnosticoController@store',
	'as'	=>	'crear-tipodiagnostico'
]);

route::get('editar-tipodiagnostico/{id}', [
	'uses' 	=>	'TipoDiagnosticoController@edit',
	'as'	=>	'editar-tipodiagnostico'
])->where(['id' => '[0-9]+']);

route::post('editar-tipodiagnostico/{id}', [
	'uses' 	=>	'TipoDiagnosticoController@update',
	'as'	=>	'editar-tipodiagnostico'
])->where(['id' => '[0-9]+']);

route::get('eliminar-tipodiagnostico/{id}', [
	'uses' 	=>	'TipoDiagnosticoController@destroy',
	'as'	=>	'eliminar-tipodiagnostico'
]);

route::get('diagnosticoalts', [
	'uses' 	=>	'DiagnosticoAltController@index',
	'as'	=>	'diagnosticoalts'
]);

route::get('crear-diagnosticoalt', [
	'uses' 	=>	'DiagnosticoAltController@create',
	'as'	=>	'crear-diagnosticoalt'
]);

route::post('crear-diagnosticoalt', [
	'uses' 	=>	'DiagnosticoAltController@store',
	'as'	=>	'crear-diagnosticoalt'
]);

route::get('editar-diagnosticoalt/{id}', [
	'uses' 	=>	'DiagnosticoAltController@edit',
	'as'	=>	'editar-diagnosticoalt'
])->where(['id' => '[0-9]+']);

route::post('editar-diagnosticoalt/{id}', [
	'uses' 	=>	'DiagnosticoAltController@update',
	'as'	=>	'editar-diagnosticoalt'
])->where(['id' => '[0-9]+']);

route::get('eliminar-diagnosticoalt/{id}', [
	'uses' 	=>	'DiagnosticoAltController@destroy',
	'as'	=>	'eliminar-diagnosticoalt'
]);


route::get('etiologias', [
	'uses' 	=>	'EtiologiaController@index',
	'as'	=>	'etiologias'
]);

route::get('crear-etiologia', [
	'uses' 	=>	'EtiologiaController@create',
	'as'	=>	'crear-etiologia'
]);

route::post('crear-etiologia', [
	'uses' 	=>	'EtiologiaController@store',
	'as'	=>	'crear-etiologia'
]);

route::get('editar-etiologia/{id}', [
	'uses' 	=>	'EtiologiaController@edit',
	'as'	=>	'editar-etiologia'
])->where(['id' => '[0-9]+']);

route::post('editar-etiologia/{id}', [
	'uses' 	=>	'EtiologiaController@update',
	'as'	=>	'editar-etiologia'
])->where(['id' => '[0-9]+']);

route::get('eliminar-etiologia/{id}', [
	'uses' 	=>	'EtiologiaController@destroy',
	'as'	=>	'eliminar-etiologia'
]);

route::get('getantecedentes', [
	'uses' 	=>	'antecedenteController@index',
	'as'	=>	'getantecedentes'
]);

route::get('crear-getantecedente', [
	'uses' 	=>	'antecedenteController@create',
	'as'	=>	'crear-getantecedente'
]);

route::post('crear-getantecedente', [
	'uses' 	=>	'antecedenteController@store',
	'as'	=>	'crear-getantecedente'
]);

route::get('editar-getantecedente/{id}', [
	'uses' 	=>	'antecedenteController@edit',
	'as'	=>	'editar-getantecedente'
])->where(['id' => '[0-9]+']);

route::post('editar-getantecedente/{id}', [
	'uses' 	=>	'antecedenteController@update',
	'as'	=>	'editar-getantecedente'
])->where(['id' => '[0-9]+']);

route::get('eliminar-getantecedente/{id}', [
	'uses' 	=>	'antecedenteController@destroy',
	'as'	=>	'eliminar-getantecedente'
]);

route::get('tipoantecedentes', [
	'uses' 	=>	'TipoAntecedenteController@index',
	'as'	=>	'tipoantecedentes'
]);

route::get('crear-tipoantecedente', [
	'uses' 	=>	'TipoAntecedenteController@create',
	'as'	=>	'crear-tipoantecedente'
]);

route::post('crear-tipoantecedente', [
	'uses' 	=>	'TipoAntecedenteController@store',
	'as'	=>	'crear-tipoantecedente'
]);

route::get('editar-tipoantecedente/{id}', [
	'uses' 	=>	'TipoAntecedenteController@edit',
	'as'	=>	'editar-tipoantecedente'
])->where(['id' => '[0-9]+']);

route::post('editar-tipoantecedente/{id}', [
	'uses' 	=>	'TipoAntecedenteController@update',
	'as'	=>	'editar-tipoantecedente'
])->where(['id' => '[0-9]+']);

route::get('eliminar-tipoantecedente/{id}', [
	'uses' 	=>	'TipoAntecedenteController@destroy',
	'as'	=>	'eliminar-tipoantecedente'
]);

route::get('especialidades', [
	'uses' 	=>	'EspecialidadController@index',
	'as'	=>	'especialidades'
]);

route::get('crear-especialidad', [
	'uses' 	=>	'EspecialidadController@create',
	'as'	=>	'crear-especialidad'
]);

route::post('crear-especialidad', [
	'uses' 	=>	'EspecialidadController@store',
	'as'	=>	'crear-especialidad'
]);

route::get('editar-especialidad/{id}', [
	'uses' 	=>	'EspecialidadController@edit',
	'as'	=>	'editar-especialidad'
])->where(['id' => '[0-9]+']);

route::post('editar-especialidad/{id}', [
	'uses' 	=>	'EspecialidadController@update',
	'as'	=>	'editar-especialidad'
])->where(['id' => '[0-9]+']);

route::get('eliminar-especialidad/{id}', [
	'uses' 	=>	'EspecialidadController@destroy',
	'as'	=>	'eliminar-especialidad'
]);

route::get('tiposervicios', [
	'uses' 	=>	'TipoServicioController@index',
	'as'	=>	'tiposervicios'
]);

route::get('crear-tiposervicio', [
	'uses' 	=>	'TipoServicioController@create',
	'as'	=>	'crear-tiposervicio'
]);

route::post('crear-tiposervicio', [
	'uses' 	=>	'TipoServicioController@store',
	'as'	=>	'crear-tiposervicio'
]);

route::get('editar-tiposervicio/{id}', [
	'uses' 	=>	'TipoServicioController@edit',
	'as'	=>	'editar-tiposervicio'
])->where(['id' => '[0-9]+']);

route::post('editar-tiposervicio/{id}', [
	'uses' 	=>	'TipoServicioController@update',
	'as'	=>	'editar-tiposervicio'
])->where(['id' => '[0-9]+']);

route::get('eliminar-tiposervicio/{id}', [
	'uses' 	=>	'TipoServicioController@destroy',
	'as'	=>	'eliminar-tiposervicio'
]);

route::get('tipoordenes', [
	'uses' 	=>	'TipoOrdenController@index',
	'as'	=>	'tipoordenes'
]);

route::get('crear-tipoorden', [
	'uses' 	=>	'TipoOrdenController@create',
	'as'	=>	'crear-tipoorden'
]);

route::post('crear-tipoorden', [
	'uses' 	=>	'TipoOrdenController@store',
	'as'	=>	'crear-tipoorden'
]);

route::get('editar-tipoorden/{id}', [
	'uses' 	=>	'TipoOrdenController@edit',
	'as'	=>	'editar-tipoorden'
])->where(['id' => '[0-9]+']);

route::post('editar-tipoorden/{id}', [
	'uses' 	=>	'TipoOrdenController@update',
	'as'	=>	'editar-tipoorden'
])->where(['id' => '[0-9]+']);

route::get('eliminar-tipoorden/{id}', [
	'uses' 	=>	'TipoOrdenController@destroy',
	'as'	=>	'eliminar-tipoorden'
]);

route::get('consultaexternas', [
	'uses' 	=>	'ConsultasExternaController@index',
	'as'	=>	'consultaexternas'
]);
route::get('consultaexternas/ver/{id}', [
	'uses' 	=>	'ConsultasExternaController@ver_consultas_paciente',
	'as'	=>	'ver-consulta-paciente'
])->where(['id' => '[0-9]+']);


route::post('admision', [
	'uses' 	=>	'ConsultasExternaController@admision',
	'as'	=>	'admision'
]);

route::post('admisionsubmit', [
	'uses' 	=>	'ConsultasExternaController@admisionsubmit',
	'as'	=>	'admisionsubmit'
]);

route::post('enfermedad', [
	'uses' 	=>	'ConsultasExternaController@enfermedad',
	'as'	=>	'enfermedad'
]);

route::post('enfermedadsubmit', [
	'uses' 	=>	'ConsultasExternaController@enfermedadsubmit',
	'as'	=>	'enfermedadsubmit'
]);

route::post('medicamentosubmit', [
	'uses' 	=>	'ConsultasExternaController@medicamentosubmit',
	'as'	=>	'medicamentosubmit'
]);

route::post('editmedicamentoorden', [
	'uses' 	=>	'ConsultasExternaController@editmedicamentoorden',
	'as'	=>	'editmedicamentoorden'
]);

route::post('ayudadiagsubmit', [
	'uses' 	=>	'ConsultasExternaController@ayudadiagsubmit',
	'as'	=>	'ayudadiagsubmit'
]);

route::post('procedimientosubmit', [
	'uses' 	=>	'ConsultasExternaController@procedimientosubmit',
	'as'	=>	'procedimientosubmit'
]);

route::post('antecedentesubmit', [
	'uses' 	=>	'ConsultasExternaController@antecedentesubmit',
	'as'	=>	'antecedentesubmit'
]);


route::post('antecedentes', [
	'uses' 	=>	'ConsultasExternaController@antecedentes',
	'as'	=>	'antecedentes'
]);

route::post('ayudaddiag', [
	'uses' 	=>	'ConsultasExternaController@ayudaddiag',
	'as'	=>	'ayudaddiag'
]);

route::post('diagnostico', [
	'uses' 	=>	'ConsultasExternaController@diagnostico',
	'as'	=>	'diagnostico'
]);

route::post('diagnosticosubmit', [
	'uses' 	=>	'ConsultasExternaController@diagnosticosubmit',
	'as'	=>	'diagnosticosubmit'
]);

route::post('medicamento', [
	'uses' 	=>	'ConsultasExternaController@medicamento',
	'as'	=>	'medicamento'
]);

route::post('procedimiento', [
	'uses' 	=>	'ConsultasExternaController@procedimiento',
	'as'	=>	'procedimiento'
]);

route::post('incapacidad', [
	'uses' 	=>	'ConsultasExternaController@incapacidad',
	'as'	=>	'incapacidad'
]);

route::post('incapacidadsubmit', [
	'uses' 	=>	'ConsultasExternaController@incapacidadsubmit',
	'as'	=>	'incapacidadsubmit'
]);

route::post('remisionsubmit', [
	'uses' 	=>	'ConsultasExternaController@remisionsubmit',
	'as'	=>	'remisionsubmit'
]);

route::post('mostrarpacientes', [
	'uses' 	=>	'IngresoPacienteController@get_pacientes',
	'as'	=>	'mostrarpacientes'
]);

route::post('mostrardatapacientes', [
	'uses' 	=>	'IngresoPacienteController@get_datapaciente',
	'as'	=>	'mostrardatapacientes'
]);

route::post('mostrarentidades', [
	'uses' 	=>	'IngresoPacienteController@get_entidades',
	'as'	=>	'mostrarentidades'
]);

route::post('mostrarconvenios', [
	'uses' 	=>	'IngresoPacienteController@get_convenios',
	'as'	=>	'mostrarconvenios'
]);

route::post('mostrarregimen', [
	'uses' 	=>	'IngresoPacienteController@get_regimen',
	'as'	=>	'mostrarregimen'
]);

route::post('mostrarafiliacion', [
	'uses' 	=>	'IngresoPacienteController@get_afiliacion',
	'as'	=>	'mostrarafiliacion'
]);

route::post('mostrarnivel', [
	'uses' 	=>	'IngresoPacienteController@get_nivel',
	'as'	=>	'mostrarnivel'
]);

route::post('mostrardepartamentos', [
	'uses' 	=>	'IngresoPacienteController@get_departamentos',
	'as'	=>	'mostrardepartamentos'
]);

route::post('mostrarsexos', [
	'uses' 	=>	'IngresoPacienteController@get_sexos',
	'as'	=>	'mostrarsexos'
]);

route::post('mostrarestadicivil', [
	'uses' 	=>	'IngresoPacienteController@get_estadocivil',
	'as'	=>	'mostrarestadicivil'
]);

route::post('mostrargruposanguinio', [
	'uses' 	=>	'IngresoPacienteController@get_gruposanguinio',
	'as'	=>	'mostrargruposanguinio'
]);

route::post('mostrarreligion', [
	'uses' 	=>	'IngresoPacienteController@get_religion',
	'as'	=>	'mostrarreligion'
]);

route::post('mostrarocupacion', [
	'uses' 	=>	'IngresoPacienteController@get_ocupacion',
	'as'	=>	'mostrarocupacion'
]);

route::post('mostrarbarrios', [
	'uses' 	=>	'IngresoPacienteController@get_barrios',
	'as'	=>	'mostrarbarrios'
]);

route::post('mostrarzonas', [
	'uses' 	=>	'IngresoPacienteController@get_zonas',
	'as'	=>	'mostrarzonas'
]);

route::post('mostrarviasingreso', [
	'uses' 	=>	'IngresoPacienteController@get_viasingreso',
	'as'	=>	'mostrarviasingreso'
]);

route::post('mostrarorigenatencion', [
	'uses' 	=>	'IngresoPacienteController@get_origenatencion',
	'as'	=>	'mostrarorigenatencion'
]);

route::post('mostrartipoatencion', [
	'uses' 	=>	'IngresoPacienteController@get_tipoatencion',
	'as'	=>	'mostrartipoatencion'
]);

route::post('buscarprocedimiento', [
	'uses' 	=>	'ConsultasExternaController@get_procedimientos',
	'as'	=>	'buscarprocedimiento'
]);

route::post('buscardiagnostico', [
	'uses' 	=>	'ConsultasExternaController@get_diagnostico',
	'as'	=>	'buscardiagnostico'
]);

route::post('getmedicamentoconsulta', [
	'uses' 	=>	'ConsultasExternaController@getmedicamentoconsulta',
	'as'	=>	'getmedicamentoconsulta'
]);

route::post('deleteadmision', [
	'uses' 	=>	'ConsultasExternaController@deleteadmision',
	'as'	=>	'deleteadmision'
]);

route::post('getadmisionprocedimiento', [
	'uses' 	=>	'ConsultasExternaController@getadmisionprocedimiento',
	'as'	=>	'getadmisionprocedimiento'
]);

route::post('deleteprocedimiento', [
	'uses' 	=>	'ConsultasExternaController@deleteprocedimiento',
	'as'	=>	'deleteprocedimiento'
]);

route::post('editprocedimiento', [
	'uses' 	=>	'ConsultasExternaController@editprocedimiento',
	'as'	=>	'editprocedimiento'
]);