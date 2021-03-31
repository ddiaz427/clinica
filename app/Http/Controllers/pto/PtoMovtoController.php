<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\pto\PtoMstMovto;
use App\Models\pto\PtoDetMovto;
use App\Models\pto\PtoRefEstado;
use App\Models\pto\PtoRefDependencia;
use App\Models\pto\PtoRefTipoTransacion;
use App\Models\pto\PtoRefRubro;
use Session;
use Input;
use Form;


class PtoMovtoController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		//parent::__construct();
		\View::share ( 'titulo_pagina', 'Disponibilidad Presupuestal' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientos = PtoMstMovto::all();
        return view('pto.movimientos.cdp.index', ['movimientos' => $movimientos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$tipostransacciones = PtoRefTipoTransacion::orderBy('descrip')->get();
		$dependencias = PtoRefDependencia::orderBy('descripcion')->lists('descripcion','pk_id_dependencia');
        return view('pto.movimientos.cdp.create',['dependencias' => $dependencias, 'tipostransacciones' => $tipostransacciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->all();
		$data['fecha_movto'] = date('Y-m-a');
		$data['nro_documento'] = 1;
		$data['fk_id_tipo_transaccion'] = 1;
		$data['nro_documento'] = 1;
		$data['fk_id_estado'] = 1;
		$data['vigencia'] = date('Y');
        $v = PtoMstMovto::validate($data);
        if ( $v->passes() ) {
			$data['fk_id_estado'] = 1;
        	$mto = PtoMstMovto::create($data);
			if(!empty($data['fk_id_rubro'])){
				$i = 0;
				foreach($data['fk_id_rubro'] as $rubro){
					$data_det = array(
						'codigo_rubro' => $rubro,
						'valor' => $data['valor'][$i],
						'fk_id_movto' => $mto->pk_id_movto,
						'fk_id_estado' => 1,
					);
					PtoDetMovto::create($data_det);
					$i++;
				}
			}
	        Session::flash('flash_message', 'Registro agregado correctamente!');
			return redirect()->route('pto-cdp');
        } else {
        	return redirect()->route('crear-pto-tipo-entidad')->withErrors($v)->withInput();
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
        $movimiento = PtoMstMovto::find($id);
        return view('pto.movimientos.cdp.mostrar', ['movimiento' => $movimiento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$tipostransacciones = PtoRefTipoTransacion::orderBy('descrip')->get();
		$dependencias = PtoRefDependencia::orderBy('descripcion')->lists('descripcion','pk_id_dependencia');
        $movimiento = PtoMstMovto::find($id);
        return view('pto.movimientos.cdp.edit', ['tipostransacciones' => $tipostransacciones,'dependencias' => $dependencias,'movimiento' => $movimiento]);
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
        $tipoentidad = PtoRefTipoEntidad::find($id);
        $v = PtoRefTipoEntidad::validate($request->all());
        if ( $v->passes() ) {
			$tipoentidad->update($request->all());
			Session::flash('flash_message', 'Registro actualizado correctamente!');
			return redirect()->back();
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
        $tipoentidad = PtoRefTipoEntidad::find($id);
		$tipoentidad->delete();
		return redirect()->route('pto-tipo-entidad');
    }

    public function getRubros(Request $request)
    {
		$results = array();
		$dato = $request->get('query');
        $rubros = PtoRefRubro::where(function($query)use($dato) {
			$query->where('codigo_rubro', 'like', '%'.$dato.'%')
				  ->orWhere('descripcion', 'like', '%'.$dato.'%');
        })->orderBy('codigo_rubro')->get();
		foreach($rubros as $rubro){
			$results[] = array(
				"id" => $rubro->pk_id_rubro,
				"value" => $rubro->codigo_rubro.' - '.$rubro->descripcion,
			);
		}
		return json_encode($results);
    }
}
