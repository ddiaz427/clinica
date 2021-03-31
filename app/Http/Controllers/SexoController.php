<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Sexo;

class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sexos = Sexo::orderBy('idsexo', 'DESC')->get(); 
        return view('sexo.index', ['sexos' => $sexos, 'titulo' => 'Tipos de Sexo', 'titulo_pagina' => 'Listado de Sexos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        //echo 'crear sexo';   
        return view('sexo.create', ['titulo' => 'Crear Nuevo Sexo', 'titulo_pagina' => 'Crear Nuevo Sexo']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Sexo;
        $data->nombresexo = $request->nombresexo;
        $data->codigosexo = $request->codigosexo;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Sexo agregada correctamente!');
            return redirect()->route('crear-sexo');
        }else{
            Session::flash('flash_message', 'Error al guardar el Sexo');
            return redirect()->route('crear-sexo');
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
        $sexo = Sexo::where('idsexo', $id)->first();
        return view('sexo.edit', ['sexo' => $sexo, 'titulo' => 'Editar Sexo', 'titulo_pagina' => 'Editar Sexo']);
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
        $data = Sexo::where('idsexo', '=', $id)->first();
      
        $data->nombresexo = $request->nombresexo;
        $data->codigosexo = $request->codigosexo;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Sexo Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Sexo');
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
        $data = Sexo::where('idsexo', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Sexo Eliminado correctamente!');
           return redirect()->route('sexos');
        }else{
           Session::flash('flash_message', 'Error al Eliminar el sexo!');
           return redirect()->route('sexos');
        }   
    }
}
