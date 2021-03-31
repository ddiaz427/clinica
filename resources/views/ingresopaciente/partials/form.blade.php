<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo. 
        </div>
    @endif
            <div class="row">
                <div class="portlet-body">
                    <div class="col-md-12 text-center">
                        @if(!isset($admision->idtipodocumento))
                         <a type="button" class="btn btn-raised btn-primary btn-xs" data-toggle="collapse" href="#registro-avanzada" aria-expanded="false" aria-controls="registro-avanzada"><i class="fa fa-user" aria-hidden="true"></i> <i class="glyphicon glyphicon-plus" aria-hidden="true"></i></a>
                         
                         <a type="button" class="btn btn-raised btn-warning btn-xs" onclick="obj_funciones.editarPaciente();"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a>
                       @endif  

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
                            <!--<input class="form-control" id="idpaciente" name="idpaciente" value="" type="number" readonly>-->
                        </div>

                          <input type="hidden" name="idpaciente" id="idpaciente" value="">

                          <div class="col-md-12" style="margin-top:30px;"></div>

                          <div class="col-md-3">
                            <label>Primer Nombre  <span class="required"> * </span></label>
                            <input type="text" name="primernombre" value="{{ old('primernombre', (isset($admision->primernombre))?$admision->primernombre:'') }}" class="form-control required" id="primernombre">
                          </div>

                          <div class="col-md-3">
                            <label>Segundo Nombre</label>
                            <input type="text" name="segundonombre" value="{{ old('segundonombre', (isset($admision->segundonombre))?$admision->segundonombre:'') }}" class="form-control" id="segundonombre">
                          </div>

                           <div class="col-md-3">
                            <label>Primer Apellido  <span class="required"> * </span></label>
                            <input type="text" name="primerapellido" value="{{ old('primerapellido', (isset($admision->primerapellido))?$admision->primerapellido:'') }}" class="form-control required" id="primerapellido">
                          </div>

                           <div class="col-md-3">
                            <label>Segundo Apellido</label>
                            <input type="text" name="segundoapellido" value="{{ old('segundoapellido', (isset($admision->segundoapellido))?$admision->segundoapellido:'') }}" class="form-control" id="segundoapellido">
                          </div>

                          <div class="col-md-12" style="margin-top:30px;"></div>


                          <div class="collapse" id="registro-avanzada">

                                  <div class="col-md-2">
                                        <label>Fecha Nacimiento<span class="required"> * </span></label>
                                        <input readonly="" type="text" name="fechanacimiento" class="form-control" id="fechanacimiento" onchange="obj_funciones.calcularedad(this.value,'#edad','{{ route('calcularedad')}}')">
                                  </div>

                                    <div class="col-md-1">
                                        <label>Edad<span class="required"> * </span></label>
                                        <input type="text" onfocus="this.blur();" name="edad" class="form-control" id="edad">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Dep Nac  <span class="required"> * </span></label>
                                        <select readonly="" name="iddepartamento" id="iddepartamento" class="form-control" onchange="obj_funciones.municipios(this.value,'#idmunicipionacimiento', '{{ route('municipios')}}');">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-3">
                                        <label>Mun. Nac  <span class="required"> * </span></label>
                                        <select readonly="" name="idmunicipionacimiento" id="idmunicipionacimiento" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                     <div class="col-md-3">
                                        <label>Sexo  <span class="required"> * </span></label>
                                        <select readonly="" name="idsexo" id="idsexo" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-12" style="margin-top:30px;"></div>

                                     <div class="col-md-3">
                                        <label>Estado Civil  <span class="required"> * </span></label>
                                        <select readonly="" name="idestadocivil" id="idestadocivil" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                     <div class="col-md-3">
                                        <label>Grupo Sanguinio  <span class="required"> * </span></label>
                                        <select readonly="" name="idgruposanguineo" id="idgruposanguineo" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-3">
                                        <label>Religión  <span class="required"> * </span></label>
                                        <select readonly="" name="idreligion" id="idreligion" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-3">
                                        <label>Ocupación  <span class="required"> * </span></label>
                                        <select readonly="" name="idocupacion" id="idocupacion" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-12" style="margin-top:30px;"></div>

                                     <div class="col-md-2">
                                        <label>Dirección<span class="required"> * </span></label>
                                        <input readonly="" type="text" name="direccion" class="form-control" id="direccion">
                                    </div>

                                    <div class="col-md-2">
                                        <label>Telefono fijo<span class="required"> * </span></label>
                                        <input readonly="" type="text" name="numerotelefonofijo" class="form-control" id="telefono">
                                    </div>

                                    <div class="col-md-2">
                                        <label>Celular</label>
                                        <input readonly="" type="text" name="numerocelular" class="form-control" id="celular">
                                    </div>


                                    <div class="col-md-2">
                                        <label>Correo Electrónico<span class="required"> * </span></label>
                                        <input readonly="" type="text" name="email" class="form-control" id="email">
                                    </div>

                                    <div class="col-md-2">
                                        <label>Departamento  <span class="required"> * </span></label>
                                        <select readonly="" name="departamentodireccion" id="departamentodireccion" class="form-control" onchange="obj_funciones.municipios(this.value,'#idmunicipio', '{{ route('municipios')}}');">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                     <div class="col-md-2">
                                        <label>Ciudad  <span class="required"> * </span></label>
                                        <select readonly="" name="idmunicipio" id="idmunicipio" class="form-control">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-12" style="margin-top:30px;"></div>

                                    <div class="col-md-3">
                                        <label>Barrio  <span class="required"> * </span></label>
                                        <select name="idbarrio" id="idbarrio" class="form-control select2" style="width: 100%">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-3">
                                        <label>Zona  <span class="required"> * </span></label>
                                        <select readonly="" name="idzonaresidencial" id="idzonaresidencial" class="form-control select2" style="width: 100%">
                                            <option value="" selected="">::Seleccione::</option>
                                        </select>    
                                    </div>

                                    <div class="col-md-12" style="margin-top:30px;"></div>
                         </div>


                        <div class="col-md-3">
                            <label>Entidad de Salud  <span class="required"> * </span></label>
                            <select name="idinstitucioneapb" id="entidadsalud" class="form-control select2 required" onchange="obj_funciones.getconvenios(this.value,'#convenios')">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>

                        <div class="col-md-3">
                            <label>Convenio  <span class="required"> * </span></label>
                            <select name="idconvenio" id="convenios" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>

                        <div class="col-md-2">
                            <label>Regimen  <span class="required"> * </span></label>
                            <select name="idregimen" id="idregimen" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>

                          <div class="col-md-2">
                            <label>Tipo de Afiliación  <span class="required"> * </span></label>
                            <select name="idtipoafiliacion" id="idtipoafiliacion" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>

                         <div class="col-md-2">
                            <label>Nivel  <span class="required"> * </span></label>
                            <select name="idnivel" id="idnivel" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>  

                        <div class="col-md-12" style="margin-top:30px;"></div>  

                        <div class="col-md-2">
                            <label>Fecha de Ingreso  <span class="required"> * </span></label>
                            <input type="text" name="fechaingreso" value="{{ old('fechaingreso', (isset($admision->fechaingreso))?$admision->fechaingreso:'') }}" id="fechaingreso" class="form-control required">  
                        </div> 

                        <div class="col-md-2">
                            <label>Hora de Ingreso  <span class="required"> * </span></label>
                            <input type="time" name="horaingreso" id="horaingreso" value="{{ old('horaingreso', (isset($admision->horaingreso))?$admision->horaingreso:'') }}" class="form-control required">  
                        </div>

                        <div class="col-md-2">
                            <label>Via de Ingreso  <span class="required"> * </span></label>
                            <select name="idviaingreso" id="idviaingreso" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>    
                        </div>

                         <div class="col-md-2">
                            <label>Institución Remite  <span class="required"> * </span></label>
                           <input type="text" name="institucionremite" value="{{ old('institucionremite', (isset($admision->institucionremite))?$admision->institucionremite:'') }}" class="form-control required">  
                        </div>

                        <div class="col-md-2">
                            <label>Origen Atención  <span class="required"> * </span></label>
                            <select name="idorigenatencion" id="idorigenatencion" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>   
                        </div>

                        <div class="col-md-2">
                            <label>Tipo de Atención  <span class="required"> * </span></label>
                            <select name="idtipoatencion" id="idtipoatencion" class="form-control select2 required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>   
                        </div>

                         <div class="col-md-12" style="margin-top:30px;"></div>  

                          <div class="col-md-2">
                            <label>Nombre Acomp:  <span class="required"> * </span></label>
                            <input type="text" name="nombreacompanante" value="{{ old('nombreacompanante', (isset($admision->nombreacompanante))?$admision->nombreacompanante:'') }}" class="form-control required">  
                         </div>

                         <div class="col-md-2">
                            <label>Dirección Acom:  <span class="required"> * </span></label>
                            <input type="text" name="direccionacompanante" value="{{ old('direccionacompanante', (isset($admision->direccionacompanante))?$admision->direccionacompanante:'') }}" class="form-control required">  
                         </div>

                          <div class="col-md-2">
                            <label>Telefono Acomp:  <span class="required"> * </span></label>
                            <input type="text" name="telefonoacompanante" value="{{ old('direccionacompanante', (isset($admision->telefonoacompanante))?$admision->telefonoacompanante:'') }}" class="form-control">  
                         </div>

                         <div class="col-md-2">
                            <label>Depart Acomp:  <span class="required"> * </span></label>
                            <select name="departamentoacomid" id="departamentoacomid" class="form-control required" onchange="obj_funciones.municipios(this.value,'#ciudadacompid', '{{ route('municipios')}}');">
                                <option value="" selected="">::Seleccione::</option>
                            </select>   
                        </div>

                        <div class="col-md-2">
                            <label>Ciud/Mun Acom:  <span class="required"> * </span></label>
                            <select name="ciudadacompid" id="ciudadacompid" class="form-control required">
                                <option value="" selected="">::Seleccione::</option>
                            </select>   
                        </div>  
                </div>
            </div>  
        </div> 

