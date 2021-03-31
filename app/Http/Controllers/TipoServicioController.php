<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoServicio;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipoServicios = TipoServicio::orderBy('idtiposervicio', 'DESC')->get(); 
        return view('tiposervicio.index', ['tipoServicios' => $tipoServicios, 'titulo' => 'Listar Tipos de Servicios', 'titulo_pagina' => 'Listar Tipos de Servicios']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('tiposervicio.create', ['titulo' => 'Crear Tipo de Servicio', 'titulo_pagina' => 'Crear Tipo de Servicio']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TipoServicio;
        $data->nombretiposervicio = $request->nombretiposervicio;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Servicio agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Servicio');
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
        $tiposervicio = TipoServicio::where('idtiposervicio', $id)->first();
        return view('tiposervicio.edit', ['tiposervicio' => $tiposervicio, 'titulo' => 'Editar Tipo de Servicio', 'titulo_pagina' => 'Editar Tipo de Servicio']);
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
        $data = TipoServicio::where('idtiposervicio', '=', $id)->first();
        $data->nombretiposervicio = $request->nombretiposervicio;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Tipo de Servicio Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Servicio');
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
        $data = TipoServicio::where('idtiposervicio', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Tipo de Servicio Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Tipo de Servicio!');
           return redirect()->back();
        }   
    }
}
