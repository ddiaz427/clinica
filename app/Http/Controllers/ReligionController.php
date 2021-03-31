<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Religion;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $religion = Religion::orderBy('idreligion', 'DESC')->get(); 
        return view('religion.index', ['religion' => $religion, 'titulo' => 'Religiones', 'titulo_pagina' => 'Listar Religiones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('religion.create', ['titulo' => 'Crear Religión', 'titulo_pagina' => 'Crear Religión']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Religion;
        $data->nombrereligion = $request->nombrereligion;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Religión agregada correctamente!');
            return redirect()->route('crear-religion');
        }else{
            Session::flash('flash_message', 'Error al guardar la Religión');
            return redirect()->route('crear-religion');
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
        $religion = Religion::where('idreligion', $id)->first();
        return view('religion.edit', ['religion' => $religion, 'titulo' => 'Editar Religión', 'titulo_pagina' => 'Editar Religión']);
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
        $data = Religion::where('idreligion', '=', $id)->first();
      
        $data->nombrereligion = $request->nombrereligion;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Religión Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Religión');
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
        $data = Religion::where('idreligion', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Religión Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Religión!');
           return redirect()->back();
        }   
    }
}