@section('scripts')
<script type="text/javascript">


    $('#registro-avanzada').on('shown.bs.collapse', function () {

        $('#fechanacimiento').addClass("required");
        $('#iddepartamento').addClass("required");
        $('#idmunicipionacimiento').addClass("required");
        $('#idsexo').addClass("required");
        $('#idestadocivil').addClass("required");
        $('#idgruposanguineo').addClass("required");
        $('#idreligion').addClass("required");
        $('#idocupacion').addClass("required");
        $('#direccion').addClass("required");
        $('#numerotelefonofijo').addClass("required");
        $('#email').addClass("required");
        $('#departamentodireccion').addClass("required");
        $('#idmunicipio').addClass("required");
        $('#idbarrio').addClass("required");
        $('#idzonaresidencial').addClass("required");
        
        

    });

    $('#registro-avanzada').on('hidden.bs.collapse', function () {

        $('#fechanacimiento').removeClass("required");
        $('#iddepartamento').removeClass("required");
        $('#idmunicipionacimiento').removeClass("required");
        $('#idsexo').removeClass("required");
        $('#idestadocivil').removeClass("required");
        $('#idgruposanguineo').removeClass("required");
        $('#idreligion').removeClass("required");
        $('#idocupacion').removeClass("required");
        $('#direccion').removeClass("required");
        $('#numerotelefonofijo').removeClass("required");
        $('#email').removeClass("required");
        $('#departamentodireccion').removeClass("required");
        $('#idmunicipio').removeClass("required");
        $('#idbarrio').removeClass("required");
        $('#idzonaresidencial').removeClass("required");
        
    });

    $('#fechanacimiento').removeAttr("readonly");
    $('#iddepartamento').removeAttr("readonly");
    $('#idmunicipionacimiento').removeAttr("readonly");
    $('#idsexo').removeAttr("readonly");
    $('#idestadocivil').removeAttr("readonly");
    $('#idgruposanguineo').removeAttr("readonly");
    $('#idreligion').removeAttr("readonly");
    $('#idocupacion').removeAttr("readonly");
    $('#direccion').removeAttr("readonly"); 
    $('#telefono').removeAttr("readonly"); 
    $('#celular').removeAttr("readonly"); 
    $('#email').removeAttr("readonly");
    $('#departamentodireccion').removeAttr("readonly");
    $('#idmunicipio').removeAttr("readonly");
    $('#idbarrio').removeAttr("readonly"); 
    $('#idzonaresidencial').removeAttr("readonly"); 
    
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

