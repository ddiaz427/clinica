<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoOrden;

class TipoOrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipoorden = TipoOrden::orderBy('idtipoorden', 'DESC')->get(); 
        return view('tipoorden.index', ['tipoorden' => $tipoorden, 'titulo' => 'Listado', 'titulo_pagina' => 'Tipo de Orden']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tipoorden.create', ['titulo' => 'Formulario de Crear', 'titulo_pagina' => 'Crear Tipo de Orden']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoOrden;
        $data->nombretipoorden = $request->nombretipoorden;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Orden agregada correctamente!');
            return redirect()->back();
        }else{

            Session::flash('flash_message', 'Error al guardar el Tipo de Orden');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($id)
    {
        //
    }
    */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $tipoorden = TipoOrden::where('idtipoorden', $id)->first();
        return view('tipoorden.edit', ['tipoorden' => $tipoorden, 'titulo' => 'Formulario para Editar Datos', 'titulo_pagina' => 'Editar Tipo de Orden']);
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
        $data = TipoOrden::where('idtipoorden', '=', $id)->first();
        $data->nombretipoorden = $request->nombretipoorden;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {

            Session::flash('flash_message', 'Tipo de Orden Editado correctamente!');
            return redirect()->back();

        }else{

            Session::flash('flash_message', 'Error al Editar el Tipo de Orden');
            return redirect()->back();
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
        $data = TipoOrden::where('idtipoorden', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Orden Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Orden!');
           return redirect()->back();
        }   
    }
}
