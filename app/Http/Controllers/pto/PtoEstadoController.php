<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoRefEstado;
use Session;
use Input;


class PtoEstadoController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		\View::share ( 'titulo_pagina', 'Estado' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = PtoRefEstado::all();
        return view('pto/maestros/estados.index', ['estados' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pto/maestros/estados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = PtoRefEstado::validate($request->all());
        if ( $v->passes() ) {
        	$estados = PtoRefEstado::create($request->all());
	        Session::flash('flash_message', 'Registro agregado correctamente!');
			return redirect()->route('pto-estado');
        } else {
        	return redirect()->route('crear-pto-estado')->withErrors($v)->withInput();
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

        $estado = PtoRefEstado::find($id);
        return view('pto/maestros/estados.mostrar', ['estado' => $estado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = PtoRefEstado::find($id);
        return view('pto/maestros/estados.edit', ['estado' => $estado]);

        
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
        $estado = PtoRefEstado::find($id);
        $v = PtoRefEstado::validate($request->all());
        if ( $v->passes() ) {
			$estado->update($request->all());
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
        $estado = PtoRefEstado::find($id);
		$estado->delete();
		return redirect()->route('pto-estado');
    }
}
