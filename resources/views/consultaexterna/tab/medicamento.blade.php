<form action="{{ route('medicamentosubmit')}}" method="post" id="medicamentoform" onsubmit="submitMedicamento(); return false;">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="<?php echo $admisionid; ?>">
    <input type="hidden" name="idadmisionorden" id="idadmisionorden">

         <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1_115030" data-toggle="tab">Medicamento</a>
            </li>
          </ul>  

          <div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">
            <div class="tab-pane active" id="tab1_115030">
              <div class="col-md-12" style="margin-top:30px;"></div>
              <div id="mensaje_alert_medicamento"></div>

              <div class="col-md-6">
                 <div class="form-group">
                   <label>Fecha</label>
                   <input class="form-control required" name="fechaorden" id="fechaorden" value="{{date('d/m/Y')}}" type="text" required="">
                </div>   
              </div>

               <div class="col-md-6">
                 <div class="form-group">
                   <label>Hora</label>
                   <input class="form-control required" name="horaorden" id="horaorden" value="{{ date('H:i:s') }}" type="time">
                 </div>  
               </div>

              <div id="sections">
                <div class="section">
                   <div class="col-md-5">
                     <div class="form-group">
                       <label>Nombre</label>
                         <input type="text" onkeyup="procedimientos();" name="procedimiento[]" id="procedimiento" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento">
                      </div>   
                         <input type="hidden" name="procedimientoid[]" id="idprocedimiento">
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                       <label>Cantidad</label>
                       <input class="form-control required" name="cantidad[]" id="cantidad" value="" type="text" required="">
                     </div>  
                  </div>

                  <div class="col-md-5">
                     <div class="form-group">
                       <label>Posologia</label>
                       <input class="form-control required" name="posologia[]" id="posologia" value="" type="text" required="">
                     </div>  
                  </div>

                   <a title="Eliminar" style="margin-left: 15px;" href="javascript:void(0);" id="remove" class="remove"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                   
                </div>  
              </div>

              <div class="col-md-12 text-center">
                <a title="Agregar Mas Ordenes" href="javascript:void(0);" class="agregarinpus"><i class="fa fa-plus-circle text-info" aria-hidden="true"></i></a> 
              </div>     

              <input type="hidden" name="idtipoorden" value="1">

              <div class="col-md-12">
                 <div class="form-group">
                   <label>Observaciones</label>
                   <textarea name="observacion" id="observacion" class="form-control" rows="3" required=""></textarea>
                 </div>  
              </div>

              <div class="col-md-12 text-center" style="margin-top: 20px;">
                  <button type="submit" class="btn btn-success">Guardar</button>
              </div> 

              <div class="col-md-12" style="margin-top:30px;"></div>


              <div class="col-md-12 text-center">
                <small class="text-danger">Ordenes Realizadas</small>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="datatable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="all text-center">Fecha</th>
                          <th class="all text-center">Fecha hora</th>
                          <th class="all text-center">Observación</th>
                          <th class="all text-center">Ordenes</th>
                          <th class="desktop text-center">Opciones</th>
                      </tr>
                  </thead>
                  <tbody id="table_medicamento">
                  </tbody>
                </table>
            </div>              
            </div>
          </div>   
    </form>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
</div>


