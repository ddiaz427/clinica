<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoAfiliacion;

class TipoAfiliacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $afiliacion = TipoAfiliacion::orderBy('idtipoafiliacion', 'DESC')->get(); 
        return view('tiposafiliacion.index', ['afiliacion' => $afiliacion, 'titulo' => 'Tipos de Afiliación', 'titulo_pagina' => 'Tipos de Afiliación']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tiposafiliacion.create', ['titulo' => 'Crear Tipo de Afiliación', 'titulo_pagina' => 'Crear Tipos de Afiliación']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoAfiliacion;
        $data->nombretipoafiliacion = $request->nombretipoafiliacion;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Afiliación agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Afiliación');
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
        $afiliacion = TipoAfiliacion::where('idtipoafiliacion', $id)->first();
        return view('tiposafiliacion.edit', ['afiliacion' => $afiliacion, 'titulo' => 'Editar Tipo de Afiliación'.$afiliacion->nombretipoafiliacion, 'titulo_pagina' => 'Editar Tipo de Afiliación']);
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
        $data = TipoAfiliacion::where('idtipoafiliacion', '=', $id)->first();
        $data->nombretipoafiliacion = $request->nombretipoafiliacion;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Afiliación Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Afiliación');
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
        $data = TipoAfiliacion::where('idtipoafiliacion', '=', $id)->first();
        $afiliacion = $data->nombretipoafiliacion;
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Afiliación '.$afiliacion.' Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Afiliación!');
           return redirect()->back();
        }   
    }
}
