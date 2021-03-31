<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\TipoDocumentos;

class TipoDocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipodocuemtos = TipoDocumentos::orderBy('idtipodocumento', 'DESC')->get(); 
        return view('tipodocumentos.index', ['titulo_pagina' => 'Listado Tipo de Documentos','tipodocuemtos' => $tipodocuemtos, 'titulo' => 'Tipo de Documentos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        return view('tipodocumentos.create', ['titulo_pagina' => 'Crear Tipo de Documentos','titulo' => 'Formulario de crear Tipo de Documento']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipodocuemtos = new TipoDocumentos;
        $tipodocuemtos->nombretipodocumento = $request->nombretipodocumento;
        $tipodocuemtos->abreviatura = $request->abreviatura;
        $tipodocuemtos->creadopor = Auth::user()->id;
        $tipodocuemtos->fechacreacion = date('Y-m-d h:m:s');

        if ($tipodocuemtos->save()) {
            Session::flash('flash_message', 'Tipo de Documento agregada correctamente!');
            return redirect()->route('crear-tipodocumento');
        }else{
            Session::flash('flash_message', 'Error al guardar el Tipo de Documento');
            return redirect()->route('crear-tipodocumento');
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
        $tipodocumentos = TipoDocumentos::where('idtipodocumento', $id)->first();
        return view('tipodocumentos.edit', ['titulo_pagina' => 'Editar Tipo de Documentos','tipodocumentos' => $tipodocumentos, 'titulo' => 'Formulario para editar Tipo de Documento']);
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
        $tipodocuemtos = TipoDocumentos::where('idtipodocumento', '=', $id)->first();
        $tipodocuemtos->nombretipodocumento = $request->nombretipodocumento;
        $tipodocuemtos->abreviatura = $request->abreviatura;
        $tipodocuemtos->modificadopor = Auth::user()->id;
        $tipodocuemtos->fechaultmodificacion = date('Y-m-d h:m:s');


        if ($tipodocuemtos->save()) {
            Session::flash('flash_message', 'Tipo de Documento Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Tipo de Documento');
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
        $tipodocuemtos = TipoDocumentos::where('idtipodocumento', '=', $id)->first();
        $tipodocuemtos->delete();
        Session::flash('flash_message', 'Tipo de Documento Eliminado correctamente!');
        return redirect()->route('tipodocumentos');
    }
}
