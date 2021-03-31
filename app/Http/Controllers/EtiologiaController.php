<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Etiologia;

class EtiologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $etilogias = Etiologia::orderBy('idetiologia', 'DESC')->get(); 
        return view('etilogia.index', ['etilogias' => $etilogias, 'titulo' => 'Listar Etiologia', 'titulo_pagina' => 'Listar Etiologia']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        return view('etilogia.create', ['titulo' => 'Crear Etiologia', 'titulo_pagina' => 'Crear Etiologia']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Etiologia;
        $data->nombreetiologia = $request->nombreetiologia;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Etiologia agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar la Etiologia');
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
        $etilogia = Etiologia::where('idetiologia', $id)->first();
        return view('etilogia.edit', ['etilogia' => $etilogia, 'titulo' => 'Editar Etiologia', 'titulo_pagina' => 'Editar Etiologia']);
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
        $data = Etiologia::where('idetiologia', '=', $id)->first();
        $data->nombreetiologia = $request->nombreetiologia;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Etiologia Editada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar la Etiologia');
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
        $data = Etiologia::where('idetiologia', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Etiologia Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar la Etiologia!');
           return redirect()->back();
        }   
    }
}
