<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Instituciones;

class InstitucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $institucion = Instituciones::orderBy('idinstitucioneapb', 'DESC')->get(); 
        return view('institucion.index', ['institucion' => $institucion, 'titulo' => 'Instituciones', 'titulo_pagina' => 'Listado de Instituciones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('institucion.create', ['titulo' => 'Crear Institucíon', 'titulo_pagina' => 'Crear Institucíon']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Instituciones;
        $data->nombreinstitucioneapb = $request->nombreinstitucioneapb;
        $data->codigoinstitucioneapb = $request->codigoinstitucioneapb;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Institucíon agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar la Institucíon');
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
        $institucion = Instituciones::where('idinstitucioneapb', $id)->first();
        return view('institucion.edit', ['institucion' => $institucion, 'titulo' => 'Editar Institucíon', 'titulo_pagina' => 'Editar Institucíon']);
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
        $data = Instituciones::where('idinstitucioneapb', '=', $id)->first();
        $data->nombreinstitucioneapb = $request->nombreinstitucioneapb;
        $data->codigoinstitucioneapb = $request->codigoinstitucioneapb;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Institucíon Editada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Institucíon');
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
        $data = Instituciones::where('idinstitucioneapb', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Institucíon Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Institucíon!');
           return redirect()->back();
        }   
    }
}
