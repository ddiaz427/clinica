<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Departamentos;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $departamento = Departamentos::orderBy('iddepartamento', 'DESC')->get(); 
        return view('departamento.index', ['departamento' => $departamento, 'titulo' => 'Departamentos', 'titulo_pagina' => 'Listado de Departamentos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('departamento.create', ['titulo' => 'Crear Departamento', 'titulo_pagina' => 'Crear Departamento']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Departamentos;
        $data->nombredepartamento = $request->nombredepartamento;
        $data->codigodepartamentodane = $request->codigodepartamentodane;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Departamento agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Departamento');
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
        $departamento = Departamentos::where('iddepartamento', $id)->first();
        return view('departamento.edit', ['departamento' => $departamento, 'titulo' => 'Editar Departamento', 'titulo_pagina' => 'Editar Departamento']);
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
        $data = Departamentos::where('iddepartamento', '=', $id)->first();
        $data->nombredepartamento = $request->nombredepartamento;
        $data->codigodepartamentodane = $request->codigodepartamentodane;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Departamento Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Departamento');
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
        $data = Departamentos::where('iddepartamento', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Departamento Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Departamento!');
           return redirect()->back();
        }   
    }
}
