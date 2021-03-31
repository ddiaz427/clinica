<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoAntecedente;

class TipoAntecedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipoantecedentes = TipoAntecedente::orderBy('idtipoantecedente', 'DESC')->get(); 
        return view('tipoantecedente.index', ['tipoantecedentes' => $tipoantecedentes, 'titulo' => 'Listar Tipo Antecedentes', 'titulo_pagina' => 'Listar Tipo Antecedentes']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tipoantecedente.create', ['titulo' => 'Crear Tipo Antecedente', 'titulo_pagina' => 'Crear Tipo Antecedente']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoAntecedente;
        $data->nombretipoantecedente = $request->nombretipoantecedente;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Antecedente agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Antecedente');
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
        $tipoantecedente = TipoAntecedente::where('idtipoantecedente', $id)->first();
        return view('tipoantecedente.edit', ['tipoantecedente' => $tipoantecedente, 'titulo' => 'Editar Tipo de Antecedente', 'titulo_pagina' => 'Editar Tipo de Antecedente']);
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
        $data = TipoAntecedente::where('idtipoantecedente', '=', $id)->first();
        $data->nombretipoantecedente = $request->nombretipoantecedente;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Antecedente Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Antecedente');
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
        $data = TipoAntecedente::where('idtipoantecedente', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Antecedente Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Antecedente!');
           return redirect()->back();
        }   
    }
}
