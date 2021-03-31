<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Nivel;

class NivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $nivel = Nivel::orderBy('idnivel', 'DESC')->get(); 
        return view('nivel.index', ['nivel' => $nivel, 'titulo' => 'Niveles', 'titulo_pagina' => 'Listado de Niveles']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('nivel.create', ['titulo' => 'Crear Nivel', 'titulo_pagina' => 'Crear Nivel']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Nivel;
        $data->nombrenivel = $request->nombrenivel;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Nivel agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Nivel');
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
        $nivel = Nivel::where('idnivel', $id)->first();
        return view('nivel.edit', ['nivel' => $nivel, 'titulo' => 'Editar Nivel '.$nivel->nombrenivel, 'titulo_pagina' => 'Editar Nivel']);
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
        $data = Nivel::where('idnivel', '=', $id)->first();
        $data->nombrenivel = $request->nombrenivel;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Nivel Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Nivel');
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
        $data = Nivel::where('idnivel', '=', $id)->first();
        $nivel = $data->nombrenivel;
        if ($data->delete()) {
           Session::flash('flash_message', 'Nivel '.$nivel.' Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Nivel!');
           return redirect()->back();
        }   
    }
}
