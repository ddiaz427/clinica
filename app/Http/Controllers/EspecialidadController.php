<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $especialidades = Especialidad::orderBy('idespecialidad', 'DESC')->get(); 
        return view('especialidad.index', ['especialidades' => $especialidades, 'titulo' => 'Listar Especialidades', 'titulo_pagina' => 'Listar Especialidades']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('especialidad.create', ['titulo' => 'Crear Especialidad', 'titulo_pagina' => 'Crear Especialidad']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Especialidad;
        $data->nombreespecialidad = $request->nombreespecialidad;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Especialidad agregada correctamente!');
            return redirect()->back();
        }else{

            Session::flash('flash_message', 'Error al guardar la Especialidad');
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
        $especialidad = Especialidad::where('idespecialidad', $id)->first();
        return view('especialidad.edit', ['especialidad' => $especialidad, 'titulo' => 'Editar Especialidad', 'titulo_pagina' => 'Editar Especialidad']);
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
        $data = Especialidad::where('idespecialidad', '=', $id)->first();
        $data->nombreespecialidad = $request->nombreespecialidad;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Especialidad Editada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Especialidad');
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
        $data = Especialidad::where('idespecialidad', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Especialidad Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Especialidad!');
           return redirect()->back();
        }   
    }
}
