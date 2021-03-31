<form action="{{ route('editmedicamentoorden')}}" method="post" id="medicamentoformedit" onsubmit="submitMedicamentoEdit(); return false;">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="enviado" value="enviado">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Medicamento</h4>
            </div>

            <div class="modal-body">
              <div id="mensaje_alert_medicamento_modal"></div>
               <div class="row"> 
                       <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha</label>
                           <input class="form-control required" name="fechaorden" id="fechaorden" value="<?php echo (isset($admisionorden->fechaorden))?$admisionorden->fechaorden: date('d/m/Y'); ?>" type="text" required="">
                        </div>   
                      </div>

                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Hora</label>
                         <input class="form-control required" name="horaorden" id="horaorden" value="<?php echo (isset($admisionorden->horaorden))?$admisionorden->horaorden: date('H:m:s'); ?>" type="time" required="">
                       </div>  
                     </div>


                    <?php foreach ($detalleadmisionorden as $key => $filas): ?>
                          
                          <div class="col-md-5">
                              <div class="form-group">
                                 <label>Nombre</label>
                                   <input type="text" onkeyup="procedimientosedit();" name="procedimiento[]" id="procedimiento" class="form-control bs-autocomplete" data-hidden_field_id="idprocedimiento" data-item_id="idprocedimiento" data-item_label="nombreprocedimiento" value="<?php echo $filas->nombreprocedimiento ?>">
                                   <input type="hidden" name="procedimientoid[]" id="idprocedimiento" value="<?php echo $filas->idprocedimiento ?>">
                                </div>   
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                               <label>Cantidad</label>
                               <input class="form-control required" name="cantidad[]" id="cantidad" value="<?php echo $filas->cantidad ?>" type="text" required="">
                             </div>    
                          </div>

                          <div class="col-md-5">
                            <div class="form-group">
                               <label>Posologia</label>
                               <input class="form-control required" name="posologia[]" id="posologia" value="<?php echo $filas->posologia ?>" type="text" required="">
                             </div>   
                          </div>

                        <?php endforeach; ?>  
                    
                      <div class="col-md-12">
                        <div class="form-group">
                         <label>Observaciones</label>
                         <textarea name="observacion" class="form-control" rows="3" required=""><?php echo (isset($admisionorden->observacion))?$admisionorden->observacion: ''; ?></textarea>
                       </div>  
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function() {
      $("#fechaorden").datepicker({
          format: "yyyy/mm/dd",
          language: "es",
          autoclose: true
      });
  });  
  
  function submitMedicamentoEdit() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#medicamentoformedit').attr("action"), 
            data : $('#medicamentoformedit').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_medicamento_modal').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_medicamento_modal');
          //getmedicamento();
        }else{
           $('#mensaje_alert_medicamento').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_medicamento_modal');
        }
    },300);
    return false;
}


  function procedimientosedit(){

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

  function procedimientos2(){

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