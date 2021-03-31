<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\DiagnosticoAlt;

class DiagnosticoAltController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $diagnosticoalt = DiagnosticoAlt::orderBy('iddiagnosticoalt', 'DESC')->get(); 
        return view('diagnosticoalt.index', ['diagnosticoalts' => $diagnosticoalt, 'titulo' => 'Listar Diágnostico ALT', 'titulo_pagina' => 'Listar Diágnosticos ALT']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('diagnosticoalt.create', ['titulo' => 'Crear Diágnosticos ALT', 'titulo_pagina' => 'Crear Diágnosticos ALT']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new DiagnosticoAlt;
        $data->nombrediagnosticoalt = $request->nombrediagnosticoalt;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Diágnosticos ALT agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Diágnosticos ALT');
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
        $diagnosticoalt = DiagnosticoAlt::where('iddiagnosticoalt', $id)->first();
        return view('diagnosticoalt.edit', ['diagnosticoalt' => $diagnosticoalt, 'titulo' => 'Editar Diágnosticos ALT', 'titulo_pagina' => 'Editar Diágnosticos ALT']);
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
        $data = DiagnosticoAlt::where('iddiagnosticoalt', '=', $id)->first();
        $data->nombrediagnosticoalt = $request->nombrediagnosticoalt;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Diágnostico ALT Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Diágnostico ALT');
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
        $data = DiagnosticoAlt::where('iddiagnosticoalt', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Diágnostico ALT Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Diágnostico ALT!');
           return redirect()->back();
        }   
    }
}
