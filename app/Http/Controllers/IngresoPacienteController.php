<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Auth;
use Session;
use App\Models\IngresoPaciente;
use App\Models\Pacientes;
use App\Models\TipoDocumentos;
use App\Models\Instituciones;
use App\Models\Convenios;
use App\Models\Regimen;
use App\Models\TipoAfiliacion;
use App\Models\Nivel;
use App\Models\EstadoCivil;
use App\Models\GrupoSanguinio;
use App\Models\Departamentos;
use App\Models\Sexo;
use App\Models\Religion;
use App\Models\Ocupacion;
use App\Models\Barrios;
use App\Models\ZonaResidencial;
use App\Models\ViaIngreso;
use App\Models\OrigenAtencion;
use App\Models\TipoAtencion;
use App\Models\Municipios;

class IngresoPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $ingreso = IngresoPaciente::Join('paciente', 'admision.idpaciente', '=', 'paciente.idpaciente')
        ->Join('viaingreso', 'admision.idviaingreso', '=', 'viaingreso.idviaingreso')
        ->Join('origenatencion', 'admision.idorigenatencion', '=', 'origenatencion.idorigenatencion')
        ->Join('tipoatencion', 'admision.idtipoatencion', '=', 'tipoatencion.idtipoatencion')
        ->select('paciente.nombrepaciente','viaingreso.nombreviaingreso','admision.fechaingreso','admision.horaingreso','origenatencion.nombreorigenatencion','tipoatencion.nombretipoatencion','admision.fechacreacion','admision.fechaultmodificacion','admision.idadmision')
        ->orderBy('admision.idadmision', 'DESC')
        ->get(); 
        return view('ingresopaciente.index', ['ingresopaciente' => $ingreso, 'titulo' => 'Admisión', 'titulo_pagina' => 'Listado de Admisión Pacientes']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {    
        $tipodocumentos = TipoDocumentos::orderBy('idtipodocumento', 'DESC')->get(); 
        //$pacientes = Pacientes::orderBy('idpaciente', 'DESC')->get(); 
    
        return view('ingresopaciente.create', ['tipodocumentos' => $tipodocumentos, 'titulo' => 'Admisión', 'titulo_pagina' => 'Admisión']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
          $paciente = Pacientes::where('numerodocumento', $request->numerodocumento)->get();
          
          if (count($paciente) > 0) {

            if ($request->idpaciente != NULL) {
               
                $paciente = Pacientes::where('idpaciente', '=', $request->idpaciente)->first();
                //$date = date_create($request->fechanacimiento); 
                //$fechaseteada = date_format($date, 'Y-m-d');
                $paciente->idtipodocumento = $request->idtipodocumento;
                $paciente->numerodocumento = $request->numerodocumento;
                $paciente->nombrepaciente = $request->primernombre.' '.$request->segundonombre.' '.$request->primerapellido.' '.$request->segundoapellido;
                $paciente->primernombre = $request->primernombre;
                $paciente->segundonombre = $request->segundonombre;
                $paciente->primerapellido = $request->primerapellido;
                $paciente->segundoapellido = $request->segundoapellido;
                $paciente->fechanacimiento = invertirFecha($request->fechanacimiento);
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
                $paciente->creadopor = Auth::user()->id;

                if ($paciente->save()) {

                    $data = new IngresoPaciente;
                    $data->idinstitucionips = 1;
                    $data->idpaciente = $paciente->idpaciente;
                    $data->idsexo = $request->idsexo;
                    $data->edad = $request->edad;
                    $data->idestadocivil = $request->idestadocivil;
                    $data->idocupacion = $request->idocupacion;
                    $data->idreligion = $request->idreligion;
                    $data->numerotelefonofijo = $request->numerotelefonofijo;
                    $data->numerocelular = $request->numerocelular;
                    $data->email = $request->email;
                    $data->idbarrio = $request->idbarrio;
                    $data->idmunicipio = $request->idmunicipio;
                    $data->idzonaresidencial = $request->idzonaresidencial;
                    $data->idinstitucioneapb = $request->idinstitucioneapb;
                    $data->idconvenio = $request->idconvenio;
                    $data->idregimen = $request->idregimen;
                    $data->idtipoafiliacion = $request->idtipoafiliacion;
                    $data->idnivel = $request->idnivel;
                    $data->fechaingreso = $request->fechaingreso;
                    $data->horaingreso = $request->horaingreso;
                    $data->idviaingreso = $request->idviaingreso;
                    $data->institucionremite = $request->institucionremite;
                    $data->idorigenatencion = $request->idorigenatencion;
                    $data->nombreacompanante = $request->nombreacompanante;
                    $data->direccionacompanante = $request->direccionacompanante;
                    $data->telefonoacompanante = $request->telefonoacompanante;
                    $data->idmunicipioacompanante = $request->ciudadacompid;
                    $data->idtipoatencion = $request->idtipoatencion;
                    //$data->iddiagnostico = 1;
                    //$data->iddiagnostico1 = 1;
                    //$data->iddiagnostico2 = 1;
                    //$data->iddiagnostico3 = 1;
                    //$data->iddiagnosticoalt = 1;
                    //$data->idetiologia = 1;
                    //$data->diasincapacidad = 1;
                    //$data->descripcionincapacidad = '';
                    //$data->admisionactivahc = 1;
                    
                    $data->creadopor = Auth::user()->id;
                    $data->fechacreacion = date('Y-m-d h:m:s');  

                     if ($data->save()) {
                        Session::flash('flash_message', 'Actualización y Registro del Paciente agregada correctamente!');
                        return redirect()->back();
                    }else{
                        Session::flash('flash_message', 'Error al Actualizar el Registro del Paciente');
                        return redirect()->back();
                    }
                }    
            }else{

                $data = new IngresoPaciente;
                //$date = date_create($request->fechaingreso); 
                //$fechaseteada = date_format($date, 'Y-m-d');
                $data->idinstitucionips = 1;
                $data->idpaciente = $paciente[0]->idpaciente;
                $data->idsexo = $request->idsexo;
                $data->edad = $request->edad;
                $data->idestadocivil = $request->idestadocivil;
                $data->idocupacion = $request->idocupacion;
                $data->idreligion = $request->idreligion;
                $data->numerotelefonofijo = $request->numerotelefonofijo;
                $data->numerocelular = $request->numerocelular;
                $data->email = $request->email;
                $data->idbarrio = $request->idbarrio;
                $data->idmunicipio = $request->idmunicipio;
                $data->idzonaresidencial = $request->idzonaresidencial;
                $data->idinstitucioneapb = $request->idinstitucioneapb;
                $data->idconvenio = $request->idconvenio;
                $data->idregimen = $request->idregimen;
                $data->idtipoafiliacion = $request->idtipoafiliacion;
                $data->idnivel = $request->idnivel;
                $data->fechaingreso = invertirFecha($request->fechaingreso);
                $data->horaingreso = $request->horaingreso;
                $data->idviaingreso = $request->idviaingreso;
                $data->institucionremite = $request->institucionremite;
                $data->idorigenatencion = $request->idorigenatencion;
                $data->nombreacompanante = $request->nombreacompanante;
                $data->direccionacompanante = $request->direccionacompanante;
                $data->telefonoacompanante = $request->telefonoacompanante;
                $data->idmunicipioacompanante = $request->ciudadacompid;
                $data->idtipoatencion = $request->idtipoatencion;
                /*$data->iddiagnostico = 1;
                $data->iddiagnostico1 = 1;
                $data->iddiagnostico2 = 1;
                $data->iddiagnostico3 = 1;
                $data->iddiagnosticoalt = 1;
                $data->idetiologia = 1;
                $data->diasincapacidad = 1;
                $data->descripcionincapacidad = 'villa';
                $data->admisionactivahc = 1;*/
                
                $data->creadopor = Auth::user()->id;
                $data->fechacreacion = date('Y-m-d h:m:s');  

                 if ($data->save()) {
                    Session::flash('flash_message', 'Ingreso Paciente agregada correctamente!');
                    return redirect()->back();
                }else{
                    Session::flash('flash_message', 'Error al guardar el Ingreso del Paciente');
                    return redirect()->back();
                }
            }
          }else{

                $paciente = new Pacientes;
                //$date = date_create($request->fechanacimiento); 
                //$fechaseteada = date_format($date, 'Y-m-d');
                $paciente->idtipodocumento = $request->idtipodocumento;
                $paciente->numerodocumento = $request->numerodocumento;
                $paciente->nombrepaciente = $request->primernombre.' '.$request->segundonombre.' '.$request->primerapellido.' '.$request->segundoapellido;
                $paciente->primernombre = $request->primernombre;
                $paciente->segundonombre = $request->segundonombre;
                $paciente->primerapellido = $request->primerapellido;
                $paciente->segundoapellido = $request->segundoapellido;
                $paciente->fechanacimiento = invertirFecha($request->fechanacimiento);
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
                $paciente->creadopor = Auth::user()->id;

                if ($paciente->save()) {

                    $data = new IngresoPaciente;
                    $data->idinstitucionips = 1;
                    $data->idpaciente = $paciente->idpaciente;
                    $data->idsexo = $request->idsexo;
                    $data->edad = $request->edad;
                    $data->idestadocivil = $request->idestadocivil;
                    $data->idocupacion = $request->idocupacion;
                    $data->idreligion = $request->idreligion;
                    $data->numerotelefonofijo = $request->numerotelefonofijo;
                    $data->numerocelular = $request->numerocelular;
                    $data->email = $request->email;
                    $data->idbarrio = $request->idbarrio;
                    $data->idmunicipio = $request->idmunicipio;
                    $data->idzonaresidencial = $request->idzonaresidencial;
                    $data->idinstitucioneapb = $request->idinstitucioneapb;
                    $data->idconvenio = $request->idconvenio;
                    $data->idregimen = $request->idregimen;
                    $data->idtipoafiliacion = $request->idtipoafiliacion;
                    $data->idnivel = $request->idnivel;
                    $data->fechaingreso = $request->fechaingreso;
                    $data->horaingreso = $request->horaingreso;
                    $data->idviaingreso = $request->idviaingreso;
                    $data->institucionremite = $request->institucionremite;
                    $data->idorigenatencion = $request->idorigenatencion;
                    $data->nombreacompanante = $request->nombreacompanante;
                    $data->direccionacompanante = $request->direccionacompanante;
                    $data->telefonoacompanante = $request->telefonoacompanante;
                    $data->idmunicipioacompanante = $request->ciudadacompid;
                    $data->idtipoatencion = $request->idtipoatencion;
                    /*$data->iddiagnostico = 1;
                    $data->iddiagnostico1 = 1;
                    $data->iddiagnostico2 = 1;
                    $data->iddiagnostico3 = 1;
                    $data->iddiagnosticoalt = 1;
                    $data->idetiologia = 1;
                    $data->diasincapacidad = 1;
                    $data->descripcionincapacidad = 'villa';
                    $data->admisionactivahc = 1;*/
                    
                    $data->creadopor = Auth::user()->id;
                    $data->fechacreacion = date('Y-m-d h:m:s');  

                     if ($data->save()) {
                        Session::flash('flash_message', 'Ingreso y Registro del Paciente agregada correctamente!');
                        return redirect()->back();
                    }else{
                        Session::flash('flash_message', 'Error al guardar el Ingreso y Registro del Paciente');
                        return redirect()->back();
                    }

                }else{
                    Session::flash('flash_message', 'Error al guardar el Paciente');
                    return redirect()->route('crear-paciente');
                }
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
        $tipodocumentos = TipoDocumentos::orderBy('idtipodocumento', 'DESC')->get(); 
        $admision = IngresoPaciente::Join('paciente', 'admision.idpaciente', '=', 'paciente.idpaciente')
        ->where('admision.idadmision', $id)->first();
        return view('ingresopaciente.edit', ['admision' => $admision, 'tipodocumentos' => $tipodocumentos, 'titulo' => 'Editar Ingreso Paciente', 'titulo_pagina' => 'Editar Ingreso Paciente']);
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
            $data = IngresoPaciente::where('idadmision', '=', $id)->first();
            $data->idinstitucionips = 1;
            $data->fechaingreso = $request->fechaingreso;
            $data->horaingreso = $request->horaingreso;
            $data->idviaingreso = $request->idviaingreso;
            $data->institucionremite = $request->institucionremite;
            $data->idorigenatencion = $request->idorigenatencion;
            $data->nombreacompanante = $request->nombreacompanante;
            $data->direccionacompanante = $request->direccionacompanante;
            $data->telefonoacompanante = $request->telefonoacompanante;
            $data->idmunicipioacompanante = $request->ciudadacompid;
            $data->idtipoatencion = $request->idtipoatencion;
            /*$data->iddiagnostico = 1;
            $data->iddiagnostico1 = 1;
            $data->iddiagnostico2 = 1;
            $data->iddiagnostico3 = 1;
            $data->iddiagnosticoalt = 1;
            $data->idetiologia = 1;
            $data->diasincapacidad = 1;
            $data->descripcionincapacidad = 'villa';
            $data->admisionactivahc = 1;*/
            $data->modificadopor = Auth::user()->id;
            $data->fechaultmodificacion = date('Y-m-d h:m:s');

        if ($data->save()) {
            Session::flash('flash_message', ' Ingreso Paciente Editado correctamente!');
            return redirect()->back();
        }else{
            Session::flash('flash_message', 'Error al Editar el Ingreso Paciente');
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
        $data = IngresoPaciente::where('idadmision', '=', $id)->first();
        if ($data->delete()) {
           Session::flash('flash_message', 'Ingreso Paciente Eliminada correctamente!');
           return redirect()->back();
        }else{
           Session::flash('flash_message', 'Error al Eliminar el Ingreso Paciente!');
           return redirect()->back();
        }   
    }

     public function get_pacientes(Request $request){
         
         if($request->ajax()){
            $pacientes = Pacientes::select('idpaciente', 'numerodocumento', 'nombrepaciente')->where('idtipodocumento', $request->idtipodocumento)->orderBy('idpaciente', 'DESC')->get();
             _json($pacientes);
         }
    }

    public function get_datapaciente(Request $request){
         
         if($request->ajax()){
            
            $pacientes = Pacientes::select('idpaciente', 'numerodocumento', 'nombrepaciente', 'primernombre','segundonombre','primerapellido','segundoapellido','idinstitucioneapb','idregimen','idtipoafiliacion','idnivel','fechanacimiento','idsexo','idestadocivil','idgruposanguineo','idocupacion','direccion','numerotelefonofijo','numerocelular','email','idbarrio','idzonaresidencial','idreligion','idmunicipionacimiento')->where('idpaciente', $request->idpaciente)->first();


            $municipiosnacimiento = Municipios::select('idmunicipio', 'iddepartamento')->where('idmunicipio',$pacientes->idmunicipionacimiento)->first();

            if (count($municipiosnacimiento) > 0) {
                
                $departamentonacimiento = $municipiosnacimiento->iddepartamento;

            }else{

                $departamentonacimiento = '';
            }

            $municipiosdireccion = Municipios::select('idmunicipio', 'iddepartamento')->where('idmunicipio',$pacientes->idmunicipio)->get();

            if (count($municipiosdireccion) > 0) {
                
                $departamentodireccion = $municipiosdireccion->iddepartamento;

            }else{

                $departamentodireccion = '';
            }

            if (count($pacientes) > 0) {
                    $pacientes->edad = $this->calcularedad($pacientes->fechanacimiento);
                    $pacientes->departamentoid = $departamentonacimiento;
                    $pacientes->departamentoiddireccion = $departamentodireccion;
                    $data[] = $pacientes;
            }else{
                 $data =  [];
            }

             _json($data);    
         }
    }

    function calcularedad($fecha){

       $date = date_create($fecha); 
       $fechaseteada = date_format($date, 'Y-m-d');

           $fechanacimiento = $fechaseteada;
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
            return  $ano_diferencia;
    }

    public function get_entidades(Request $request){
         
         if($request->ajax()){
            $entidades = Instituciones::select('idinstitucioneapb', 'nombreinstitucioneapb')->get();
             _json($entidades);
         }
    }

    public function get_convenios(Request $request){
         
         if($request->ajax()){
             $convenios = Convenios::where('idinstitucioneapb', $request->idinstitucioneapb)->get();
             _json($convenios);
         }
    }

    public function get_regimen(Request $request){
         
         if($request->ajax()){
             $regimen = Regimen::get();
             _json($regimen);
         }
    }

    public function get_afiliacion(Request $request){
         
         if($request->ajax()){
             $afiliacion = TipoAfiliacion::get();
             _json($afiliacion);
         }
    }

    public function get_nivel(Request $request){
         
         if($request->ajax()){
             $nivel = Nivel::get();
             _json($nivel);
         }
    }

    public function get_departamentos(Request $request){
         
         if($request->ajax()){
             $departamento = Departamentos::get();
             _json($departamento);
         }
    }

    public function get_sexos(Request $request){
         
         if($request->ajax()){
             $sexos = Sexo::get();
             _json($sexos);
         }
    }

    public function get_estadocivil(Request $request){
         
         if($request->ajax()){
             $civil = EstadoCivil::get();
             _json($civil);
         }
    }

    public function get_gruposanguinio(Request $request){
         
         if($request->ajax()){
             $grupo = GrupoSanguinio::get();
             _json($grupo);
         }
    }

    public function get_religion(Request $request){
         
         if($request->ajax()){
             $religion = Religion::get();
             _json($religion);
         }
    }

    public function get_ocupacion(Request $request){
         
         if($request->ajax()){
             $ocupacion = Ocupacion::get();
             _json($ocupacion);
         }
    } 

    public function get_barrios(Request $request){
         
         if($request->ajax()){
             $barrios = Barrios::get();
             _json($barrios);
         }
    }

    public function get_zonas(Request $request){
         
         if($request->ajax()){
             $zonas = ZonaResidencial::get();
             _json($zonas);
         }
    } 

    public function get_viasingreso(Request $request){
         
         if($request->ajax()){
             $viaingreso = ViaIngreso::get();
             _json($viaingreso);
         }
    }

    public function get_origenatencion(Request $request){
         
         if($request->ajax()){
             $origen = OrigenAtencion::get();
             _json($origen);
         }
    } 

    public function get_tipoatencion(Request $request){
         
         if($request->ajax()){
             $atencion = TipoAtencion::get();
             _json($atencion);
         }
    } 
}
