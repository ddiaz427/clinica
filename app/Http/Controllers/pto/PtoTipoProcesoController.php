<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoRefTipoProceso;
use Session;
use Input;

class PtoTipoProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //parent::__construct();
        \View::share ( 'titulo_pagina', 'Tipo Proceso' );
    }
    
    public function index()
    {
        $tipoProceso = PtoRefTipoProceso::all();
        //dd($tipoProceso);
        return view('pto/maestros/tipo_procesos.index', ['tipoproceso' => $tipoProceso]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $tipoProceso = PtoRefTipoProceso::all();
        return view('pto/maestros/tipo_procesos.create', ['tipoproceso' => $tipoProceso]);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
/*
        $tipoProceso = PtoRefTipoProceso::create($request->all());
        Session::flash('flash_message', 'Transaccion agregada correctamente!');
        //return redirect('/PtoTipoProceso/');
        return redirect()->route('editar-tipo', ['id' => $tipoProceso->pk_id_tipo_proceso]);
*/
         $v = PtoRefTipoProceso::validate($request->all());
        if ( $v->passes() ) {
            $tipoentidad = PtoRefTipoProceso::create($request->all());
            Session::flash('flash_message', 'Registro agregado correctamente!');
            return redirect()->route('tipoProceso');
        } else {
            return redirect()->route('crear-tipo')->withErrors($v)->withInput();
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

        $tipoProceso = PtoRefTipoProceso::find($id);
        return view('pto/maestros/tipo_procesos.mostrar', ['tipoproceso' => $tipoProceso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoProceso = PtoRefTipoProceso::find($id);
        return view('pto/maestros/tipo_procesos.edit', ['tipoproceso' => $tipoProceso]);

        
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
        $tipoProceso = PtoRefTipoProceso::find($id);
        $tipoProceso->update($request->all());
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
        Session::flash('flash_message', 'Registro eliminado correctamente!');
        $tipoProceso = PtoRefTipoProceso::find($id);
        $tipoProceso->delete();
        return redirect()->route('tipoProceso');
    }
}
