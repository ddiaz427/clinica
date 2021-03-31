<form action="{{ route('diagnosticosubmit')}}" class="form-line" method="post" id="diagnosticoform" onsubmit="submitDianostico(); return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="{{ $admisionid }}">

        <div id="mensaje_alert_diagnostico"></div>    

        <ul class="nav nav-tabs">
          <li class="active">
              <a href="#tab1_115030" data-toggle="tab">Diagnósticos CIE-10</a>
          </li>

           <li>
              <a href="#tab2_115030" data-toggle="tab">Diagnóstico Alternativo</a>
          </li>
        </ul>  
        <div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">

          <div class="tab-pane active" id="tab1_115030">

                <div class="col-md-12" style="margin-top: 20px;"></div> 

                <div class="col-md-4" style="padding-bottom: 20px;">
                   <label><b>Diagnóstico Principal:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">

                   <input type="text" name="buscarprincipal" value="<?php echo isset($admision->diagnosticoprincipal)?$admision->diagnosticoprincipal:'' ?>" id="buscarprincipal" class="form-control bs-autocomplete required" data-hidden_field_id="diagnosticoprincipalid" data-item_id="iddiagnostico" data-item_label="nombrediagnostico" required="">

                  <input type="hidden" name="diagnosticoprincipalid" id="diagnosticoprincipalid" required="">

                </div> 

                <div class="col-md-4" style="padding-bottom: 20px;">
                    <label><b>Diagnóstico Relacionado 1:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                  <!--
                  <select name="diagnosticorelacionado1" class="form-control select2" id="diagnosticorelacionado1">
                      <option value="" selected="">::Seleccione::</option> 
                      @foreach($diagnostico as $d1)
                      <option value="{{$d1->iddiagnostico}}" <?php echo (isset($admision->iddiagnostico1) && $admision->iddiagnostico1 != NULL && $admision->iddiagnostico1 == $d1->iddiagnostico)?'selected':''; ?>>{{$d1->nombrediagnostico}}</option> 
                    @endforeach
                  </select>
                  -->
                  <input type="text" name="buscardiagnostico1" value="<?php echo isset($admision->diagnosticoprincipal2)?$admision->diagnosticoprincipal2:'' ?>" id="buscardiagnostico1" class="form-control bs-autocomplete required" data-hidden_field_id="diagnosticorelacionado1" data-item_id="iddiagnostico" data-item_label="nombrediagnostico" required="">

                  <input type="hidden" name="diagnosticorelacionado1" id="diagnosticorelacionado1" required="">
                  
                </div>  

                 <div class="col-md-4" style="padding-bottom: 20px;">
                    <label><b>Diagnóstico Relacionado 2:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                    <!--<select name="diagnosticorelacionado2" class="form-control select2" id="diagnosticorelacionado2">
                      <option value="" selected="">::Seleccione::</option> 
                      @foreach($diagnostico as $d2)
                      <option value="{{$d2->iddiagnostico}}" <?php echo (isset($admision->iddiagnostico2) && $admision->iddiagnostico2 != NULL && $admision->iddiagnostico2 == $d2->iddiagnostico)?'selected':''; ?>>{{$d2->nombrediagnostico}}</option> 
                      @endforeach
                    </select>-->

                    <input type="text" name="buscardiagnostico2" value="<?php echo isset($admision->diagnosticoprincipal3)?$admision->diagnosticoprincipal3:'' ?>" id="buscardiagnostico2" class="form-control bs-autocomplete required" data-hidden_field_id="diagnosticorelacionado2" data-item_id="iddiagnostico" data-item_label="nombrediagnostico" required="">

                   <input type="hidden" name="diagnosticorelacionado2" id="diagnosticorelacionado2" required="">
                </div> 

                <div class="col-md-4" style="padding-bottom: 20px;">
                    <label><b>Diagnóstico Relacionado 3:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                   
                   <!--<select name="diagnosticorelacionado3" class="form-control select2" id="diagnosticorelacionado3">
                    <option value="" selected="">::Seleccione::</option> 
                    @foreach($diagnostico as $d3)
                    <option value="{{$d3->iddiagnostico}}" <?php echo (isset($admision->iddiagnostico3) && $admision->iddiagnostico3 != NULL && $admision->iddiagnostico3 == $d3->iddiagnostico)?'selected':''; ?>>{{$d3->nombrediagnostico}}</option> 
                    @endforeach
                  </select>-->

                  <input type="text" name="buscardiagnostico3" value="<?php echo isset($admision->diagnosticoprincipal4)?$admision->diagnosticoprincipal4:'' ?>" id="buscardiagnostico3" class="form-control bs-autocomplete required" data-hidden_field_id="diagnosticorelacionado3" data-item_id="iddiagnostico" data-item_label="nombrediagnostico" required="">

                   <input type="hidden" name="diagnosticorelacionado3" id="diagnosticorelacionado3" required="">

                </div> 

                <div class="col-md-4" style="padding-bottom: 20px;">
                    <label><b>Tipo Diagnóstico:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                    <select name="idtipodiagnostico" class="form-control" id="idtipodiagnostico">
                      <option value="" selected="">::Seleccione::</option>
                       @foreach($tipodianostico as $td)
                      <option value="{{$td->idtipodiagnostico}}" <?php echo (isset($admision->idtipodiagnostico) && $admision->idtipodiagnostico != NULL && $admision->idtipodiagnostico == $td->idtipodiagnostico)?'selected':''; ?>>{{$td->nombretipodiagnostico}}</option> 
                      @endforeach
                    </select>
                  </div>

          </div>

          <div class="tab-pane" id="tab2_115030">

            <div class="col-md-12" style="margin-top: 20px;"></div> 
            
            <div class="col-md-4" style="padding-bottom: 20px;">
                  <label><b>Diagnóstico:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                    <select name="iddiagnosticoalt" class="form-control" id="iddiagnosticoalt" style="width: 100%">
                      <option value="" selected="">::Seleccione::</option>
                       @foreach($diagnosticoalt as $dalt)
                      <option value="{{$dalt->iddiagnosticoalt}}" <?php echo (isset($admision->iddiagnosticoalt) && $admision->iddiagnosticoalt != NULL && $admision->iddiagnosticoalt == $dalt->iddiagnosticoalt)?'selected':''; ?>>{{$dalt->nombrediagnosticoalt}}</option> 
                      @endforeach
                    </select>
                </div>

                 <div class="col-md-4" style="padding-bottom: 20px;">
                 <label><b>Etiología:</b></label>
                </div>

                <div class="col-md-8" style="padding-bottom: 20px;">
                  <select name="idetiologia" class="form-control" id="idetiologia" style="width: 100%">
                      <option value="" selected="">::Seleccione::</option>
                       @foreach($etilogia as $e)
                      <option value="{{$e->idetiologia}}" <?php echo (isset($admision->idetiologia) && $admision->idetiologia != NULL && $admision->idetiologia == $e->idetiologia)?'selected':''; ?>>{{$e->nombreetiologia}}</option> 
                      @endforeach
                  </select>
                </div>
          </div>
        </div>


          <div class="col-md-12 text-center" style="margin-top: 20px;">
              <button type="submit" class="btn green">Guardar</button>
          </div> 

          <div class="col-md-12" style="margin-top:30px;"></div>   

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

