<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $estadocivil = EstadoCivil::orderBy('idestadocivil', 'DESC')->get(); 
        return view('estadocivil.index', ['estadocivil' => $estadocivil, 'titulo' => 'Estados Civil', 'titulo_pagina' => 'Estados Civil']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('estadocivil.create', ['titulo' => 'Crear Estado Civil', 'titulo_pagina' => 'Crear Estado Civil']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new EstadoCivil;
        $data->nombreestadocivil = $request->nombreestadocivil;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Estado Civil agregada correctamente!');
            return redirect()->route('crear-estadocivil');
        }else{
            Session::flash('flash_message', 'Error al guardar el Estado Civil');
            return redirect()->route('crear-estadocivil');
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
        $estadocivil = EstadoCivil::where('idestadocivil', $id)->first();
        return view('estadocivil.edit', ['estadocivil' => $estadocivil, 'titulo' => 'Editar Estado Civil', 'titulo_pagina' => 'Editar Estado Civil']);
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
        $data = EstadoCivil::where('idestadocivil', '=', $id)->first();
      
        $data->nombreestadocivil = $request->nombreestadocivil;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Estado Civil Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Estado Civil');
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
        $data = EstadoCivil::where('idestadocivil', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Estado Civil Eliminado correctamente!');
           return redirect()->route('estadociviles');
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Estado Civil!');
           return redirect()->route('estadociviles');
        }   
    }
}
