<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\GrupoSanguinio;

class GrupoSanguinioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $gruposanguinio = GrupoSanguinio::orderBy('idgruposanguineo', 'DESC')->get(); 
        return view('gruposanguinio.index', ['gruposanguinio' => $gruposanguinio, 'titulo' => 'Grupo Sanguínio', 'titulo_pagina' => 'Listado de Grupo Sanguínio']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        //echo 'crear sexo';   
        return view('gruposanguinio.create', ['titulo' => 'Grupo Sanguínio', 'titulo_pagina' => 'Grupo Sanguínio']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new GrupoSanguinio;
        $data->nombregruposanguineo = $request->nombregruposanguineo;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Grupo Sanguínio agregada correctamente!');
            return redirect()->route('crear-gruposanguinio');
        }else{
            Session::flash('flash_message', 'Error al guardar el Grupo Sanguínio');
            return redirect()->route('crear-gruposanguinio');
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
        $gruposanguinio = GrupoSanguinio::where('idgruposanguineo', $id)->first();
        return view('gruposanguinio.edit', ['gruposanguinio' => $gruposanguinio, 'titulo' => 'Editar Grupo Sanguínio', 'titulo_pagina' => 'Editar Grupo Sanguínio']);
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
        $data = GrupoSanguinio::where('idgruposanguineo', '=', $id)->first();
      
        $data->nombregruposanguineo = $request->nombregruposanguineo;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Grupo Sanguínio Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Grupo Sanguínio');
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
        $data = GrupoSanguinio::where('idgruposanguineo', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Grupo Sanguínio Eliminado correctamente!');
           return redirect()->route('gruposanguinios');
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Grupo Sanguínio!');
           return redirect()->route('gruposanguinios');
        }   
    }
}
