<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\ViaIngreso;

class ViaIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $viaingreso = ViaIngreso::orderBy('idviaingreso', 'DESC')->get(); 
        return view('viaingreso.index', ['viaingreso' => $viaingreso, 'titulo' => 'Via de Ingreso', 'titulo_pagina' => 'Listado de Via de Ingreso']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('viaingreso.create', ['titulo' => 'Crear Via de Ingreso', 'titulo_pagina' => 'Via de Ingreso']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new ViaIngreso;
        $data->nombreviaingreso = $request->nombreviaingreso;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Via de Ingreso agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar la Via de Ingreso');
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
        $viaingreso = ViaIngreso::where('idviaingreso', $id)->first();
        return view('viaingreso.edit', ['viaingreso' => $viaingreso, 'titulo' => 'Editar Via de Ingreso', 'titulo_pagina' => 'Editar Via de Ingreso']);
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
        $data = ViaIngreso::where('idviaingreso', '=', $id)->first();
        $data->nombreviaingreso = $request->nombreviaingreso;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Via de Ingreso Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Via de Ingreso');
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
        $data = ViaIngreso::where('idviaingreso', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Via de Ingreso Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Via de Ingreso!');
           return redirect()->back();
        }   
    }
}
