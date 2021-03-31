<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoRefTipoMov;
use Session;
use Input;

class PtoTiposMovController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		//parent::__construct();
		\View::share ( 'titulo_pagina', 'Tipo Movimiento' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipomov = PtoRefTipoMov::all();
        return view('pto/maestros/tipo_mov.index', ['tipomov' => $tipomov]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pto/maestros/tipo_mov.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = PtoRefTipoMov::validate($request->all());
        if ( $v->passes() ) {
        	$tipomov = PtoRefTipoMov::create($request->all());
	        Session::flash('flash_message', 'Registro agregado correctamente!');
			return redirect()->route('pto-tipo-mov');
        } else {
        	return redirect()->route('crear-pto-tipo-mov')->withErrors($v)->withInput();
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

        $tipomov = PtoRefTipoMov::find($id);
        return view('pto/maestros/tipo_mov.mostrar', ['tipomov' => $tipomov]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomov = PtoRefTipoMov::find($id);
        return view('pto/maestros/tipo_mov.edit', ['tipomov' => $tipomov]);

        
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
        $tipomov = PtoRefTipoMov::find($id);
        $v = PtoRefTipoMov::validate($request->all());
        if ( $v->passes() ) {
			$tipomov->update($request->all());
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
        $tipomov = PtoRefTipoMov::find($id);
		$tipomov->delete();
		return redirect()->route('pto-tipo-mov');
    }
}
