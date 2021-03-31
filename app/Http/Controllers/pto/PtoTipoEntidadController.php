<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoRefTipoEntidad;
use Session;
use Input;


class PtoTipoEntidadController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		\View::share ( 'titulo_pagina', 'Tipo entidad' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoentidades = PtoRefTipoEntidad::all();
        return view('pto/maestros/tipo_entidades.index', ['tipoentidades' => $tipoentidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pto/maestros/tipo_entidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = PtoRefTipoEntidad::validate($request->all());
        if ( $v->passes() ) {
        	$tipoentidad = PtoRefTipoEntidad::create($request->all());
	        Session::flash('flash_message', 'Registro agregado correctamente!');
			return redirect()->route('pto-tipo-entidad');
        } else {
        	return redirect()->route('crear-pto-tipo-entidad')->withErrors($v)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tipoentidad = PtoRefTipoEntidad::find($id);
        return view('pto/maestros/tipo_entidades.mostrar', ['tipoentidad' => $tipoentidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoentidad = PtoRefTipoEntidad::find($id);
        return view('pto/maestros/tipo_entidades.edit', ['tipoentidad' => $tipoentidad]);

        
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
        $tipoentidad = PtoRefTipoEntidad::find($id);
        $v = PtoRefTipoEntidad::validate($request->all());
        if ( $v->passes() ) {
			$tipoentidad->update($request->all());
			Session::flash('flash_message', 'Registro actualizado correctamente!');
			return redirect()->back();
        } else {
        	return redirect()->back()->withErrors($v)->withInput();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		Session::flash('flash_message', 'Registro eliminado correctamente!');
        $tipoentidad = PtoRefTipoEntidad::find($id);
		$tipoentidad->delete();
		return redirect()->route('pto-tipo-entidad');
    }
}
