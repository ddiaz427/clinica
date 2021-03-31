<form action="{{ route('enfermedadsubmit')}}" method="post" id="enfermededadform" onsubmit="submitEnfermedad(); return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="<?php echo $admisionid; ?>">

        <div id="mensaje_alert_enfermedad"></div>

         <ul class="nav nav-tabs">
          <li class="active">
              <a href="#tab1_115030" data-toggle="tab">Datos Consulta</a>
          </li>

           <li>
              <a href="#tab2_115030" data-toggle="tab">Revisión del sistema</a>
          </li>

          <li>
              <a href="#tab3_115030" data-toggle="tab">Signo Vitales</a>
          </li>

          <li>
              <a href="#tab4_115030" data-toggle="tab">Examen Fisico</a>
          </li>
        </ul>  
        <div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">

          <div class="tab-pane active" id="tab1_115030">
           <div class="col-md-12" style="margin-top: 20px;"></div> 
           <div class="col-md-6">
              <label>Consulta</label>
          
               <input type="text" name="buscar" id="buscar" value="<?php echo isset($admisionprocedimiento->nombreprocedimiento)?$admisionprocedimiento->nombreprocedimiento:''; ?>" class="form-control bs-autocomplete required" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento">

               <input type="hidden" name="procedimientoid" id="idprocedimiento">
          </div>

          <div class="col-md-4">
               <label>Fecha</label>
               <input class="form-control bs-autocomplete required" name="fechaconsulta" id="fechaconsulta" value="{{ old('fechaconsulta', (isset($admisionprocedimiento->fechaprocedimiento))?$admisionprocedimiento->fechaprocedimientoss: date('d/m/Y') ) }}" type="text">
          </div>

           <div class="col-md-2">
               <label>Hora</label>
               <input class="form-control bs-autocomplete required" name="hora" id="paciente" value="{{ old('hora', (isset($admisionprocedimiento->horaprocedimiento))?$admisionprocedimiento->horaprocedimiento: date('h:m:s') ) }}" type="time">
           </div>

           <div class="col-md-12" style="margin-top:30px;"></div>

            <div class="col-md-6">
                <label>Motivo de la consulta</label>
                <textarea class="form-control required" name="motivoconsulta" rows="3">{{(isset($admisionprocedimiento->motivoconsulta))?$admisionprocedimiento->motivoconsulta: ''}}</textarea>
            </div>

            <div class="col-md-6">
               <label>Enfermedad Actual</label>
               <textarea class="form-control required" name="enfermedadactual" rows="3">{{(isset($admisionprocedimiento->enfermedadactual))?$admisionprocedimiento->enfermedadactual: ''}}</textarea>
            </div>

          </div>

             <div class="tab-pane" id="tab2_115030">
             
             <div class="col-md-12" style="margin-top: 20px;"></div>

                <div class="col-md-12">
                   <label>Observación</label>
                   <textarea class="form-control" name="revisionsistemas" rows="3">{{(isset($admisionprocedimiento->revisionsistemas))?$admisionprocedimiento->revisionsistemas: ''}}</textarea>
                  </div>
              </div>

              <div class="tab-pane" id="tab3_115030">
                <div class="col-md-12" style="margin-top: 20px;"></div>

                <div class="col-md-12">
                   <label>Temperatura ªC</label>
                   <input name="temperatura" class="form-control" value="{{(isset($admisionprocedimiento->temperatura))?$admisionprocedimiento->temperatura: '0.0'}}">                        
                </div>

                <div class="col-md-12" style="margin-top:30px;"></div>

                 <div class="col-md-6">
                   <label>T.A sentado</label>
                   <input class="form-control" name="tasentadosistolica" value="{{(isset($admisionprocedimiento->tasentadosistolica))?$admisionprocedimiento->tasentadosistolica: '0'}}">            
                </div>

                <div class="col-md-6">
                    <label>/</label>
                    <input class="form-control" name="tasentadodiastolica" value="{{(isset($admisionprocedimiento->tasentadodiastolica))?$admisionprocedimiento->tasentadodiastolica: '0'}}">  
                </div> 

                <div class="col-md-12" style="margin-top:30px;"></div>

                 <div class="col-md-6">
                   <label>F.C:</label>
                   <input class="form-control" name="frecuenciacardiaca" value="{{(isset($admisionprocedimiento->frecuenciacardiaca))?$admisionprocedimiento->frecuenciacardiaca: '0'}}">            
                </div>

                <div class="col-md-6">
                  <label>F.R:</label>
                  <input class="form-control" name="frecuenciarespiratoria" value="{{(isset($admisionprocedimiento->frecuenciarespiratoria))?$admisionprocedimiento->frecuenciarespiratoria: '0'}}">  
                </div> 

                <div class="col-md-12" style="margin-top:30px;"></div>

                 <div class="col-md-6">
                     <label>Talla:</label>
                     <input class="form-control" name="talla" value="{{(isset($admisionprocedimiento->talla))?$admisionprocedimiento->talla: '0'}}">            
                </div>

                <div class="col-md-6">
                    <label>Peso:</label>
                    <input class="form-control" name="peso" value="{{(isset($admisionprocedimiento->peso))?$admisionprocedimiento->peso: '0'}}">  
                </div>

                <div class="col-md-12" style="margin-top:30px;"></div>

                <div class="col-md-6">
                    <label>I.M.C:</label>
                    <input class="form-control" name="imc" value="{{(isset($admisionprocedimiento->imc))?$admisionprocedimiento->imc: '0'}}">  
                </div> 

                  <div class="col-md-6">
                    <label>Aputadas:</label>
                    <select name="amputadas" class="form-control">
                      <option value="" selected="">Seleccione</option>
                      <option value="1" <?php echo (isset($admisionprocedimiento->amputadas) and $admisionprocedimiento->amputadas == '1')? 'selected':''; ?>>Si</option>
                      <option value="0"  <?php echo (isset($admisionprocedimiento->amputadas) and $admisionprocedimiento->amputadas == '0')? 'selected':''; ?>>No</option>
                    </select>
                </div>

              </div>

              <div class="tab-pane" id="tab4_115030">

              <div class="col-md-12" style="margin-top: 20px;"></div>

              @if(count($examenfisicodata) > 0)
                          
              @foreach($examenfisicodata as $ed)

              @foreach($examenfisico as $e)

               @if($ed->idexamenfisico == $e->idexamenfisico)
                <div class="col-md-3 text-danger" style="padding-bottom: 20px;">
                  <b><i class="fa fa-info-circle"></i> {{ $e->nombreexamenfisico }}</b>
                  <input type="hidden" name="examenfisicoid[]" value="{{$e->idexamenfisico}}">
                </div>
                <div class="col-md-4" style="padding-bottom: 20px;">
                  <select name="estadoid[]" class="form-control select2" id="estadoid">
                   <option value="" selected="">::Seleccione::</option> 
                   @foreach($estado as $edo)
                    <option value="{{$edo->idestado}}" <?php echo ($ed->idestado == $edo->idestado)?'selected':'' ?>>{{$edo->nombreestado}}</option>
                   @endforeach
                </select>
                </div>
                <div class="col-md-5" style="padding-bottom: 20px;">
                  <input class="form-control bs-autocomplete required" name="descripcionexamen[]" id="descripcionexamen" value="{{ $ed->descripcion }}" type="text">
                </div>
                @endif

              @endforeach
              @endforeach
              @else
              @foreach($examenfisico as $e)

                <div class="col-md-3 text-danger" style="padding-bottom: 20px;">
                  <i class="fa fa-info-circle"></i> {{ $e->nombreexamenfisico }}
                  <input type="hidden" name="examenfisicoid[]" value="{{$e->idexamenfisico}}">
                </div>
                <div class="col-md-4" style="padding-bottom: 20px;">
                  <select name="estadoid[]" class="form-control select2" id="estadoid">
                   <option value="" selected="">::Seleccione::</option> 
                   @foreach($estado as $edo)
                    <option value="{{$edo->idestado}}" <?php echo ($edo->idestado == 1)?'selected':'' ?>>{{$edo->nombreestado}}</option>
                   @endforeach
                </select>
                </div>
                <div class="col-md-5" style="padding-bottom: 20px;">
                  <input class="form-control bs-autocomplete required" name="descripcionexamen[]" id="descripcionexamen" value="{{ $e->descripciondefecto }}" type="text">
                </div>

            @endforeach
             @endif     

              </div>

               <div class="col-md-12 text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div> 

                <div class="col-md-12" style="margin-top:30px;"></div>   
        </div>
    </form>

<script type="text/javascript">

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

$("#buscar").on('keyup',function(event)
 {
    event.preventDefault();
       "use strict";
        var datajson = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/buscarprocedimiento',
            data: {'buscarprocedimiento': $('#buscar').val()},
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
            var data = datajson.filter(function(item) {
              var databusqueda = item.nombreprocedimiento;
              return databusqueda.match(_regexp);
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
            //_this.val(ui.item[_data.item_label]);
            event.preventDefault();
          },

          select: function(event, ui) {
            _this.val(ui.item[_data.item_label]);
            _hidden_field.val(ui.item[_data.item_id]);
            event.preventDefault();
          }
        })
        .data('ui-autocomplete')._renderItem = function(ul, item) {
          return $('<li></li>')
            .data("item.autocomplete", item)
            .append('<a>' + item[_data.item_label] + '</a>')
            .appendTo(ul);
        };
      // end autocomplete
    });

});

$("#fechaconsulta").datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    autoclose: true
});

  function submitEnfermedad() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#enfermededadform').attr("action"), 
            data : $('#enfermededadform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_enfermedad').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_enfermedad');
        }else{
           $('#mensaje_alert_enfermedad').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_enfermedad');
        }
    },300);
    return false;
}
</script>   