$("#buscarprincipal").on('keyup',function(event)
{
    event.preventDefault();
       "use strict";
        var datajson = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/buscardiagnostico',
            data: {'buscarprocedimiento': $('#buscarprincipal').val()},
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
            var databusqueda = item.nombrediagnostico;
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

 
$("#buscardiagnostico1").on('keyup',function(event)
{
    event.preventDefault();
       "use strict";
        var datajson = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/buscardiagnostico',
            data: {'buscarprocedimiento': $('#buscardiagnostico1').val()},
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
            var databusqueda = item.nombrediagnostico;
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

$("#buscardiagnostico2").on('keyup',function(event)
{
    event.preventDefault();
       "use strict";
        var datajson = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/buscardiagnostico',
            data: {'buscarprocedimiento': $('#buscardiagnostico2').val()},
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
            var databusqueda = item.nombrediagnostico;
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

$("#buscardiagnostico3").on('keyup',function(event)
{
    event.preventDefault();
       "use strict";
        var datajson = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/buscardiagnostico',
            data: {'buscarprocedimiento': $('#buscardiagnostico3').val()},
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
            var databusqueda = item.nombrediagnostico;
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

  obj_funciones.setselect2('#idtipodiagnostico, #iddiagnosticoalt, #idetiologia');  
  
  function submitDianostico() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#diagnosticoform').attr("action"), 
            data : $('#diagnosticoform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_diagnostico').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_diagnostico');
        }else{
           $('#mensaje_alert_diagnostico').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_diagnostico');
        }
    },300);
    return false;
}
</script>   