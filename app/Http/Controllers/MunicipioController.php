<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Municipios;
use App\Models\Departamentos;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $municipio = Municipios::leftJoin('departamento', 'municipio.iddepartamento', '=', 'departamento.iddepartamento')
        ->getQuery()->orderBy('idmunicipio', 'DESC') // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
        //echo "<pre>";
        //print_r($municipio);
        
        return view('municipio.index', ['municipio' => $municipio, 'titulo' => 'Municipios', 'titulo_pagina' => 'Listado de Municipios']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $departamento = Departamentos::orderBy('iddepartamento', 'DESC')->get(); 
        return view('municipio.create', ['titulo' => 'Crear Municipio', 'titulo_pagina' => 'Crear Municipio', 'departamento' => $departamento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Municipios;
        $data->iddepartamento = $request->iddepartamento;
        $data->nombremunicipio = $request->nombremunicipio;
        $data->codigomunicipiodane = $request->codigomunicipiodane;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Municipio agregada correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Municipio');
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
        $departamento = Departamentos::orderBy('iddepartamento', 'DESC')->get(); 
        $municipio = Municipios::where('idmunicipio', $id)->first();
        return view('municipio.edit', ['municipio' => $municipio, 'titulo' => 'Editar Municipio', 'titulo_pagina' => 'Editar Municipio', 'departamento' => $departamento]);
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
        $data = Municipios::where('idmunicipio', '=', $id)->first();
        $data->iddepartamento = $request->iddepartamento;
        $data->nombremunicipio = $request->nombremunicipio;
        $data->codigomunicipiodane = $request->codigomunicipiodane;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Municipio Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Municipio');
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
        $data = Municipios::where('idmunicipio', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Municipio Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Municipio!');
           return redirect()->back();
        }   
    }
}
