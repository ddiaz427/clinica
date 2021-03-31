<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Diagnostico;
use App\Models\Sexo;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $diagnosticos = Diagnostico::orderBy('iddiagnostico', 'DESC')->paginate(10); 
        return view('diagnostico.index', ['diagnosticos' => $diagnosticos, 'titulo' => 'Listar Diagnosticos', 'titulo_pagina' => 'Listar Diagnosticos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $sexos = Sexo::orderBy('idsexo', 'DESC')->get();
        return view('diagnostico.create', ['titulo' => 'Crear Diagnostico', 'titulo_pagina' => 'Crear Diagnostico', 'sexos' => $sexos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Diagnostico;
        $data->codigodiagnostico = $request->codigodiagnostico;
        $data->nombrediagnostico = $request->nombrediagnostico;
        $data->idsexo = $request->idsexo;
        $data->edadminima = $request->edadminima;
        $data->edadmaxima = $request->edadmaxima;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Diagnostico agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Diagnostico');
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
        $diagnostico = Diagnostico::where('iddiagnostico', $id)->first();

        $sexos = Sexo::orderBy('idsexo', 'DESC')->get();

        return view('diagnostico.edit', ['diagnostico' => $diagnostico, 'titulo' => 'Editar Diagnostico', 'titulo_pagina' => 'Editar Diagnostico', 'sexos' => $sexos]);

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
        $data = Diagnostico::where('iddiagnostico', '=', $id)->first();
        $data->codigodiagnostico = $request->codigodiagnostico;
        $data->nombrediagnostico = $request->nombrediagnostico;
        $data->idsexo = $request->idsexo;
        $data->edadminima = $request->edadminima;
        $data->edadmaxima = $request->edadmaxima;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Diagnostico Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Diagnostico');
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
        $data = Diagnostico::where('iddiagnostico', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Diagnostico Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Diagnostico!');
           return redirect()->back();
        }   
    }
}
