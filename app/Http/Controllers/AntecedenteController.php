<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Antecedente;
use App\Models\TipoAntecedente;

class AntecedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $antecendentes = Antecedente::orderBy('idantecedente', 'DESC')->get(); 
        return view('antecendente.index', ['antecendentes' => $antecendentes, 'titulo' => 'Listado', 'titulo_pagina' => 'Antecedente']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $tipoantecendentes = TipoAntecedente::orderBy('idtipoantecedente', 'DESC')->get();  
        return view('antecendente.create', ['titulo' => 'Formulario de Crear', 'titulo_pagina' => 'Crear Antecedente', 'tipoantecendentes' => $tipoantecendentes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Antecedente;
        $data->nombreantecedente = $request->nombreantecedente;
        $data->idtipoantecedente = $request->idtipoantecedente;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Antecedente agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Antecedente');
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
        $tipoantecendentes = TipoAntecedente::orderBy('idtipoantecedente', 'DESC')->get();  
        $antecendente = Antecedente::where('idantecedente', $id)->first();
        return view('antecendente.edit', ['antecendente' => $antecendente, 'tipoantecendentes' => $tipoantecendentes, 'titulo' => 'Formulario para Editar Datos', 'titulo_pagina' => 'Editar Antecedente']);
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
        $data = Antecedente::where('idantecedente', '=', $id)->first();
        $data->nombreantecedente = $request->nombreantecedente;
        $data->idtipoantecedente = $request->idtipoantecedente;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Antecedente Editado correctamente!');
            return redirect()->back();
        }else{
            
            Session::flash('flash_message', 'Error al Editar el Antecedente');
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
        $data = Antecedente::where('idantecedente', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Antecedente Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Antecedente!');
           return redirect()->back();
        }   
    }
}
