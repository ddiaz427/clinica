$(function(){
    $('#datatable').DataTable({ 
        responsive: true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        },
        "order": [[ 1, 'desc' ]]
    });
    //
    $('.collapse').on('shown.bs.collapse', function(){
      $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hidden.bs.collapse', function(){
      $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });
    /**/    
});

function class_funciones(){
    
    var pacienteid = ""; 

    this.inicio_ajax = function (sec,title)
    {
        if(sec == undefined) sec = 10;
        if(title == undefined) title = "Espere por favor";
        this.disabledelement();
        
        waitingDialog.show(title, 
        {
            dialogSize: 'sm', progressType: 'success'
        });
        setTimeout(function()
        {
            obj_funciones.enableelements();
            waitingDialog.hide();
        }, sec * 100);
    }

    this.disabledelement = function () 
    {
          $("select,:input").attr('readonly','readonly');
          $(":input[type='submit'],:button,a,div").attr("disabled", "disabled");
    }

    this.enableelements = function ()
    {
        $("select,:input").removeAttr('readonly');
        $(":input[type='submit'],:button,a,div").removeAttr("disabled");
    }

     this.mostrar_div = function(id,sec){
        if(id == undefined) id = "";
        if(sec == undefined){ sec = 1*1000; }
        $(id).show();
        $('html,body').animate({scrollTop: $(id).position().top}, 800, 'swing');
        return false;
    }

    this.getDatePicker = function (id,fnchange){
        if(fnchange == undefined) fnchange = function(){};
        id = this.tab_content_active().find(id);
        id.attr("data-date-format","DD/MM/YYYY");
        id.removeAttr("readonly");
        id.datetimepicker({
            language: 'es',
            pickDate: true,
            pickTime: false,
            useCurrent: false,
        }).change(fnchange);
    }

    this.getTimePicker = function (id,defaultt){
        if(defaultt == undefined) defaultt = '07:00 AM';
        var id = this.tab_content_active().find(id);
        id.attr("data-date-format","hh:mm A");
        id.removeAttr("readonly");
        id.datetimepicker({
            language: 'es',
            pickDate: false,
            pickTime: true,
            useCurrent: true,
            defaultDate: defaultt,
        });
    }
    this.mostrarmodalstatic = function (div,htmll,black){
        if(htmll == undefined) htmll = '';
        $(div).html(htmll);
        $(div).modal({
            backdrop: 'static',
            keyboard : false,
            show: true,
        });
        if(black != undefined){
            $(".modal").css('background-color','#000');
        }
    }
    this.setselect2 = function (div){
        $(div).select2({
            placeholder: "Seleccionar", 
            language: "es",
            allowClear: true,
        });
    }
    this.getajaxsimple = function(objeto){
        var datta = [];
        if(objeto == undefined) objeto = {};
        if(objeto.type == undefined) objeto.type = 'POST';
        if(objeto.url == undefined) objeto.url = base_url;
        if(objeto.data == undefined) objeto.data = {};
        if(objeto.async == undefined) objeto.async = false;
        if(objeto.datatype == undefined) objeto.datatype = 'json';
        $.ajax({
            type : objeto.type,
            url : objeto.url,
            data: objeto.data,
            cache : false,
            async : objeto.async,
            dataType : objeto.datatype,
            success: function(data){
                datta = data;
            }
        });
        return datta;
    }

    this.globalajax = function(div, url, datos){

        obj_funciones.inicio_ajax();
        setTimeout(function(){
        var data = obj_funciones.getajaxsimple({
                  url: base_url+url, 
                  datatype : 'html',
                  data: datos,
              });

            $(div).html(data);
            obj_funciones.mostrar_div(div);
           },300);  
    }

    this.departamentos = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrardepartamentos',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].iddepartamento) selected = "selected=''";
            select += "<option value='"+data[i].iddepartamento+"' "+selected+" >"+data[i].nombredepartamento+"</option>";
        }
        $(div).html(select);
    }

    this.municipios = function(id, div, url, idselect){

      if(id == undefined) id = "";
      if(idselect == undefined) idselect = "";

       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : url,
            data: {'iddepartamento': id},
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(idselect != "" && idselect == data[i].idmunicipio) selected = "selected=''";
            select += "<option value='"+data[i].idmunicipio+"' "+selected+" >"+data[i].nombremunicipio+"</option>";
        }
        $(div).html(select);
    }

    this.getsexos = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarsexos',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idsexo) selected = "selected=''";
            select += "<option value='"+data[i].idsexo+"' "+selected+" >"+data[i].nombresexo+"</option>";
        }
        $(div).html(select);
    }

    this.getestadocivil = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarestadicivil',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idestadocivil) selected = "selected=''";
            select += "<option value='"+data[i].idestadocivil+"' "+selected+" >"+data[i].nombreestadocivil+"</option>";
        }
        $(div).html(select);
    }

    this.getgruposanguinio = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrargruposanguinio',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idgruposanguineo) selected = "selected=''";
            select += "<option value='"+data[i].idgruposanguineo+"' "+selected+" >"+data[i].nombregruposanguineo+"</option>";
        }
        $(div).html(select);
    }

    this.getreligion = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarreligion',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idreligion) selected = "selected=''";
            select += "<option value='"+data[i].idreligion+"' "+selected+" >"+data[i].nombrereligion+"</option>";
        }
        $(div).html(select);
    }

    this.getocupacion = function(id, div){

      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarocupacion',
            dataType: 'json',
        });

        var select = "<option value=''>Seleccione</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idocupacion) selected = "selected=''";
            select += "<option value='"+data[i].idocupacion+"' "+selected+" >"+data[i].nombreocupacion+"</option>";
        }
        $(div).html(select);
    }

    this.calcularedad = function(id, div, url){
        alert(url);
        setTimeout(function(){ 
            var data = obj_funciones.getajaxsimple({
                type: 'POST',
                url : url,
                data: {'fechanacimiento': id},
                dataType: 'json',
            });
            $(div).val(data.edad);
        },300);  
    }

    this.getdatapaciente = function(id, url){
       
       obj_funciones.inicio_ajax(); 
       pacienteid = id;
       setTimeout(function(){
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : url,
            data: {'idpaciente': id},
            dataType: 'json',
        });

       console.log(data);

       if (data.length > 0){

            $('#primernombre').val(data[0].primernombre);
            $('#primernombre').attr('disabled', 'disabled');
            $('#segundonombre').val(data[0].segundonombre);
            $('#segundonombre').attr('disabled', 'disabled');
            $('#primerapellido').val(data[0].primerapellido);
            $('#primerapellido').attr('disabled', 'disabled');
            $('#segundoapellido').val(data[0].segundoapellido);
            $('#segundoapellido').attr('disabled', 'disabled');
            obj_funciones.getentidades(data[0].idinstitucioneapb,'#entidadsalud');
            obj_funciones.departamentos(data[0].departamentoid,'#iddepartamento');
            obj_funciones.municipios(data[0].departamentoid,'#idmunicipionacimiento',base_url+'/municipios',data[0].idmunicipionacimiento);
            $('#entidadsalud').removeAttr('disabled');
            obj_funciones.getconvenios(data[0].idinstitucioneapb,'#convenios');
            $('#convenios').removeAttr('disabled');
            obj_funciones.getregimen(data[0].idregimen,'#idregimen');
            $('#idregimen').removeAttr('disabled');
            obj_funciones.getafiliacion(data[0].idtipoafiliacion,'#idtipoafiliacion');
            $('#idtipoafiliacion').removeAttr('disabled');
            obj_funciones.getanivel(data[0].idnivel,'#idnivel');
            $('#idnivel').removeAttr('disabled');  
            $('#fechanacimiento').val(data[0].fechanacimiento);
            obj_funciones.getsexos(data[0].idsexo,'#idsexo');
            obj_funciones.getestadocivil(data[0].idestadocivil,'#idestadocivil');
            obj_funciones.getgruposanguinio(data[0].idgruposanguineo,'#idgruposanguineo');
            obj_funciones.getreligion(data[0].idreligion,'#idreligion');
            obj_funciones.getocupacion(data[0].idocupacion,'#idocupacion');
            $('#direccion').val(data[0].direccion);
            $('#telefono').val(data[0].numerotelefonofijo);
            $('#celular').val(data[0].numerocelular);
            $('#email').val(data[0].email);
            $('#edad').val(data[0].edad);
            obj_funciones.getbarrio(data[0].idbarrio,'#idbarrio');
            obj_funciones.getzonas(data[0].idzonaresidencial,'#idzonaresidencial');
       }else{
            alert('error en la consulta no existe ningun Paciente con esa expecificación')
       }
      },300);  
    }

    this.getentidades = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarentidades',
            //data: {'idinstitucioneapb': id},
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idinstitucioneapb) selected = "selected=''";
            select += "<option value='"+data[i].idinstitucioneapb+"' "+selected+" >"+data[i].nombreinstitucioneapb+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getconvenios = function(id, div, idselect){
      if(id == undefined) id = "";
      if(idselect == undefined) idselect = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarconvenios',
            data: {'idinstitucioneapb': id},
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(idselect != "" && idselect == data[i].idconvenio) selected = "selected=''";
            select += "<option value='"+data[i].idconvenio+"' "+selected+" >"+data[i].nombreconvenio+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getregimen = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarregimen',
            //data: {'idinstitucioneapb': id},
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idregimen) selected = "selected=''";
            select += "<option value='"+data[i].idregimen+"' "+selected+" >"+data[i].nombreregimen+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getafiliacion = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarafiliacion',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idtipoafiliacion) selected = "selected=''";
            select += "<option value='"+data[i].idtipoafiliacion+"' "+selected+" >"+data[i].nombretipoafiliacion+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getanivel = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarnivel',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idnivel) selected = "selected=''";
            select += "<option value='"+data[i].idnivel+"' "+selected+" >"+data[i].nombrenivel+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getbarrio = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarbarrios',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idbarrio) selected = "selected=''";
            select += "<option value='"+data[i].idbarrio+"' "+selected+" >"+data[i].nombrebarrio+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getzonas = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarzonas',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idzonaresidencial) selected = "selected=''";
            select += "<option value='"+data[i].idzonaresidencial+"' "+selected+" >"+data[i].nombrezonaresidencial+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getviaingreso = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarviasingreso',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idviaingreso) selected = "selected=''";
            select += "<option value='"+data[i].idviaingreso+"' "+selected+" >"+data[i].nombreviaingreso+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.getorigenatencion = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrarorigenatencion',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idorigenatencion) selected = "selected=''";
            select += "<option value='"+data[i].idorigenatencion+"' "+selected+" >"+data[i].nombreorigenatencion+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    this.gettipoatencion = function(id, div){
      if(id == undefined) id = "";
       var data = obj_funciones.getajaxsimple({
            type: 'POST',
            url : base_url+'/mostrartipoatencion',
            dataType: 'json',
        });

        var select = "<option value=''>::Seleccione:::</option>";
        for(var i = 0; i < data.length ; i++){
            selected="";
            if(id != "" && id == data[i].idtipoatencion) selected = "selected=''";
            select += "<option value='"+data[i].idtipoatencion+"' "+selected+" >"+data[i].nombretipoatencion+"</option>";
        }
        $(div).html(select);
        obj_funciones.setselect2(div);
    }

    
    
    this.editarPaciente = function(){
      if (pacienteid > 0){
          obj_funciones.inicio_ajax('15');   
        setTimeout(function(){

          var data = obj_funciones.getajaxsimple({
            type: 'POST',
            data: {'idpaciente':pacienteid},
            url : base_url+'/mostrardatapacientes',
            dataType: 'json',
          });

         if (data != ''){
            $('#registro-avanzada').collapse('show');
            $('#idpaciente').val(data[0].idpaciente);
            $('#primernombre').val(data[0].primernombre);
            $('#primernombre').attr('disabled', 'disabled');
            $('#segundonombre').val(data[0].segundonombre);
            $('#segundonombre').attr('disabled', 'disabled');
            $('#primerapellido').val(data[0].primerapellido);
            $('#primerapellido').attr('disabled', 'disabled');
            $('#segundoapellido').val(data[0].segundoapellido);
            $('#segundoapellido').attr('disabled', 'disabled');
            obj_funciones.getentidades(data[0].idinstitucioneapb,'#entidadsalud');
            obj_funciones.departamentos(data[0].departamentoid,'#iddepartamento');
            obj_funciones.municipios(data[0].departamentoid,'#idmunicipionacimiento',base_url+'/municipios',data[0].idmunicipionacimiento);
            $('#entidadsalud').removeAttr('disabled');
            obj_funciones.getconvenios(data[0].idinstitucioneapb,'#convenios');
            $('#convenios').removeAttr('disabled');
            obj_funciones.getregimen(data[0].idregimen,'#idregimen');
            $('#idregimen').removeAttr('disabled');
            obj_funciones.getafiliacion(data[0].idtipoafiliacion,'#idtipoafiliacion');
            $('#idtipoafiliacion').removeAttr('disabled');
            obj_funciones.getanivel(data[0].idnivel,'#idnivel');
            $('#idnivel').removeAttr('disabled');  
            $('#fechanacimiento').val(data[0].fechanacimiento);
            obj_funciones.getsexos(data[0].idsexo,'#idsexo');
            obj_funciones.getestadocivil(data[0].idestadocivil,'#idestadocivil');
            obj_funciones.getgruposanguinio(data[0].idgruposanguineo,'#idgruposanguineo');
            obj_funciones.getreligion(data[0].idreligion,'#idreligion');
            obj_funciones.getocupacion(data[0].idocupacion,'#idocupacion');
            $('#direccion').val(data[0].direccion);
            $('#telefono').val(data[0].numerotelefonofijo);
            $('#celular').val(data[0].numerocelular);
            $('#email').val(data[0].email);
            $('#edad').val(data[0].edad);
            obj_funciones.getbarrio(data[0].idbarrio,'#idbarrio');
            obj_funciones.getzonas(data[0].idzonaresidencial,'#idzonaresidencial');
            console.log(data);

         }else{
            alert('error en la consulta');
         }
        },300);  
      }else{
        alert('No tiene Paciente seleccionado');
        $('#registro-avanzada').collapse('hide');
      } 
    }     
}
var obj_funciones = new class_funciones();