<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoAtencion;

class TipoAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $atencion = TipoAtencion::orderBy('idtipoatencion', 'DESC')->get(); 
        return view('tipoatencion.index', ['tipoatencion' => $atencion, 'titulo' => 'Tipos de Atención', 'titulo_pagina' => 'Listado de Tipos de Atención']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tipoatencion.create', ['titulo' => 'Crear Tipo de Atención', 'titulo_pagina' => 'Crear Tipo de Atención']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoAtencion;
        $data->nombretipoatencion = $request->nombretipoatencion;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Atención agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Atención');
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
        $atencion = TipoAtencion::where('idtipoatencion', $id)->first();
        return view('tipoatencion.edit', ['tipoatencion' => $atencion, 'titulo' => 'Editar Tipo de atención', 'titulo_pagina' => 'Editar Tipo de atención']);
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
        $data = TipoAtencion::where('idtipoatencion', '=', $id)->first();
        $data->nombretipoatencion = $request->nombretipoatencion;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Atención Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Atención');
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
        $data = TipoAtencion::where('idtipoatencion', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Atención Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Atención!');
           return redirect()->back();
        }   
    }
}
