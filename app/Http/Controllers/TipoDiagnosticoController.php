<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoDiagnostico;

class TipoDiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipodianosticos = TipoDiagnostico::orderBy('idtipodiagnostico', 'DESC')->get(); 
        return view('tipodiagnostico.index', ['tipodianosticos' => $tipodianosticos, 'titulo' => 'Listar Diágnosticos', 'titulo_pagina' => 'Listar Diágnosticos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tipodiagnostico.create', ['titulo' => 'Crear Tipo de Diágnostico', 'titulo_pagina' => 'Crear Tipo de Diágnostico']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoDiagnostico;
        $data->nombretipodiagnostico = $request->nombretipodiagnostico;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Diágnostico agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Diágnostico');
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
        $tipodianostico = TipoDiagnostico::where('idtipodiagnostico', $id)->first();
        return view('tipodiagnostico.edit', ['tipodianostico' => $tipodianostico, 'titulo' => 'Editar Tipo Diágnostico', 'titulo_pagina' => 'Editar Tipo Diágnostico']);
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
        $data = TipoDiagnostico::where('idtipodiagnostico', '=', $id)->first();
        $data->nombretipodiagnostico = $request->nombretipodiagnostico;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Diágnostico Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Diágnostico');
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
        $data = TipoDiagnostico::where('idtipodiagnostico', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Diágnostico Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Diágnostico!');
           return redirect()->back();
        }   
    }
}
