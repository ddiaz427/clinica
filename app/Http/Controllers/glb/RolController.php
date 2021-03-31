<?php
namespace App\Http\Controllers\glb;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\glb\Rol;
use App\Models\glb\Modulo;
use App\Models\glb\RolModulo;
use Session;


class RolController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		\View::share ( 'titulo_pagina', 'Roles' );
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$roles = Rol::all();
    	return view('glb.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$modulos = Modulo::orderBy('desc_modulo')->get();
        return view('glb.roles.create', ['modulos' => $modulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$data = $request->all();
		$rol = Rol::create($data);
		$permisos = $data['modulos'];
		if(!empty($permisos)){
			foreach($permisos as $key => $valor){
				$data_permisos = array(
					'rol_id' => $rol->id,
					'modulo_id' => $key,
					'modificar' => ((isset($valor['modificar']))?$valor['modificar']:0),
					'consultar' => ((isset($valor['consultar']))?$valor['consultar']:0),
					'agregar' => ((isset($valor['agregar']))?$valor['agregar']:0),
					'eliminar' => ((isset($valor['eliminar']))?$valor['eliminar']:0),
				);
				RolModulo::create($data_permisos);
				unset($data_permisos);
			}
		}

		Session::flash('flash_message', 'Rol agregado correctamente!');
		return redirect()->route('editar-rol', ['id' => $rol->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$rol = Rol::find($id);
		return view('glb.roles.mostrar', ['rol' => $rol->toArray()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$modulos = Modulo::orderBy('desc_modulo')->get();
		$rol_modulos = RolModulo::where('rol_id', $id)->get()->toArray();
		$permisos = array();
		if(!empty($rol_modulos)){
			foreach($rol_modulos as $per){
				$permisos[$per['rol_id']][$per['modulo_id']]['consultar'] = $per['consultar'];
				$permisos[$per['rol_id']][$per['modulo_id']]['modificar'] = $per['modificar'];
				$permisos[$per['rol_id']][$per['modulo_id']]['agregar'] = $per['agregar'];
				$permisos[$per['rol_id']][$per['modulo_id']]['eliminar'] = $per['eliminar'];
			}
		}
		$rol = Rol::find($id);
		return view('glb.roles.edit', ['rol' => $rol, 'modulos' => $modulos, 'permisos' => $permisos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$rol = Rol::find($id);
		$data = $request->all();
		$rol->update($data);
		$rol_modulos = RolModulo::where('rol_id', $id)->delete();
		$permisos = $data['modulos'];
		if(!empty($permisos)){
			foreach($permisos as $key => $valor){
				$data_permisos = array(
					'rol_id' => $rol->id,
					'modulo_id' => $key,
					'modificar' => ((isset($valor['modificar']))?$valor['modificar']:0),
					'consultar' => ((isset($valor['consultar']))?$valor['consultar']:0),
					'agregar' => ((isset($valor['agregar']))?$valor['agregar']:0),
					'eliminar' => ((isset($valor['eliminar']))?$valor['eliminar']:0),
				);
				RolModulo::create($data_permisos);
				unset($data_permisos);
			}
		}
		Session::flash('flash_message', 'Rol actualizado correctamente!');
		return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		Session::flash('flash_message', 'Rol eliminada correctamente!');
		$rol_modulos = RolModulo::where('rol_id', $id)->delete();
        $rol = Rol::find($id);
		$rol->delete();
		return redirect()->route('roles');
    }
}
