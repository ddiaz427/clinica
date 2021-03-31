<?php

namespace App\Http\Controllers\glb;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\glb\Modulo;
use App\Models\glb\Grupomodulo;
use Session;


class ModuloController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		\View::share ( 'titulo_pagina', 'Módulos' );
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$modulos = Modulo::all();
    	return view('glb.modulos.index', ['modulos' => $modulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$grupomodulos = Grupomodulo::orderBy('nombre')->get();
        return view('glb.modulos.create', ['grupomodulos' => $grupomodulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$modulo = Modulo::create($request->all());
		Session::flash('flash_message', 'Módulo agregado correctamente!');
		return redirect()->route('editar-modulo', ['id' => $modulo->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$modulo = Modulo::find($id);
		return view('glb.modulos.mostrar', ['modulo' => $modulo->toArray()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$modulo = Modulo::find($id);
		$grupomodulos = Grupomodulo::orderBy('nombre')->get();
		return view('glb.modulos.edit', ['modulo' => $modulo, 'grupomodulos' => $grupomodulos]);
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
		$modulo = Modulo::find($id);
		$modulo->update($request->all());
		Session::flash('flash_message', 'Módulo actualizado correctamente!');
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
		Session::flash('flash_message', 'Modulo eliminada correctamente!');
        $modulo = Modulo::find($id);
		$modulo->delete();
		return redirect()->route('modulos');
    }
}
