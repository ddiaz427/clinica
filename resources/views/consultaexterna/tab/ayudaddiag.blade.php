<form action="{{ route('ayudadiagsubmit')}}" method="post" id="ayudadiagform" onsubmit="submitAyudadiag(); return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="{{ $admisionid }}">
    <input type="hidden" name="idadmisionprocedimiento" id="idadmisionprocedimiento">

         <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1_115030" data-toggle="tab">Ayuda y Diagnóstico</a>
            </li>
          </ul>  

          <div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">
            <div class="tab-pane active" id="tab1_115030">

            <div class="col-md-12" style="margin-top:30px;"></div>

              <div id="mensaje_alert_ayudadiag"></div>

                <div class="col-md-7">
                     <label>Nombre</label>
                     <input type="text" onkeyup="procedimientos();" name="procedimiento" id="procedimiento" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento">

                     <input type="hidden" name="procedimientoid" id="idprocedimiento">
                </div>

                <div class="col-md-3">
                   <label>Fecha</label>
                   <input class="form-control required" name="fechaprocedimiento" id="fechaprocedimiento" value="{{ date('d/m/Y') }}" type="text">
                </div>

                 <div class="col-md-2">
                     <label>Hora</label>
                     <input class="form-control required" name="horaprocedimiento" value="{{ date('h:m:s') }}" type="time">
                 </div>


                <div class="col-md-12" style="margin-top:30px;"></div>

                <div class="col-md-12 text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div> 

                <div class="col-md-12" style="margin-top:30px;"></div>


              <div class="col-md-12 text-center">
                <small class="text-danger">Laboratorios Clínicos Registrados</small>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="datatable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="all text-center">Fecha</th>
                          <th class="all text-center">Fecha hora</th>
                          <th class="all text-center">Procedimiento</th>
                          <th class="desktop text-center">Opciones</th>
                      </tr>
                  </thead>
                  <tbody id="table_ayudaprocedimiento">
                  </tbody>
                </table>
            </div>              
            </div>
          </div>   
    </form>

<script type="text/javascript">

 getadmisionprocedimiento('<?php echo $admisionid; ?>');

 $("#fechaprocedimiento").datepicker({
      format: "yyyy/mm/dd",
      language: "es",
      autoclose: true
  });

  function submitAyudadiag() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#ayudadiagform').attr("action"), 
            data : $('#ayudadiagform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_ayudadiag').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_ayudadiag');
          getadmisionprocedimiento('<?php echo $admisionid; ?>');
        }else{
           $('#mensaje_alert_ayudadiag').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_ayudadiag');
        }
    },300);
    return false;
}

function getadmisionprocedimiento(id) {
     
     setTimeout(function(){
        var data = obj_funciones.getajaxsimple({
            url :  base_url+'/getadmisionprocedimiento', 
            data : {'admisionid': id},
        });

        var row = '';
        for(var i = 0;i < data.dato.length ; i++){
            row += '<tr class="warning text-center">';
            row += '<td>'+data.dato[i].fechaprocedimiento+'</td>';
            row += '<td>'+data.dato[i].horaprocedimiento+'</td>';
            row += '<td>'+data.dato[i].nombreprocedimiento+'</td>';
            row += '<td><a href="javascript:void(0);" onclick="deleteprocedimiento('+data.dato[i].idadmisionprocedimiento+')"><i class="fa fa-trash"></i></a><br><a href="javascript:void(0);" onclick="editprocedimiento('+data.dato[i].idadmisionprocedimiento+','+data.dato[i].idadmision+')"><i class="fa fa-edit"></i></a></td>';
            row += '</tr>';
        }
        $("#table_ayudaprocedimiento").html(row);
        
    },300);
}

function deleteprocedimiento(id) {
    
    if(confirm('¿Realmente Desea Eliminar Este Registro?'))
    { 
       setTimeout(function(){
          var data = obj_funciones.getajaxsimple({
              url :  base_url+'/deleteadmision', 
              data : {'procedimientoid': id},
          });

          if (data.response == true){

            $('#mensaje_alert_medicamento').html(data.mensaje);
            getmedicamento('<?php echo $admisionid; ?>');

          }else{
            alert(data.mensaje);
          }

      },300);
   }
}

function editprocedimiento(id, admisionid){
   
   setTimeout(function(){
        var data = obj_funciones.getajaxsimple({
            url :  base_url+'/editprocedimiento', 
            data : {'procedimientoid': id, 'admisionid': admisionid},
        });

        if (data != ''){

          $('#procedimiento').val(data.dato.nombreprocedimiento);
          $('#idprocedimiento').val(data.dato.idprocedimiento);
          $('#fechaprocedimiento').val(data.dato.fechaprocedimiento);
          $('#horaprocedimiento').val(data.dato.horaprocedimiento);
          $('#idadmisionprocedimiento').val(data.dato.idadmisionprocedimiento);
          
        }else{

          $('#procedimiento').val('');
          $('#procedimientoid').val('');
          $('#fechaprocedimiento').val('');
          $('#horaprocedimiento').val('');
          $('#idadmisionprocedimiento').val('');
        }

    },300);
}

function procedimientos(){

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

      var datajson = obj_funciones.getajaxsimple({
          type: 'POST',
          url : base_url+'/buscarprocedimiento',
          data: {'buscarprocedimiento': $('#procedimiento').val()},
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
          autoFocus: false,

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
            //alert(ui.item[_data.item_id]);
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
}
</script>   