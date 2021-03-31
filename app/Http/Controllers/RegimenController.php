<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Regimen;

class RegimenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $regimen = Regimen::orderBy('idregimen', 'DESC')->get(); 
        return view('regimen.index', ['regimen' => $regimen, 'titulo' => 'Regimen', 'titulo_pagina' => 'Listado de Regimen']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('regimen.create', ['titulo' => 'Crear Regimen', 'titulo_pagina' => 'Crear Regimen']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Regimen;
        $data->nombreregimen = $request->nombreregimen;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Regimen agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Regimen');
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
        $regimen = Regimen::where('idregimen', $id)->first();
        return view('regimen.edit', ['regimen' => $regimen, 'titulo' => 'Editar Regimen '.$regimen->nombreregimen, 'titulo_pagina' => 'Editar Regimen']);
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
        $data = Regimen::where('idregimen', '=', $id)->first();
        $data->nombreregimen = $request->nombreregimen;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Regimen Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Regimen');
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
        $data = Regimen::where('idregimen', '=', $id)->first();
        $regimen = $data->nombreregimen;
        if ($data->delete()) {
           Session::flash('flash_message', 'Regimen '.$regimen.' Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Regimen!');
           return redirect()->back();
        }   
    }
}