$.widget("ui.autocomplete", $.ui.autocomplete, {

      _renderMenu: function(ul, items) {
        var that = this;
        ul.attr("class", "nav nav-pills nav-stacked  bs-autocomplete-menu");
        $.each(items, function(index, item) {
          that._renderItemData(ul, item);
        });
      },

      _resizeMenu: function() {
        var ul = this.menu.element;
        ul.outerWidth(Math.min(
          // Firefox wraps long text (possibly a rounding bug)
          // so we add 1px to avoid the wrapping (#7513)
          ul.width("").outerWidth() + 1,
          this.element.outerWidth()
        ));
      }

    });

  function getpacientes(id, div, url){
        "use strict";
        var pacientes = obj_funciones.getajaxsimple({
            type: 'POST',
            url : url,
            data: {'idtipodocumento': id},
            dataType: 'json',
        });

  $('.bs-autocomplete').each(function() {
    var _this = $(this),
      _data = _this.data(),
      _hidden_field = $('#' + _data.hidden_field_id);


    _this.after('<div class="bs-autocomplete-feedback form-control-feedback"><div class="loader">Loading...</div></div>')
      .parent('.form-group').addClass('has-feedback');

    var feedback_icon = _this.next('.bs-autocomplete-feedback');
    feedback_icon.hide();

    _this.autocomplete({
        minLength: 1,
        autoFocus: true,

        source: function(request, response) {
          var _regexp = new RegExp(request.term, 'i');
          var data = pacientes.filter(function(item) {
            //console.log(data);
            var databusqueda = item.numerodocumento;
            databusqueda += item.nombrepaciente;
            return databusqueda.match(_regexp);
            //return item.nombrepaciente.match(_regexp);
          });
          response(data);
        },

        search: function() {
          feedback_icon.show();
          _hidden_field.val('');
        },

        response: function() {
          feedback_icon.hide();
        },

        focus: function(event, ui) {
          _this.val(ui.item[_data.item_label]);
          event.preventDefault();
        },

        select: function(event, ui) {
          _this.val(ui.item[_data.item_label]);
          _hidden_field.val(ui.item[_data.item_id]);
          obj_funciones.getdatapaciente(ui.item[_data.item_id],'<?php echo route("mostrardatapacientes");?>');
          //$('#paciente').attr('disabled', 'disabled');
          event.preventDefault();
        }
      })
      .data('ui-autocomplete')._renderItem = function(ul, item) {
        return $('<li></li>')
          .data("item.autocomplete", item)
          .append('<a>' + item[_data.item_label]+' '+item[_data.item_label2] + '</a>')
          .appendTo(ul);
      };
    // end autocomplete
  });
}

</script>
@endsection