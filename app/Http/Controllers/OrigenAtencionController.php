<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Municipios;
use App\Models\OrigenAtencion;

class OrigenAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $origenatencion = OrigenAtencion::orderBy('idorigenatencion', 'DESC')->get();
        //echo "<pre>";
        //print_r($municipio);
        
        return view('origenatencion.index', ['origenatencion' => $origenatencion, 'titulo' => 'Origen de Atención', 'titulo_pagina' => 'Listado de Origen de Atención']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        return view('origenatencion.create', ['titulo' => 'Crear Origen de Atención', 'titulo_pagina' => 'Crear Origen de Atención']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new OrigenAtencion;
        $data->codigoorigenatencion = $request->codigoorigenatencion;
        $data->nombreorigenatencion = $request->nombreorigenatencion;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Origen de Atención agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Origen de Atención');
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
        $origenatencion = OrigenAtencion::where('idorigenatencion', $id)->first();
        return view('origenatencion.edit', ['origenatencion' => $origenatencion, 'titulo' => 'Editar Origen de Atención', 'titulo_pagina' => 'Editar Origen de Atención']);
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
        $data = OrigenAtencion::where('idorigenatencion', '=', $id)->first();
        $data->codigoorigenatencion = $request->codigoorigenatencion;
        $data->nombreorigenatencion = $request->nombreorigenatencion;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Origen de Atención Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Origen de Atención');
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
        $data = OrigenAtencion::where('idorigenatencion', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Origen de Atención Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Origen de Atención!');
           return redirect()->back();
        }   
    }
}
