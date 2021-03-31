
<ul class="nav nav-tabs">
  <li class="active">
      <a href="#tab1_115030" data-toggle="tab">Admisión</a>
  </li>
</ul>

<div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">
    <div class="tab-pane active" id="tab1_115030">

    <div id="mensaje_alert"></div>    
    <form action="{{ route('admisionsubmit')}}" method="post" id="admisionform" onsubmit="submitform(); return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="<?php echo $admisionid; ?>">

            <div class="col-md-12 text-center">
                 <a type="button" class="btn btn-raised btn-primary btn-xs" data-toggle="collapse" href="#registro-avanzada" aria-expanded="false" aria-controls="registro-avanzada"><i class="fa fa-user" aria-hidden="true"></i> <i class="glyphicon glyphicon-plus" aria-hidden="true"></i></a>
            </div>

            <div class="col-md-6">
               <label>Tipo de Documento  <span class="required"> * </span></label>
              
               <select name="idtipodocumento" class="form-control select2 required" id="idtipodocumento" onchange="getpacientes(this.value, '#pacientes', '{{route('mostrarpacientes')}}');">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($tipodocumentos as $td)
                     <option value="{{ $td['idtipodocumento'] }}" <?php echo (isset($admision->idtipodocumento) and $admision->idtipodocumento == $td['idtipodocumento'])?'selected':''; ?>>{{ $td['nombretipodocumento'] }}</option>
                    @endforeach
               </select>  
            </div>

            <div class="col-md-6">
                <label>Documento  <span class="required"> * </span></label>

                 <input class="form-control bs-autocomplete required" name="numerodocumento" id="paciente" value="{{ old('numerodocumento', (isset($admision->numerodocumento))?$admision->numerodocumento:'') }}" placeholder="Escriba los dos primeros caracteres del Numero de documentos" type="text" data-hidden_field_id="idpaciente" data-item_id="idpaciente" data-item_label="numerodocumento" data-item_label2="nombrepaciente" autocomplete="off">
            </div>

              <input type="hidden" name="idpaciente" id="idpaciente" value="">

              <div class="col-md-12" style="margin-top:30px;"></div>

              <div class="col-md-6">
                <label>Primer Nombre  <span class="required"> * </span></label>
                <input type="text" name="primernombre" value="{{ old('primernombre', (isset($admision->primernombre))?$admision->primernombre:'') }}" class="form-control required" id="primernombre">
              </div>

              <div class="col-md-6">
                <label>Segundo Nombre</label>
                <input type="text" name="segundonombre" value="{{ old('segundonombre', (isset($admision->segundonombre))?$admision->segundonombre:'') }}" class="form-control" id="segundonombre">
              </div>

              <div class="col-md-12" style="margin-top:30px;"></div>

               <div class="col-md-6">
                <label>Primer Apellido  <span class="required"> * </span></label>
                <input type="text" name="primerapellido" value="{{ old('primerapellido', (isset($admision->primerapellido))?$admision->primerapellido:'') }}" class="form-control required" id="primerapellido">
              </div>

               <div class="col-md-6">
                <label>Segundo Apellido</label>
                <input type="text" name="segundoapellido" value="{{ old('segundoapellido', (isset($admision->segundoapellido))?$admision->segundoapellido:'') }}" class="form-control" id="segundoapellido">
              </div>

              <div class="col-md-12" style="margin-top:30px;"></div>


              <div class="collapse" id="registro-avanzada">

                  <div class="col-md-6">
                        <label>Fecha Nacimiento<span class="required"> * </span></label>
                        <input readonly="" type="text" name="fechanacimiento" class="form-control" id="fechanacimiento" onchange="obj_funciones.calcularedad(this.value,'#edad','{{ route('calcularedad')}}')">
                  </div>

                    <div class="col-md-6">
                        <label>Edad<span class="required"> * </span></label>
                        <input type="text" onfocus="this.blur();" name="edad" class="form-control" id="edad">
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>

                    <div class="col-md-6">
                        <label>Dep Nac  <span class="required"> * </span></label>
                        <select readonly="" name="iddepartamento" id="iddepartamento" class="form-control" onchange="obj_funciones.municipios(this.value,'#idmunicipionacimiento', '{{ route('municipios')}}');">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-6">
                        <label>Mun. Nac  <span class="required"> * </span></label>
                        <select readonly="" name="idmunicipionacimiento" id="idmunicipionacimiento" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>

                     <div class="col-md-6">
                        <label>Sexo  <span class="required"> * </span></label>
                        <select readonly="" name="idsexo" id="idsexo" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

   

                     <div class="col-md-6">
                        <label>Estado Civil  <span class="required"> * </span></label>
                        <select readonly="" name="idestadocivil" id="idestadocivil" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>

                     <div class="col-md-6">
                        <label>Grupo Sanguinio  <span class="required"> * </span></label>
                        <select readonly="" name="idgruposanguineo" id="idgruposanguineo" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-6">
                        <label>Religión  <span class="required"> * </span></label>
                        <select readonly="" name="idreligion" id="idreligion" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>

                    <div class="col-md-6">
                        <label>Ocupación  <span class="required"> * </span></label>
                        <select readonly="" name="idocupacion" id="idocupacion" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                     <div class="col-md-6">
                        <label>Dirección<span class="required"> * </span></label>
                        <input readonly="" type="text" name="direccion" class="form-control" id="direccion">
                    </div>


                    <div class="col-md-12" style="margin-top:30px;"></div>

                    <div class="col-md-6">
                        <label>Telefono fijo<span class="required"> * </span></label>
                        <input readonly="" type="text" name="numerotelefonofijo" class="form-control" id="telefono">
                    </div>

                    <div class="col-md-6">
                        <label>Celular</label>
                        <input readonly="" type="text" name="numerocelular" class="form-control" id="celular">
                    </div>


                    <div class="col-md-12" style="margin-top:30px;"></div>


                    <div class="col-md-6">
                        <label>Correo Electrónico<span class="required"> * </span></label>
                        <input readonly="" type="text" name="email" class="form-control" id="email">
                    </div>

                    <div class="col-md-6">
                        <label>Departamento  <span class="required"> * </span></label>
                        <select readonly="" name="departamentodireccion" id="departamentodireccion" class="form-control" onchange="obj_funciones.municipios(this.value,'#idmunicipio', '{{ route('municipios')}}');">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>


                    <div class="col-md-12" style="margin-top:30px;"></div>

                     <div class="col-md-6">
                        <label>Ciudad  <span class="required"> * </span></label>
                        <select readonly="" name="idmunicipio" id="idmunicipio" class="form-control">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>


                    <div class="col-md-6">
                        <label>Barrio  <span class="required"> * </span></label>
                        <select name="idbarrio" id="idbarrio" class="form-control select2" style="width: 100%">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>

                    <div class="col-md-6">
                        <label>Zona  <span class="required"> * </span></label>
                        <select readonly="" name="idzonaresidencial" id="idzonaresidencial" class="form-control select2" style="width: 100%">
                            <option value="" selected="">::Seleccione::</option>
                        </select>    
                    </div>

                    <div class="col-md-12" style="margin-top:30px;"></div>
             </div>


            <div class="col-md-6">
                <label>Entidad de Salud  <span class="required"> * </span></label>
                <select name="idinstitucioneapb" id="entidadsalud" class="form-control select2 required" onchange="obj_funciones.getconvenios(this.value,'#convenios')">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>

            <div class="col-md-6">
                <label>Convenio  <span class="required"> * </span></label>
                <select name="idconvenio" id="convenios" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>

            <div class="col-md-12" style="margin-top:30px;"></div>

            <div class="col-md-6">
                <label>Regimen  <span class="required"> * </span></label>
                <select name="idregimen" id="idregimen" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>

              <div class="col-md-6">
                <label>Tipo de Afiliación  <span class="required"> * </span></label>
                <select name="idtipoafiliacion" id="idtipoafiliacion" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>

            <div class="col-md-12" style="margin-top:30px;"></div>

             <div class="col-md-6">
                <label>Nivel  <span class="required"> * </span></label>
                <select name="idnivel" id="idnivel" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>  
 

            <div class="col-md-6">
                <label>Fecha de Ingreso  <span class="required"> * </span></label>
                <input type="text" name="fechaingreso" value="{{ old('fechaingreso', (isset($admision->fechaingreso))?$admision->fechaingreso:'') }}" id="fechaingreso" class="form-control required">  
            </div> 


            <div class="col-md-12" style="margin-top:30px;"></div> 

            <div class="col-md-6">
                <label>Hora de Ingreso  <span class="required"> * </span></label>
                <input type="time" name="horaingreso" id="horaingreso" value="{{ old('horaingreso', (isset($admision->horaingreso))?$admision->horaingreso:'') }}" class="form-control required">  
            </div>

            <div class="col-md-6">
                <label>Via de Ingreso  <span class="required"> * </span></label>
                <select name="idviaingreso" id="idviaingreso" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>    
            </div>


            <div class="col-md-12" style="margin-top:30px;"></div> 

            <div class="col-md-6">
                <label>Institución Remite  <span class="required"> * </span></label>
               <input type="text" name="institucionremite" value="{{ old('institucionremite', (isset($admision->institucionremite))?$admision->institucionremite:'') }}" class="form-control required">  
            </div>

            <div class="col-md-6">
                <label>Origen Atención  <span class="required"> * </span></label>
                <select name="idorigenatencion" id="idorigenatencion" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>   
            </div>


            <div class="col-md-12" style="margin-top:30px;"></div> 

            <div class="col-md-6">
                <label>Tipo de Atención  <span class="required"> * </span></label>
                <select name="idtipoatencion" id="idtipoatencion" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                </select>   
            </div>
 

              <div class="col-md-6">
                <label>Nombre Acomp:  <span class="required"> * </span></label>
                <input type="text" name="nombreacompanante" value="{{ old('nombreacompanante', (isset($admision->nombreacompanante))?$admision->nombreacompanante:'') }}" class="form-control required">  
             </div>

             <div class="col-md-12" style="margin-top:30px;"></div> 

             <div class="col-md-6">
                <label>Dirección Acom:  <span class="required"> * </span></label>
                <input type="text" name="direccionacompanante" value="{{ old('direccionacompanante', (isset($admision->direccionacompanante))?$admision->direccionacompanante:'') }}" class="form-control required">  
             </div>

              <div class="col-md-6">
                <label>Telefono Acomp:  <span class="required"> * </span></label>
                <input type="text" name="telefonoacompanante" value="{{ old('direccionacompanante', (isset($admision->telefonoacompanante))?$admision->telefonoacompanante:'') }}" class="form-control">  
             </div>

             <div class="col-md-12" style="margin-top:30px;"></div> 

             <div class="col-md-6">
                <label>Depart Acomp:  <span class="required"> * </span></label>
                <select name="departamentoacomid" id="departamentoacomid" class="form-control required" onchange="obj_funciones.municipios(this.value,'#ciudadacompid', '{{ route('municipios')}}');">
                    <option value="" selected="">::Seleccione::</option>
                </select>   
            </div>

            <div class="col-md-6">
                <label>Ciud/Mun Acom:  <span class="required"> * </span></label>
                <select name="ciudadacompid" id="ciudadacompid" class="form-control required">
                    <option value="" selected="">::Seleccione::</option>
                </select>   
            </div>
        </div>
      </div>
    </div>    

      <div class="col-md-12 text-center" style="margin-top: 20px;">
            <button type="submit" class="btn green">Guardar</button>
      </div> 
      
      <div class="col-md-12" style="margin-top:30px;"></div>   

    </form>
    </div>
