<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PacienteCreateRequest;
use App\Http\Requests\PacienteUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use App\Models\glb\Rol;
use Session;
use App\Models\Pacientes;
use App\Models\Departamentos;
use App\Models\TipoDocumentos;
use App\Models\Municipios;
use App\Models\Sexo;
use App\Models\EstadoCivil;
use App\Models\GrupoSanguinio;
use App\Models\Ocupacion;
use App\Models\Religion;
use App\Models\Barrios;
use App\Models\ZonaResidencial;
use App\Models\Instituciones;
use App\Models\Regimen;
use App\Models\TipoAfiliacion;
use App\Models\Nivel;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pacientes = Pacientes::leftJoin('tipodocumento', 'paciente.idtipodocumento', '=', 'tipodocumento.idtipodocumento')
        ->join('municipio', 'paciente.idmunicipionacimiento', '=', 'municipio.idmunicipio')
        ->Join('sexo', 'paciente.idsexo', '=', 'sexo.idsexo')
        ->leftJoin('estadocivil', 'paciente.idestadocivil', '=', 'estadocivil.idestadocivil')
        ->leftJoin('gruposanguineo', 'paciente.idgruposanguineo', '=', 'gruposanguineo.idgruposanguineo')
        ->leftJoin('ocupacion', 'paciente.idocupacion', '=', 'ocupacion.idocupacion')
        ->leftJoin('religion', 'paciente.idreligion', '=', 'religion.idreligion')
        ->leftJoin('barrio', 'paciente.idbarrio', '=', 'barrio.idbarrio')
        ->leftJoin('zonaresidencial', 'paciente.idzonaresidencial', '=', 'zonaresidencial.idzonaresidencial')
        ->leftJoin('institucioneapb', 'paciente.idinstitucioneapb', '=', 'institucioneapb.idinstitucioneapb')
        ->leftJoin('regimen', 'paciente.idregimen', '=', 'regimen.idregimen')
        ->leftJoin('tipoafiliacion', 'paciente.idtipoafiliacion', '=', 'tipoafiliacion.idtipoafiliacion')
        ->leftJoin('nivel', 'paciente.idnivel', '=', 'nivel.idnivel')
        ->getQuery()->orderBy('idpaciente', 'DESC') // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
        return view('pacientes.index', ['pacientes' => $pacientes, 'titulo' => 'Pacientes', 'titulo_pagina' => 'Listado de Pacientes']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $departamentos = Departamentos::get();   
        $tipodocuemtos = TipoDocumentos::get(); 
        $sexo = Sexo::select('idsexo', 'nombresexo')->get();
        $estadocivil = EstadoCivil::select('idestadocivil', 'nombreestadocivil')->get();
        $gruposanguineo = GrupoSanguinio::select('idgruposanguineo', 'nombregruposanguineo')->get();
        $ocupacion = Ocupacion::select('idocupacion', 'nombreocupacion')->get();
        $religion = Religion::select('idreligion', 'nombrereligion')->get();
        $barrios = Barrios::select('idbarrio', 'nombrebarrio')->get();
        $zonas = ZonaResidencial::select('idzonaresidencial', 'nombrezonaresidencial')->get();
        $instituciones = Instituciones::select('idinstitucioneapb', 'nombreinstitucioneapb')->get();
        $regimen = Regimen::select('idregimen', 'nombreregimen')->get();
        $afiliaciones = TipoAfiliacion::select('idtipoafiliacion', 'nombretipoafiliacion')->get();
        $niveles = Nivel::select('idnivel', 'nombrenivel')->get();
        
        return view('pacientes.create', ['departamentos' => $departamentos, 'tipodocuemtos' => $tipodocuemtos, 'sexo' => $sexo, 'estadocivil' => $estadocivil, 'gruposanguineo' => $gruposanguineo, 'ocupacion' => $ocupacion, 'religion' => $religion, 'barrios' => $barrios, 'zonas' => $zonas, 'instituciones' => $instituciones, 'regimen' => $regimen, 'afiliaciones' => $afiliaciones, 'niveles' => $niveles, 'titulo' => 'Crear Paciente', 'titulo_pagina' => 'Crear Paciente']);
    }

    public function get_municipios(Request $request){
         
         if($request->ajax()){
            
            $municipios = Municipios::select('idmunicipio', 'nombremunicipio')->where('iddepartamento', $request->iddepartamento)->get();
             
             _json($municipios);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteCreateRequest $request)
    {
        $paciente = new Pacientes;
        $date = date_create($request->fechanacimiento); 
        $fechaseteada = date_format($date, 'Y-m-d');
        $paciente->idtipodocumento = $request->idtipodocumento;
        $paciente->numerodocumento = $request->numerodocumento;
        $paciente->nombrepaciente = $request->primernombre.' '.$request->segundonombre.' '.$request->primerapellido.' '.$request->segundoapellido;
        $paciente->primernombre = $request->primernombre;
        $paciente->segundonombre = $request->segundonombre;
        $paciente->primerapellido = $request->primerapellido;
        $paciente->segundoapellido = $request->segundoapellido;
        $paciente->fechanacimiento = $fechaseteada;
        $paciente->idmunicipionacimiento = $request->idmunicipionacimiento;
        $paciente->idsexo = $request->idsexo;
        $paciente->idestadocivil = $request->idestadocivil;
        $paciente->idgruposanguineo = $request->idgruposanguineo;
        $paciente->idocupacion = $request->idocupacion;
        $paciente->idreligion = $request->idreligion;
        $paciente->direccion = $request->direccion;
        $paciente->numerotelefonofijo = $request->numerotelefonofijo;
        $paciente->numerocelular = $request->numerocelular;
        $paciente->email = $request->email;
        $paciente->idbarrio = $request->idbarrio;
        $paciente->idmunicipio = $request->idmunicipio;
        $paciente->idzonaresidencial = $request->idzonaresidencial;
        $paciente->idinstitucioneapb = $request->idinstitucioneapb;
        $paciente->idregimen = $request->idregimen;
        $paciente->idtipoafiliacion = $request->idtipoafiliacion;
        $paciente->idnivel = $request->idnivel;
        $paciente->fechacreacion = date('Y-m-d h:m:s');
        $paciente->creadopor = Auth::user()->name.' '.Auth::user()->lastname;

        if ($paciente->save()) {
            Session::flash('flash_message', 'Paciente agregada correctamente!');
            return redirect()->route('crear-paciente');
        }else{
            Session::flash('flash_message', 'Error al guardar el Paciente');
            return redirect()->route('crear-paciente');
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
        $departamentos = Departamentos::get();   
        $tipodocuemtos = TipoDocumentos::get(); 
        $sexo = Sexo::select('idsexo', 'nombresexo')->get();
        $estadocivil = EstadoCivil::select('idestadocivil', 'nombreestadocivil')->get();
        $gruposanguineo = GrupoSanguinio::select('idgruposanguineo', 'nombregruposanguineo')->get();
        $ocupacion = Ocupacion::select('idocupacion', 'nombreocupacion')->get();
        $religion = Religion::select('idreligion', 'nombrereligion')->get();
        $barrios = Barrios::select('idbarrio', 'nombrebarrio')->get();
        $zonas = ZonaResidencial::select('idzonaresidencial', 'nombrezonaresidencial')->get();
        $instituciones = Instituciones::select('idinstitucioneapb', 'nombreinstitucioneapb')->get();
        $regimen = Regimen::select('idregimen', 'nombreregimen')->get();
        $afiliaciones = TipoAfiliacion::select('idtipoafiliacion', 'nombretipoafiliacion')->get();
        $niveles = Nivel::select('idnivel', 'nombrenivel')->get();
        
        $paciente = Pacientes::where('idpaciente', $id)->first();

        $municipios = Municipios::select('idmunicipio', 'iddepartamento')->where('idmunicipio',$paciente->idmunicipionacimiento)->get();

        $municipios2 = Municipios::select('idmunicipio', 'iddepartamento')->where('idmunicipio',$paciente->idmunicipio)->get();
        $municipiosgeneral = Municipios::get();   

        return view('pacientes.edit', ['paciente' => $paciente,'departamentos' => $departamentos, 'tipodocuemtos' => $tipodocuemtos, 'sexo' => $sexo, 'estadocivil' => $estadocivil, 'gruposanguineo' => $gruposanguineo, 'ocupacion' => $ocupacion, 'religion' => $religion, 'barrios' => $barrios, 'zonas' => $zonas, 'instituciones' => $instituciones, 'regimen' => $regimen, 'afiliaciones' => $afiliaciones, 'niveles' => $niveles, 'departamentoid' => $municipios[0]->iddepartamento, 'departamentoid2' => $municipios2[0]->iddepartamento, 'municipios' => $municipiosgeneral, 'titulo' => 'Editar Paciente', 'titulo_pagina' => 'Editar Paciente']);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteUpdateRequest $request, $id)
    {
        $paciente = Pacientes::where('idpaciente', '=', $id)->first();
        $date = date_create($request->fechanacimiento); 
        $fechaseteada = date_format($date, 'Y-m-d');
        $paciente->idtipodocumento = $request->idtipodocumento;
        $paciente->numerodocumento = $request->numerodocumento;
        $paciente->nombrepaciente = $request->primernombre.' '.$request->segundonombre.' '.$request->primerapellido.' '.$request->segundoapellido;
        $paciente->primernombre = $request->primernombre;
        $paciente->segundonombre = $request->segundonombre;
        $paciente->primerapellido = $request->primerapellido;
        $paciente->segundoapellido = $request->segundoapellido;
        $paciente->fechanacimiento = $fechaseteada;
        $paciente->idmunicipionacimiento = $request->idmunicipionacimiento;
        $paciente->idsexo = $request->idsexo;
        $paciente->idestadocivil = $request->idestadocivil;
        $paciente->idgruposanguineo = $request->idgruposanguineo;
        $paciente->idocupacion = $request->idocupacion;
        $paciente->idreligion = $request->idreligion;
        $paciente->direccion = $request->direccion;
        $paciente->numerotelefonofijo = $request->numerotelefonofijo;
        $paciente->numerocelular = $request->numerocelular;
        $paciente->email = $request->email;
        $paciente->idbarrio = $request->idbarrio;
        $paciente->idmunicipio = $request->idmunicipio;
        $paciente->idzonaresidencial = $request->idzonaresidencial;
        $paciente->idinstitucioneapb = $request->idinstitucioneapb;
        $paciente->idregimen = $request->idregimen;
        $paciente->idtipoafiliacion = $request->idtipoafiliacion;
        $paciente->idnivel = $request->idnivel;
        $paciente->fechaultmodificacion = date('Y-m-d h:m:s');
        $paciente->modificadopor = Auth::user()->name.' '.Auth::user()->lastname;

        if ($paciente->save()) {
            Session::flash('flash_message', 'Paciente Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Paciente');
            return redirect()->back();
        }
    }

    function calcularedad(Request $request){

       $date = date_create($request->fechanacimiento); 
       $fechaseteada = date_format($date, 'Y-m-d');
       if ($this->check_date($fechaseteada) != false) {
           $fechanacimiento = $fechaseteada;
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
        
           _json(['edad' => $ano_diferencia]);
       }else{
            _json(['edad' => 'error de fecha']);
       } 
    }

    function check_date($str){ 
        trim($str); 
        $trozos = explode ("-", $str); 
        $año=$trozos[0]; 
        $mes=$trozos[1]; 
        $dia=$trozos[2];      
        if(checkdate ($mes,$dia,$año)){ 
             return true; 
        } 
        else{ 
             return false; 
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
        $paciente = Pacientes::where('idpaciente', '=', $id)->first();
        $paciente->delete();
        Session::flash('flash_message', 'Paciente Eliminado correctamente!');
        return redirect()->route('pacientes');
    }
}