<script type="text/javascript">

  obj_funciones.setselect2('#idtipoorden');
  getmedicamento('<?php echo $admisionid; ?>');

  var template = $('#sections .section:first').clone();
  var entra = 0,sectionsCount = 1;

   $(".agregarinpus").click(function(event){
    event.preventDefault();
      sectionsCount++;
      if (entra == 0 && sectionsCount <= 6) {

          var section = template.clone().find(':input').each(function(){
             
              var newId = this.id + sectionsCount;
              $(this).prev().attr('for', newId);   
              this.id = newId;

          }).end().appendTo('#sections');

          $('#procedimiento'+sectionsCount).attr('onkeyup', 'procedimientos'+sectionsCount+'();');
          return false; 

      }else{
        sectionsCount = 6;
        alert('lo Sentimos Pero El Sistema Solo Soporta 6 Campos Habiertos');
      }
  });

  $('#sections').on('click', '.remove', function() {
      
      var numero = 1;
      var resta = (parseInt(sectionsCount) - parseInt(numero));
      
      if (resta != 0){
          $(this).parent().fadeOut(300, function(){
              sectionsCount = resta;  
              $(this).remove();
             
          });
          return false;
        }
  });

  $("#fechaorden").datepicker({
      format: "yyyy/mm/dd",
      language: "es",
      autoclose: true
  });
  
  function submitMedicamento() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#medicamentoform').attr("action"), 
            data : $('#medicamentoform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_medicamento').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_medicamento');
          getmedicamento('<?php echo $admisionid; ?>');
        }else{
           $('#mensaje_alert_medicamento').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_medicamento');
        }
    },300);
    return false;
}

  function getmedicamento(id) {
     obj_funciones.inicio_ajax('10','Cargando Datos...');
     setTimeout(function(){
        var data = obj_funciones.getajaxsimple({
            url :  base_url+'/getmedicamentoconsulta', 
            data : {'admisionid': id, 'idtipoorden': 1},
        });

        var row = '';
        for(var i = 0;i < data.dato.length ; i++){
            row += '<tr class="warning text-center">';
            row += '<td>'+data.dato[i].fechaorden+'</td>';
            row += '<td>'+data.dato[i].horaorden+'</td>';
            row += '<td>'+data.dato[i].observacion+'</td>';
            row += '<td>';
            for(var j = 0;j < data.dato[i].detalleadmisionorden.length; j++){
              row += data.dato[i].detalleadmisionorden[j].nombreprocedimiento+'<br>';
            }
            row += '</td>';
            row += '<td><a href="javascript:void(0);" onclick="deleteadmision('+data.dato[i].idadmisionorden+')"><i class="fa fa-trash"></i></a><br><a href="javascript:void(0);" onclick="editmedicamento('+data.dato[i].idadmisionorden+')"><i class="fa fa-edit"></i></a></td>';
            row += '</tr>';
        }
        $("#table_medicamento").html(row);
        
    },300);
  }

  function editmedicamento(id){
        obj_funciones.inicio_ajax();
        setTimeout(function(){
        var data = obj_funciones.getajaxsimple({
            url :  base_url+'/editmedicamentoorden',
            data: {'idadmisionorden': id},
            datatype: 'json',
        });

        //alert(data.dato[0].fechaorden);
        if(data != ''){
          $('#fechaorden').val(data.dato[0].fechaorden);
          $('#horaorden').val(data.dato[0].horaorden);

          var html = '';
          for(var j = 0;j < data.dato[0].detalleadmisionorden.length; j++){
              //html += data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'<br>';
             html+= '<div class="col-md-5">';
             html+= '<div class="form-group">';
             html+= '<label>Nombre</label>';
             
             if(j == 0){

             html+= '<input type="text" onkeyup="procedimientos();" name="procedimiento[]" id="procedimiento" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

             html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">';

             }else if(j == 1){

                 html+= '<input type="text" onkeyup="procedimientos2();" name="procedimiento[]" id="procedimiento2" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

                  html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento2" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }else if(j == 2){

               html+= '<input type="text" onkeyup="procedimientos3();" name="procedimiento[]" id="procedimiento3" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

               html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento3" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }else if(j == 3){

               html+= '<input type="text" onkeyup="procedimientos4();" name="procedimiento[]" id="procedimiento4" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

               html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento4" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }else if(j == 4){

               html+= '<input type="text" onkeyup="procedimientos5();" name="procedimiento[]" id="procedimiento5" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

               html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento5" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }else if(j == 5){

               html+= '<input type="text" onkeyup="procedimientos6();" name="procedimiento[]" id="procedimiento6" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

               html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento6" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }else if(j == 6){

               html+= '<input type="text" onkeyup="procedimientos7();" name="procedimiento[]" id="procedimiento7" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="'+data.dato[0].detalleadmisionorden[j].nombreprocedimiento+'">';

               html+= '<input type="hidden" name="procedimientoid[]" id="idprocedimiento7" value="'+data.dato[0].detalleadmisionorden[j].idprocedimiento+'">'; 

             }
             html+= '</div>';
             html+= '</div>';

             html+= '<div class="col-md-2">';
             html+= '<div class="form-group">';
             html+= '<label>Cantidad</label>';
             html+= '<input class="form-control required" name="cantidad[]" id="cantidad" value="'+data.dato[0].detalleadmisionorden[j].cantidad+'" type="text" required="">';
             html+= '</div>';
             html+= '</div>';

             html+= '<div class="col-md-5">';
             html+= '<div class="form-group">';
             html+= '<label>Posologia</label>';
             html+= '<input class="form-control required" name="posologia[]" id="posologia" value="'+data.dato[0].detalleadmisionorden[j].posologia+'" type="text" required="">';
            html+= '</div>';
            html+= '</div>';
          }
          $("#sections").html(html);

          $('#observacion').val(data.dato[0].observacion);
          $('#idadmisionorden').val(data.dato[0].idadmisionorden);
        }else{

          $('#fechaorden').val('');
          $('#horaorden').val('');
          $('#observacion').val('');
          $('#idadmisionorden').val('');
        }
       },300);
    }

  function deleteadmision(id) {
    
    if(confirm('¿Realmente Desea Eliminar Este Registro?')){ 

       setTimeout(function(){
          var data = obj_funciones.getajaxsimple({
              url :  base_url+'/deleteadmision', 
              data : {'idadmisionorden': id},
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
      var _this = $('#procedimiento'),
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


  function procedimientos2(){

      $.widget("ui.autocomplete", $.ui.autocomplete, {

        _renderMenu: function(ul, items) {
          //alert(this);
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
          data: {'buscarprocedimiento': $('#procedimiento2').val()},
          dataType: 'json',
      });

      $('.bs-autocomplete').each(function() {
      var _this = $('#procedimiento2'),
        _data = _this.data(),
        _hidden_field = $('#idprocedimiento2');


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
            //alert(ui.item[_data.item_id]);
            _hidden_field.val(ui.item[_data.item_id]);
            console.log(_data);
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

  function procedimientos3(){

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
          data: {'buscarprocedimiento': $('#procedimiento3').val()},
          dataType: 'json',
      });

      $('.bs-autocomplete').each(function() {
      var _this = $('#procedimiento3'),
        _data = _this.data(),
        _hidden_field = $('#idprocedimiento3');


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
            //alert(ui.item[_data.item_id]);
            _hidden_field.val(ui.item[_data.item_id]);
            console.log(_data);
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

  function procedimientos4(){

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
          data: {'buscarprocedimiento': $('#procedimiento4').val()},
          dataType: 'json',
      });

      $('.bs-autocomplete').each(function() {
      var _this = $('#procedimiento4'),
        _data = _this.data(),
        _hidden_field = $('#idprocedimiento4');


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
            //alert(ui.item[_data.item_id]);
            _hidden_field.val(ui.item[_data.item_id]);
            console.log(_data);
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

  function procedimientos5(){

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
          data: {'buscarprocedimiento': $('#procedimiento5').val()},
          dataType: 'json',
      });

      $('.bs-autocomplete').each(function() {
      var _this = $('#procedimiento5'),
        _data = _this.data(),
        _hidden_field = $('#idprocedimiento5');


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
            //alert(ui.item[_data.item_id]);
            _hidden_field.val(ui.item[_data.item_id]);
            console.log(_data);
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

function procedimientos6(){

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
          data: {'buscarprocedimiento': $('#procedimiento6').val()},
          dataType: 'json',
      });

      $('.bs-autocomplete').each(function() {
      var _this = $('#procedimiento6'),
        _data = _this.data(),
        _hidden_field = $('#idprocedimiento6');


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
            //alert(ui.item[_data.item_id]);
            _hidden_field.val(ui.item[_data.item_id]);
            console.log(_data);
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