</div>

<script type="text/javascript">
obj_funciones.departamentos('','#iddepartamento');
obj_funciones.departamentos('','#departamentodireccion');
obj_funciones.departamentos('','#departamentoacomid');
obj_funciones.getentidades('<?php echo (isset($admision->idinstitucioneapb))?$admision->idinstitucioneapb:""; ?>','#entidadsalud');
<?php if (isset($admision->idinstitucioneapb)): ?>
obj_funciones.getconvenios('<?php echo (isset($admision->idinstitucioneapb))?$admision->idinstitucioneapb:""; ?>','#convenios','<?php echo (isset($admision->idconvenio))?$admision->idconvenio:""; ?>');
<?php endif; ?>

obj_funciones.getregimen('<?php echo (isset($admision->idregimen))?$admision->idregimen:""; ?>','#idregimen');
obj_funciones.getafiliacion('<?php echo (isset($admision->idtipoafiliacion))?$admision->idtipoafiliacion:""; ?>','#idtipoafiliacion');
obj_funciones.getanivel('<?php echo (isset($admision->idnivel))?$admision->idnivel:""; ?>','#idnivel');
obj_funciones.getsexos('<?php echo (isset($admision->idsexo))?$admision->idsexo:""; ?>', '#idsexo');
obj_funciones.getestadocivil('<?php echo (isset($admision->idestadocivil))?$admision->idestadocivil:""; ?>','#idestadocivil');
obj_funciones.getgruposanguinio('<?php echo (isset($admision->idgruposanguineo))?$admision->idgruposanguineo:""; ?>','#idgruposanguineo');
obj_funciones.getreligion('<?php echo (isset($admision->idreligion))?$admision->idreligion:""; ?>','#idreligion');
obj_funciones.getocupacion('','#idocupacion');
obj_funciones.getbarrio('<?php echo (isset($admision->idbarrio))?$admision->idbarrio:""; ?>','#idbarrio');
obj_funciones.getzonas('<?php echo (isset($admision->idzonaresidencial))?$admision->idzonaresidencial:""; ?>','#idzonaresidencial');
obj_funciones.getviaingreso('<?php echo (isset($admision->idviaingreso))?$admision->idviaingreso:""; ?>','#idviaingreso');
obj_funciones.getorigenatencion('<?php echo (isset($admision->idorigenatencion))?$admision->idorigenatencion:""; ?>','#idorigenatencion');
obj_funciones.gettipoatencion('<?php echo (isset($admision->idtipoatencion))?$admision->idtipoatencion:""; ?>','#idtipoatencion');

$("#fechanacimiento").datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    autoclose: true
});

$("#fechaingreso").datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    autoclose: true
});

  function submitform() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#admisionform').attr("action"), 
            data : $('#admisionform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert').html(data.mensaje);
        }else{
              setTimeout(function(){
              btn.button('reset');
             }, 200);
           $('#mensaje_alert').html(data.mensaje);
        }
    },300);
    return false;
}
</script>   