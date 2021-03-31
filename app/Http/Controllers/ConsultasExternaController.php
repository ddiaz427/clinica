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
use App\Models\ExamenFisico;
use App\Models\Estado;
use App\Models\ExamenFisicoPaciente;
use App\Models\Procedimiento;
use App\Models\AdmisionProcedimiento;
use App\Models\Antecedente;
use App\Models\AdmisionAntecedente;
use App\Models\Diagnostico;
use App\Models\TipoDiagnostico;
use App\Models\DiagnosticoAlt;
use App\Models\Etiologia;
use App\Models\Especialidad;
use App\Models\AdmisionRemision;
use App\Models\TipoOrden;
use App\Models\AdmisionOrden;
use App\Models\DetalleAdmisionOrden;

class ConsultasExternaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
        return view('consultaexterna.index', ['ingresopaciente' => $ingreso, 'titulo' => 'Consulta Externa', 'titulo_pagina' => 'Consulta Externa']);
    }


    public function ver_consultas_paciente($id){

        $admision = IngresoPaciente::Join('paciente', 'admision.idpaciente', '=', 'paciente.idpaciente')
        ->select('paciente.idpaciente','admision.idadmision')
        ->where('admision.idadmision', $id)
        ->first();
        return view('consultaexterna.ver_consultas_paciente', ['titulo' => 'Ver Consulta Paciente', 'titulo_pagina' => 'Ver Consulta Paciente', 'ingreso' => $admision]);
    }

    public function admision(Request $request){

        $tipodocumentos = TipoDocumentos::orderBy('idtipodocumento', 'DESC')->get(); 
        $admision = IngresoPaciente::Join('paciente', 'admision.idpaciente', '=', 'paciente.idpaciente')
        ->where(['admision.idadmision' => $request->admision_id, 'admision.idpaciente' => $request->pacienteid])->first();
        return view('consultaexterna.tab.admision', ['admision' => $admision, 'tipodocumentos' => $tipodocumentos, 'admisionid' => $request->admision_id]);
    }

    public function admisionsubmit(Request $request){
        //dd($request->all()); 
        if($request->ajax()){
            
            $data = IngresoPaciente::where('idadmision', '=', $request->admisionid)->first();
            $data->idinstitucionips = 1;
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
            $data->iddiagnostico = 0;
            $data->iddiagnostico1 = 0;
            $data->iddiagnostico2 = 0;
            $data->iddiagnostico3 = 0;
            $data->iddiagnosticoalt = 0;
            $data->idetiologia = 0;
            $data->diasincapacidad = 0;
            //$data->descripcionincapacidad = 'villa';
            $data->admisionactivahc = 1;
            $data->modificadopor = Auth::user()->id;
            $data->fechaultmodificacion = date('Y-m-d h:m:s');

            if ($data->save()) {

                 _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

            }else{

                 _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

            } 
         }else{
            return redirect()->back();
         }   
    }

    public function enfermedad(Request $request){
            
         $procedimiento = Procedimiento::select('idprocedimiento','nombreprocedimiento')->orderBy('idprocedimiento', 'ASC')->get();   

         $examenfisico = ExamenFisico::orderBy('idexamenfisico', 'ASC')->get(); 
         $estado = Estado::get(); 
         
         $admisionprocedimiento = Admisionprocedimiento::Join('procedimiento', 'admisionprocedimiento.idprocedimiento', '=', 'procedimiento.idprocedimiento')->select('admisionprocedimiento.idprocedimiento','admisionprocedimiento.fechaprocedimiento','admisionprocedimiento.horaprocedimiento', 'admisionprocedimiento.motivoconsulta', 'admisionprocedimiento.enfermedadactual','admisionprocedimiento.revisionsistemas','admisionprocedimiento.temperatura','admisionprocedimiento.tasentadosistolica','admisionprocedimiento.tasentadodiastolica','admisionprocedimiento.frecuenciacardiaca','admisionprocedimiento.frecuenciarespiratoria','admisionprocedimiento.talla','admisionprocedimiento.peso','admisionprocedimiento.imc','admisionprocedimiento.amputadas','procedimiento.nombreprocedimiento')
         ->where('admisionprocedimiento.idadmision', '=', $request->admision_id)
         ->first();

         $examenfisicodata = ExamenFisicoPaciente::where('idadmision', '=', $request->admision_id)->get();

         return view('consultaexterna.tab.enfermedad', ['admisionid' => $request->admision_id, 'examenfisico' => $examenfisico, 'estado' => $estado, 'procedimiento' => $procedimiento, 'admisionprocedimiento' => $admisionprocedimiento, 'examenfisicodata' => $examenfisicodata]);
    }

    public function enfermedadsubmit(Request $request){
        
        if($request->ajax()){

            $admisionprocedimiento = AdmisionProcedimiento::onlyTrashed()->orderBy('idadmision', 'DESC')->where('idadmision', $request->admisionid)->first();

            if (count($admisionprocedimiento) > 0) {

                $dataprocedimiento = new AdmisionProcedimiento;
                $dataprocedimiento->idadmision = $request->admisionid;
                $dataprocedimiento->idinstitucionips = 1;
                $dataprocedimiento->idadmisionprocedimiento = $admisionprocedimiento->idadmisionprocedimiento + 1;
                $dataprocedimiento->idprocedimiento = $request->procedimientoid;
                $dataprocedimiento->fechaprocedimiento = invertirFecha($request->fechaconsulta);
                $dataprocedimiento->horaprocedimiento = $request->hora;
                $dataprocedimiento->motivoconsulta = $request->motivoconsulta;
                $dataprocedimiento->enfermedadactual = $request->enfermedadactual;
                $dataprocedimiento->revisionsistemas = $request->revisionsistemas;
                $dataprocedimiento->temperatura = $request->temperatura;
                $dataprocedimiento->tasentadosistolica = $request->tasentadosistolica;
                $dataprocedimiento->tasentadodiastolica = $request->tasentadodiastolica;
                $dataprocedimiento->frecuenciacardiaca = $request->frecuenciacardiaca;
                $dataprocedimiento->frecuenciarespiratoria = $request->frecuenciarespiratoria;
                $dataprocedimiento->talla = $request->talla;
                $dataprocedimiento->peso = $request->peso;
                $dataprocedimiento->imc = $request->imc;
                $dataprocedimiento->amputadas = $request->amputadas;
                $dataprocedimiento->creadopor = Auth::user()->id;
                $dataprocedimiento->fechacreacion = date('Y-m-d h:m:s');  
                $dataprocedimiento->save();

            }else{

                $dataprocedimiento = new AdmisionProcedimiento;
                $dataprocedimiento->idadmision = $request->admisionid;
                $dataprocedimiento->idinstitucionips = 1;
                $dataprocedimiento->idadmisionprocedimiento = 1;
                $dataprocedimiento->idprocedimiento = $request->procedimientoid;
                $dataprocedimiento->fechaprocedimiento = invertirFecha($request->fechaconsulta);
                $dataprocedimiento->horaprocedimiento = $request->hora;
                $dataprocedimiento->motivoconsulta = $request->motivoconsulta;
                $dataprocedimiento->enfermedadactual = $request->enfermedadactual;
                $dataprocedimiento->revisionsistemas = $request->revisionsistemas;
                $dataprocedimiento->temperatura = $request->temperatura;
                $dataprocedimiento->tasentadosistolica = $request->tasentadosistolica;
                $dataprocedimiento->tasentadodiastolica = $request->tasentadodiastolica;
                $dataprocedimiento->frecuenciacardiaca = $request->frecuenciacardiaca;
                $dataprocedimiento->frecuenciarespiratoria = $request->frecuenciarespiratoria;
                $dataprocedimiento->talla = $request->talla;
                $dataprocedimiento->peso = $request->peso;
                $dataprocedimiento->imc = $request->imc;
                $dataprocedimiento->amputadas = $request->amputadas;
                $dataprocedimiento->creadopor = Auth::user()->id;
                $dataprocedimiento->fechacreacion = date('Y-m-d h:m:s');  
                $dataprocedimiento->save();
            }

            $examenpaciente = ExamenFisicoPaciente::where('idadmision', $request->admisionid)->get();
              
              if (count($examenpaciente) > 0) {
                    //echo "hay datos admision";
                    $data = ExamenFisicoPaciente::where('idadmision', '=', $request->admisionid)->first();
            
                    if ($data->delete()) {

                         foreach($request->examenfisicoid as $key => $value){

                            $data = new ExamenFisicoPaciente;
                            $data->idadmision = $request->admisionid;
                            $data->idinstitucionips = 1;
                            $data->idadmisionprocedimiento = 0;
                            $data->idexamenfisico = $value;
                            $data->idestado = $request->estadoid[$key];
                            $data->descripcion = $request->descripcionexamen[$key];
                            $data->creadopor = Auth::user()->id;
                            $data->fechacreacion = date('Y-m-d h:m:s');  

                            $datarespuesta = $data->save();
                        }

                        if ($datarespuesta) {

                             _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                        }else{
                            _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al actualizar los datos</div>']);
                        }

                    }else{
                       _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Borrar la información </div>']);
                    }   
              }else{

                    foreach($request->examenfisicoid as $key => $value){

                        $data = new ExamenFisicoPaciente;
                        $data->idadmision = $request->admisionid;
                        $data->idinstitucionips = 1;
                        $data->idadmisionprocedimiento = 0;
                        $data->idexamenfisico = $value;
                        $data->idestado = $request->estadoid[$key];
                        $data->descripcion = $request->descripcionexamen[$key];
                        $data->creadopor = Auth::user()->id;
                        $data->fechacreacion = date('Y-m-d h:m:s');  

                        $datarespuesta = $data->save();
                    }

                    if ($datarespuesta) {

                         _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                    }else{
                         _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al actualizar los datos</div>']);
                    }
              }
         }else{

             return redirect()->back();
         }     
    }

    public function antecedentes(Request $request){
         $antecedentes = Antecedente::get(); 
         $admisionantecedente = AdmisionAntecedente::where('idadmision', $request->admision_id)->get();
         return view('consultaexterna.tab.antecedentes', ['admisionid' => $request->admision_id, 'antecedentes' => $antecedentes, 'dataantecedente' => $admisionantecedente]);
    }

    public function antecedentesubmit(Request $request){
        
        if($request->ajax()){  

            $admisionantecedente = AdmisionAntecedente::where('idadmision', $request->admisionid)->get();

            if (count($admisionantecedente) > 0) {
                
                $data = AdmisionAntecedente::where('idadmision', '=', $request->admisionid)->first();
            
                if ($data->delete()) {

                    foreach($request->antecedentesid as $key => $value){

                        $data = new AdmisionAntecedente;
                        $data->idadmision = $request->admisionid;
                        $data->idinstitucionips = 1;
                        $data->idantecedente = $value;
                        $data->estado = $request->estado[$key];
                        $data->descripcion = $request->descripcionantecedente[$key];
                        $data->creadopor = Auth::user()->id;
                        $data->fechacreacion = date('Y-m-d h:m:s');  

                        $datarespuesta = $data->save();
                    }

                    if ($datarespuesta) {

                         _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                    }else{
                         _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al actualizar los datos</div>']);
                    }
                }else{
                     _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Borrar la información </div>']);
                }

            }else{

                 foreach($request->antecedentesid as $key => $value){

                        $data = new AdmisionAntecedente;
                        $data->idadmision = $request->admisionid;
                        $data->idinstitucionips = 1;
                        $data->idantecedente = $value;
                        $data->estado = $request->estado[$key];
                        $data->descripcion = $request->descripcionantecedente[$key];
                        $data->creadopor = Auth::user()->id;
                        $data->fechacreacion = date('Y-m-d h:m:s');  

                        $datarespuesta = $data->save();
                    }

                    if ($datarespuesta) {

                         _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                    }else{
                         _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al actualizar los datos</div>']);
                    }
            }
        }else{

             return redirect()->back();
        }    

    }

    public function ayudaddiag(Request $request){
         return view('consultaexterna.tab.ayudaddiag', ['admisionid' => $request->admision_id]);
    }

    public function ayudadiagsubmit(Request $request){

        if($request->ajax()){

            if ($request->idadmisionprocedimiento != NULL){
                
                if ($request->procedimientoid != NULL) {

                    $data = AdmisionProcedimiento::where('idadmisionprocedimiento', '=', $request->idadmisionprocedimiento )->where('idadmision', '=', $request->admisionid)->first();
                    $data->idprocedimiento = $request->procedimientoid;
                    $data->fechaprocedimiento = $request->fechaprocedimiento;
                    $data->horaprocedimiento = $request->horaprocedimiento;

                    if ($data->save()) {

                        _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);
                        # code...
                    }else{

                        _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

                    }                # code...
                }else{
                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Seleccione un diagnostico</div>']);
                }
            }else{
                //echo "viene a guardar";
                //echo "<pre>";
                //print_r($request->all());  

                if ($request->procedimientoid != NULL) {
                
                    $admisionorden = AdmisionOrden::onlyTrashed()->where('idadmision', $request->admisionid)->orderBy('idadmisionorden', 'DESC')->first();
                    $data = new AdmisionProcedimiento;
                    $data->idadmision = $request->admisionid;
                    $data->idprocedimiento = $request->procedimientoid;
                    $data->fechaprocedimiento = $request->fechaprocedimiento;
                    $data->horaprocedimiento = $request->horaprocedimiento;
                    $data->idadmisionprocedimiento = (count($admisionorden) > 0) ? $admisionorden->idadmisionorden+1 : 1;
                    
                    if ($data->save()) {

                        _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Guardados Correctamente</div>']);
                        # code...
                    }else{

                        _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Guardar los datos</div>']);

                    }
              }else{
                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Seleccione un diagnostico</div>']);
                }  
            }    
        }else{

            return redirect()->back();
        }
    }

    public function getadmisionprocedimiento(Request $request){
      
        if($request->ajax()){    
            
            $admisionorder = AdmisionProcedimiento::Join('procedimiento', 'admisionprocedimiento.idprocedimiento', '=', 'procedimiento.idprocedimiento')->where('admisionprocedimiento.idadmision', '=', $request->admisionid)->orderBy('admisionprocedimiento.idadmisionprocedimiento', 'DESC')->get();
            _json(['dato' => $admisionorder]);

        }else{
            return redirect()->back();
        }    
    }

    public function deleteprocedimiento(Request $request){

        if($request->ajax()){

             $data = AdmisionProcedimiento::where('idadmisionprocedimiento', '=', $request->procedimientoid)->first();

            if ($data->delete()) {
                _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Borrados Correctamente</div>']);
            }else{

                _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Borrar los datos seleccionados</div>']);
            }
        }else{
            return redirect()->back();
        }
    }

    public function editprocedimiento(Request $request){
       if($request->ajax()){     
            
            $data = AdmisionProcedimiento::Join('procedimiento', 'admisionprocedimiento.idprocedimiento', '=', 'procedimiento.idprocedimiento')->where('admisionprocedimiento.idadmision', '=', $request->admisionid)->where('admisionprocedimiento.idadmisionprocedimiento', '=', $request->procedimientoid)->first();
            _json(['dato' => $data]);

        }else{

            return redirect()->back();
        }
        
    }

    public function diagnostico(Request $request){

         $tipodianostico = TipoDiagnostico::get();   
         $diagnostico = Diagnostico::get(); 
         $diagnosticoalt = DiagnosticoAlt::get();
         $etilogia = Etiologia::get();

         $admision = IngresoPaciente::Join('diagnostico as dp1', 'admision.iddiagnostico', '=', 'dp1.iddiagnostico')->Join('diagnostico as dp2', 'admision.iddiagnostico1', '=', 'dp2.iddiagnostico')->Join('diagnostico as dp3', 'admision.iddiagnostico2', '=', 'dp3.iddiagnostico')->Join('diagnostico as dp4', 'admision.iddiagnostico3', '=', 'dp4.iddiagnostico')->select('dp1.nombrediagnostico as diagnosticoprincipal','dp2.nombrediagnostico as diagnosticoprincipal2','dp3.nombrediagnostico as diagnosticoprincipal3','dp4.nombrediagnostico as diagnosticoprincipal4','admision.idtipodiagnostico','admision.iddiagnosticoalt','admision.idetiologia')->where('idadmision', '=', $request->admision_id)->first();

         return view('consultaexterna.tab.diagnostico', ['admisionid' => $request->admision_id, 'diagnostico'=>$diagnostico, 'tipodianostico' => $tipodianostico, 'diagnosticoalt' => $diagnosticoalt, 'etilogia' => $etilogia, 'admision' => $admision]);
    }

    public function diagnosticosubmit(Request $request){

        if($request->ajax()){
            $data = IngresoPaciente::where('idadmision', '=', $request->admisionid)->first();
            $data->iddiagnostico = $request->diagnosticoprincipalid;
            $data->iddiagnostico1 = $request->diagnosticorelacionado1;
            $data->iddiagnostico2 = $request->diagnosticorelacionado2;
            $data->iddiagnostico3 = $request->diagnosticorelacionado3;
            $data->idtipodiagnostico = $request->idtipodiagnostico;
            $data->iddiagnosticoalt = $request->iddiagnosticoalt;
            $data->idetiologia = $request->idetiologia;
            $data->modificadopor = Auth::user()->id;
            $data->fechaultmodificacion = date('Y-m-d h:m:s');

            if ($data->save()) {

                 _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

            }else{

                 _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

            }
         }else{
            return redirect()->back();
         }        
    }

    public function medicamento(Request $request){

        $ordenes = TipoOrden::get(); 
        return view('consultaexterna.tab.medicamento', ['admisionid' => $request->admision_id, 'ordenes' => $ordenes]);
    }

    public function medicamentosubmit(Request $request){
        
        if($request->ajax()){

        	if ($request->idadmisionorden == NULL) {

	            if ($request->procedimientoid[0] != ''){
	          
	                $admisionorden = AdmisionOrden::orderBy('idadmisionorden', 'DESC')->first();
	                $ultimoid = (count($admisionorden) > 0) ? $admisionorden->idadmisionorden + 1 : 1;

	                $data = new AdmisionOrden;
	                $data->idadmisionorden =  $ultimoid;
	                $data->idadmision = $request->admisionid;
	                $data->idinstitucionips = 1;
	                $data->idtipoorden = $request->idtipoorden;
	                $data->fechaorden = invertirFecha($request->fechaorden);
	                $data->horaorden = $request->horaorden;
	                $data->observacion = $request->observacion;
	                $data->creadopor = Auth::user()->id;
	                $data->fechacreacion = date('Y-m-d h:m:s');

	                if ($data->save()) {

	                       foreach($request->procedimientoid as $key => $value){

	                            $data = new DetalleAdmisionOrden;
	                            $data->idadmisionorden = $ultimoid;
	                            $data->idprocedimiento = $value;
	                            $data->cantidad = $request->cantidad[$key];
	                            $data->posologia = $request->posologia[$key];
	                            $data->creadopor = Auth::user()->id;
	                            $data->fechacreacion = date('Y-m-d h:m:s');  
	                            $datarespuesta = $data->save();
	                        }

	                      if ($datarespuesta) {

	                           _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);
	                      }else{

	                           _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al guardar los detalles de la orden</div>']); 
	                      }  
	                }else{

	                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

	                }
	          }else{

	                _json(['response' => false, 'mensaje' => '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Seleccione al menos un Nombre de la lista autocompletable</div>']);

	          }
	       }else{

	       		  $data = AdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->first();
	       		  $data->fechaorden = invertirFecha($request->fechaorden);
	              $data->horaorden = $request->horaorden;
	              $data->observacion = $request->observacion;
	              $data->modificadopor = Auth::user()->id;
	              $data->fechaultmodificacion = date('Y-m-d h:m:s');

	              if ($data->save()) {
	              	 
	              	 foreach($request->procedimientoid as $key => $value){

                            $data2 = DetalleAdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->first();
                            if (count($data2) > 0) {
                                $data2->idprocedimiento = $request->procedimientoid[$key];
                                $data2->cantidad = $request->cantidad[$key];
                                $data2->posologia = $request->posologia[$key];
                                $data2->modificadopor = Auth::user()->id;
                                $data2->fechaultmodificacion = date('Y-m-d h:m:s');  
                                
                                $datarespuesta2 = $data2->save();
                            }
                       }


	                    if ($datarespuesta2) {

	                           _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);
	                      }else{

	                           _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']); 
	                      }     

	              }else{
	              	_json(['response' => false, 'mensaje' => '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al guardar los datos intente mas tarde</div>']);
	              }
	       }     
        }else{
            return redirect()->back();
        }    
    }

    public function editmedicamentoorden(Request $request){
        
        if($request->ajax()){    
            
            $admisionorder = AdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->get();
            
            if (count($admisionorder) > 0) {

	            foreach ($admisionorder as $r) {

            		$r->detalleadmisionorden = $this->detalleadmisionorden($r->idadmisionorden);
            		$datos[] = $r;
	            } 
	                 
            }else{
            	$datos = [];
            }

            _json(['dato' => $datos]);

        }else{
            return redirect()->back();
        }    
    }

    public function deleteadmision(Request $request){

        if($request->ajax()){
        
            $data = AdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->first();
            if ($data->delete()) {

                $data2 = DetalleAdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->get();

                if ($data2->delete()) {

                    _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Borrado Correctamente</div>']);
                }else{

                    _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Borrar los datos Detalle Orden</div>']);
                }

            }else{

              _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Borrar los datos</div>']);
            }
        }else{
            return redirect()->back();
        }     
    }

    public function getmedicamentoconsulta(Request $request){
      
        if($request->ajax()){    
            
            $admisionorder = AdmisionOrden::where('idadmision', '=', $request->admisionid)->where('idtipoorden', '=', $request->idtipoorden)->orderBy('idadmisionorden', 'DESC')->get();
            
            if (count($admisionorder) > 0) {

	            foreach ($admisionorder as $r) {

            		$r->detalleadmisionorden = $this->detalleadmisionorden($r->idadmisionorden);
            		$datos[] = $r;
	            } 

            }else{
            	$datos = [];
            }

            _json(['dato' => $datos]);

        }else{
            return redirect()->back();
        }    
    }

    public function detalleadmisionorden($id=NULL){

    	if($id){

    		 $detalleadmisionorden = DetalleAdmisionOrden::Join('procedimiento', 'detalleadmisionorden.idprocedimiento', '=', 'procedimiento.idprocedimiento')->where('detalleadmisionorden.idadmisionorden', '=', $id)->get();

    		 if(count($detalleadmisionorden) > 0){

    		 	return $detalleadmisionorden;

    		 }else{
    		 	return [];
    		 }

    	}else{
    		return redirect()->back();
    	}

    }

    public function procedimiento(Request $request){
        return view('consultaexterna.tab.procedimiento', ['admisionid' => $request->admision_id]);
    }

    public function procedimientosubmit(Request $request){
        
        if($request->ajax()){  

        	if ($request->idadmisionorden == NULL) {

	            if ($request->procedimientoid[0] != ''){

	                $admisionorden = AdmisionOrden::orderBy('idadmisionorden', 'DESC')->first();
	                $ultimoid = (count($admisionorden) > 0) ? $admisionorden->idadmisionorden+1 : 1;
	                $data = new AdmisionOrden;
	                $data->idadmisionorden =  $ultimoid;
	                $data->idadmision = $request->admisionid;
	                $data->idinstitucionips = 1;
	                $data->idtipoorden = $request->idtipoorden;
	                $data->fechaorden = invertirFecha($request->fechaorden);
	                $data->horaorden = $request->horaorden;
	                $data->observacion = $request->observacion;
	                $data->creadopor = Auth::user()->id;
	                $data->fechacreacion = date('Y-m-d h:m:s');

	                if ($data->save()) {

	                       foreach($request->procedimientoid as $key => $value){

	                            $data = new DetalleAdmisionOrden;
	                            $data->idadmisionorden = $ultimoid;
	                            $data->idprocedimiento = $value;
	                            $data->cantidad = $request->cantidad[$key];
	                            $data->posologia = $request->posologia[$key];
	                            $data->creadopor = Auth::user()->id;
	                            $data->fechacreacion = date('Y-m-d h:m:s');  
	                            $datarespuesta = $data->save();
	                        }

	                      if ($datarespuesta) {

	                           _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);
	                      }else{

	                           _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al guardar los detalles de la orden</div>']); 
	                      }  
	                }else{

	                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

	                }
	          }else{

	                _json(['response' => false, 'mensaje' => '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Seleccione al menos un Nombre de la lista autocompletable</div>']);

	          }
	      }else{
      	 		 $data = AdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->first();
	       		  $data->fechaorden = invertirFecha($request->fechaorden);
	              $data->horaorden = $request->horaorden;
	              $data->observacion = $request->observacion;
	              $data->modificadopor = Auth::user()->id;
	              $data->fechaultmodificacion = date('Y-m-d h:m:s');

	              if ($data->save()) {
	              	 
	              	 foreach($request->procedimientoid as $key => $value){

                            $data2 = DetalleAdmisionOrden::where('idadmisionorden', '=', $request->idadmisionorden)->first();
                            if (count($data2) > 0) {
                                $data2->idprocedimiento = $request->procedimientoid[$key];
                                $data2->cantidad = $request->cantidad[$key];
                                $data2->posologia = $request->posologia[$key];
                                $data2->modificadopor = Auth::user()->id;
                                $data2->fechaultmodificacion = date('Y-m-d h:m:s');  
                                
                                $datarespuesta2 = $data2->save();
                            }
                       }

	                    if ($datarespuesta2) {

	                           _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);
	                      }else{

	                           _json(['response' => false, 'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']); 
	                      }     

	              }else{
	              	_json(['response' => false, 'mensaje' => '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al guardar los datos intente mas tarde</div>']);
	              }
	      }           
        }else{
            return redirect()->back();
        }    
    }


    public function incapacidad(Request $request){
        
        $especialidad = Especialidad::get(); 
        $admision = IngresoPaciente::where('idadmision', '=', $request->admision_id)->first();
        $admisionremision = AdmisionRemision::where('idadmision', '=', $request->admision_id)->first();
        return view('consultaexterna.tab.incapacidadRemision', ['admisionid' => $request->admision_id, 'especialidad' => $especialidad, 'admision' => $admision, 'admisionremision' => $admisionremision]);
    }

    public function incapacidadsubmit(Request $request){
        
        if($request->ajax()){  
            $data = IngresoPaciente::where('idadmision', '=', $request->admisionid)->first();

            $data->diasincapacidad = $request->diasincapacidad;
            $data->descripcionincapacidad = $request->descripcionincapacidad;

            if ($data->save()) {

                 _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

            }else{

                 _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

            }
        }else{
            return redirect()->back();
        }        
    }

    public function remisionsubmit(Request $request){
         
         if($request->ajax()){
             $data = AdmisionRemision::where('idadmision', '=', $request->admisionid)->first();

             if(count($data) > 0){

                    $data->idadmision = $request->admisionid;
                    $data->idinstitucionips = 1;
                    $data->fecharemision = invertirFecha($request->fecharemision);
                    $data->horaremision = $request->horaremision;
                    $data->idespecialidad = $request->idespecialidad;
                    $data->descripcionremision = $request->descripcionincapacidad;
                    $data->fechacreacion = date('Y-m-d h:m:s');
                    $data->creadopor = Auth::user()->id;
                    
                    if ($data->save()) {

                     _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                }else{

                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

                } 
           }else{
                    $data = new AdmisionRemision;
                    $data->idadmision = $request->admisionid;
                    $data->idinstitucionips = 1;
                    $data->fecharemision = invertirFecha($request->fecharemision);
                    $data->horaremision = $request->horaremision;
                    $data->idespecialidad = $request->idespecialidad;
                    $data->descripcionremision = $request->descripcionincapacidad;
                    $data->fechacreacion = date('Y-m-d h:m:s');
                    $data->creadopor = Auth::user()->id;
                    
                    if ($data->save()) {

                     _json(['response' => true, 'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Datos Actualizados Correctamente</div>']);

                }else{

                     _json(['response' => false, 'mensaje' => '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error al Actualizar los datos</div>']);

                } 
           }
        }else{
            return redirect()->back();
        }     
    }

    public function get_procedimientos(Request $request){
          if($request->ajax()){    
            $data = Procedimiento::where('nombreprocedimiento','LIKE','%'.$request->buscarprocedimiento.'%')->limit(50)->get(); 
            _json($data);
         }else{
            return redirect()->back();
        }  
    }

    public function get_diagnostico(Request $request){
          if($request->ajax()){    
            $data = Diagnostico::where('nombrediagnostico','LIKE','%'.$request->buscardiagnostico.'%')->limit(50)->get(); 
            _json($data);
         }else{
            return redirect()->back();
        }  
    }
}