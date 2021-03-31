<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\ZonaResidencial;

class ZonaResidencialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $zonaresidencial = ZonaResidencial::orderBy('idzonaresidencial', 'DESC')->get(); 
        return view('zonaresidencial.index', ['zonaresidencial' => $zonaresidencial, 'titulo' => 'Zona Residencial', 'titulo_pagina' => 'Listado de Zonas Residencial']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('zonaresidencial.create', ['titulo' => 'Crear Zona Residencial', 'titulo_pagina' => 'Crear Zona Residencial']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new ZonaResidencial;
        $data->nombrezonaresidencial = $request->nombrezonaresidencial;
        $data->codigozonaresidencial = $request->codigozonaresidencial;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Zona Residencial agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar la Zona Residencial');
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
        $zonaresidencial = ZonaResidencial::where('idzonaresidencial', $id)->first();
        return view('zonaresidencial.edit', ['zonaresidencial' => $zonaresidencial, 'titulo' => 'Editar Zona Residencial', 'titulo_pagina' => 'Editar Zona Residencial']);
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
        $data = ZonaResidencial::where('idzonaresidencial', '=', $id)->first();
        $data->nombrezonaresidencial = $request->nombrezonaresidencial;
        $data->codigozonaresidencial = $request->codigozonaresidencial;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Barrio Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Barrio');
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
        $data = ZonaResidencial::where('idzonaresidencial', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Zona Residencial Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Zona Residencial!');
           return redirect()->back();
        }   
    }
}
