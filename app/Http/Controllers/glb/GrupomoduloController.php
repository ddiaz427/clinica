<?php

namespace App\Http\Controllers\glb;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\glb\Grupomodulo;
use Session;


class GrupomoduloController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		\View::share ( 'titulo_pagina', 'Grupomodulos' );
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$grupomodulos = Grupomodulo::all();
    	return view('glb.grupomodulos.index', ['grupomodulos' => $grupomodulos->toArray()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('glb.grupomodulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$grupomodulo = Grupomodulo::create($request->all());
		Session::flash('flash_message', 'Grupo agregado correctamente!');
		return redirect()->route('editar-grupomodulo', ['id' => $grupomodulo->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$grupomodulo = Grupomodulo::find($id);
		return view('glb.grupomodulos.mostrar', ['grupomodulo' => $grupomodulo->toArray()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$grupomodulo = Grupomodulo::find($id);
		return view('glb.grupomodulos.edit', ['grupomodulo' => $grupomodulo]);
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
		$grupomodulo = Grupomodulo::find($id);
		$grupomodulo->update($request->all());
		Session::flash('flash_message', 'Grupo actualizado correctamente!');
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
		Session::flash('flash_message', 'Grupo eliminado correctamente!');
        $grupomodulo = Grupomodulo::find($id);
		$grupomodulo->delete();
		return redirect()->route('grupomodulos');
    }
}
