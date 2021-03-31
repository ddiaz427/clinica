<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\Procedimiento;
use App\Models\TipoServicio;
use App\Models\Sexo;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $procedimiento = Procedimiento::orderBy('idprocedimiento', 'DESC')->simplePaginate(10); 
        return view('procedimiento.index', ['procedimientos' => $procedimiento, 'titulo' => 'Listar Procedimientos', 'titulo_pagina' => 'Listar Procedimientos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $tiposervicio = TipoServicio::orderBy('idtiposervicio', 'DESC')->get();
        $sexos = Sexo::orderBy('idsexo', 'DESC')->get();
        return view('procedimiento.create', ['titulo' => 'Crear Procedimiento', 'titulo_pagina' => 'Crear Procedimiento', 'servicios' => $tiposervicio, 'sexos' => $sexos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Procedimiento;
        $data->cups = $request->cups;
        $data->soat = $request->soat;
        $data->escirugia = $request->escirugia;
        $data->nombreprocedimiento = $request->nombreprocedimiento;
        $data->formagenerica = $request->formagenerica;
        $data->idtiposervicio = $request->idtiposervicio;
        $data->idsexo = $request->idsexo;
        $data->edadminimaprocedimiento = $request->edadminimaprocedimiento;
        $data->edadmaximaprocedimiento = $request->edadmaximaprocedimiento;
        $data->procedimientoactivo = 1;
        $data->espos = 1;
        $data->creadopor = Auth::user()->id;
        $data->fechacreacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Procedimiento agregado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al guardar el Procedimiento');
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
        $procedimiento = Procedimiento::where('idprocedimiento', $id)->first();

        $tiposervicio = TipoServicio::orderBy('idtiposervicio', 'DESC')->get();
        $sexos = Sexo::orderBy('idsexo', 'DESC')->get();

        return view('procedimiento.edit', ['procedimiento' => $procedimiento, 'titulo' => 'Crear Procedimiento', 'titulo_pagina' => 'Crear Procedimiento', 'servicios' => $tiposervicio, 'sexos' => $sexos]);

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
        $data = Procedimiento::where('idprocedimiento', '=', $id)->first();
        $data->cups = $request->cups;
        $data->soat = $request->soat;
        $data->escirugia = $request->escirugia;
        $data->nombreprocedimiento = $request->nombreprocedimiento;
        $data->formagenerica = $request->formagenerica;
        $data->idtiposervicio = $request->idtiposervicio;
        $data->idsexo = $request->idsexo;
        $data->edadminimaprocedimiento = $request->edadminimaprocedimiento;
        $data->edadmaximaprocedimiento = $request->edadmaximaprocedimiento;
        $data->modificadopor = Auth::user()->id;
        $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', 'Procedimiento Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Procedimiento');
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
        $data = Procedimiento::where('idprocedimiento', '=', $id)->first();
        
        if ($data->delete()) {
           Session::flash('flash_message', 'Procedimiento Eliminado correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Procedimiento!');
           return redirect()->back();
        }   
    }
}
