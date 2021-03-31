<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoRefNivelEstruc;
use App\Models\pto\PtoRefTiposMov;
use Session;
use Input;

class PtoNivelEstrucController extends Controller
{
     public function __construct()
    {
        //parent::__construct();
        \View::share ( 'titulo_pagina', 'Estructura de Niveles' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nivelestructura = PtoRefNivelEstruc::all();
        return view('pto/maestros/nivel_estructura.index', ['nivelestructura' => $nivelestructura]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $tiposmovtos = PtoRefTiposMov::orderBy('descrip_mov')->get();
        return view('pto.maestros.nivel_estructura.create', ['tiposmovtos' => $tiposmovtos]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = PtoRefNivelEstruc::validate($request->all());
        if ( $v->passes() ) {
            $nivelestructura = PtoRefNivelEstruc::create($request->all());
            Session::flash('flash_message', 'Registro agregado correctamente!');
            return redirect()->route('pto-nivel-estructura');
        } else {
            return redirect()->route('crear-pto-nivel-estructura')->withErrors($v)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiposmovtos = PtoRefTiposMov::orderBy('descrip_mov')->get();        

        $nivelestructura = PtoRefNivelEstruc::find($id);
        return view('pto.maestros.nivel_estructura.edit', ['nivelestructura' => $nivelestructura,'tiposmovtos' => $tiposmovtos]);
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
        $nivelestructura = PtoRefNivelEstruc::find($id);
        $v = PtoRefNivelEstruc::validate($request->all());
        if ( $v->passes() ) {
            
            $nivelestructura->update($request->all());            
            Session::flash('flash_message', 'Registro actualizado correctamente!');
            //return redirect()->back();
            return redirect()->route('pto-nivel-estructura');

        } else {
            
            return redirect()->back()->withErrors($v)->withInput();
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
        Session::flash('flash_message', 'Registro eliminado correctamente!');
        $nivelestructura = PtoRefNivelEstruc::find($id);
        
        $nivelestructura->delete();
        return redirect()->route('pto-nivel-estructura');
    }
}
