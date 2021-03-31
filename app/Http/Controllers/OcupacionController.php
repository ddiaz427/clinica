<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Ocupacion;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $ocupacion = Ocupacion::orderBy('idocupacion', 'DESC')->get(); 
        return view('ocupacion.index', ['ocupacion' => $ocupacion, 'titulo' => 'Ocupaciones', 'titulo_pagina' => 'Ocupaciones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('ocupacion.create', ['titulo' => 'Crear Ocupación', 'titulo_pagina' => 'Crear Ocupación']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Ocupacion;
        $data->nombreocupacion = $request->nombreocupacion;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Ocupación agregada correctamente!');
            return redirect()->route('crear-ocupacion');
        }else{
            Session::flash('flash_message', 'Error al guardar la Ocupación');
            return redirect()->route('crear-ocupacion');
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
        $ocupacion = Ocupacion::where('idocupacion', $id)->first();
        return view('ocupacion.edit', ['ocupacion' => $ocupacion, 'titulo' => 'Editar Ocupación', 'titulo_pagina' => 'Editar Ocupación']);
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
        $data = Ocupacion::where('idocupacion', '=', $id)->first();
      
        $data->nombreocupacion = $request->nombreocupacion;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Ocupación Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Ocupación');
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
        $data = Ocupacion::where('idocupacion', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Ocupación Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Ocupación!');
           return redirect()->back();
        }   
    }
}
