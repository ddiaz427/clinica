<ul class="nav nav-tabs">
  <li class="active">
      <a href="#tab1_115030" data-toggle="tab">Incapacidad</a>
  </li>

   <li>
      <a href="#tab2_115030" data-toggle="tab">Remisión</a>
  </li>
</ul> 

<div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">
    <div class="tab-pane active" id="tab1_115030">
      <div class="col-md-12" style="margin-top: 20px;"></div>

        <div id="mensaje_alert_incapacidad"></div>

        <form action="{{ route('incapacidadsubmit')}}" method="post" id="incapacidadform" onsubmit="submitIncapacidad(); return false;">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="admisionid" value="<?php echo $admisionid; ?>">

          <div class="col-md-4">
              <label>Nro Dias</label>
              <input type="number" name="diasincapacidad" class="form-control" id="diasincapacidad" value="{{isset($admision->diasincapacidad)?$admision->diasincapacidad:''}}">
          </div>

          <div class="col-md-8">
               <label>Descripción</label>
               <textarea name="descripcionincapacidad" class="form-control" id="descripcionincapacidad" rows="3">{{isset($admision->descripcionincapacidad)?$admision->descripcionincapacidad:''}}</textarea>
          </div>

          <div class="col-md-12 text-center" style="margin-top: 20px;">
              <button type="submit" class="btn btn-success">Guardar Incapacidad</button>
          </div>

          <div class="col-md-12" style="margin-top:30px;"></div>    
       </form>

    </div>

     <div class="tab-pane" id="tab2_115030">
      <div class="col-md-12" style="margin-top: 20px;"></div>
       <div id="mensaje_alert_remision"></div>
       <form action="{{ route('remisionsubmit')}}" method="post" id="remisionform" onsubmit="submitRemision(); return false;">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="admisionid" value="<?php echo $admisionid; ?>">

           <div class="col-md-4">
               <label>Fecha</label>
               <input class="form-control bs-autocomplete required" name="fecharemision" id="fecharemision" value="{{(isset($admisionremision->fechaprocedimiento))?$admisionremision->fecharemision: date('d/m/Y')}}" type="text">
          </div>

           <div class="col-md-2">
               <label>Hora</label>
               <input class="form-control bs-autocomplete required" name="horaremision" id="paciente" value="{{(isset($admisionremision->horaremision))?$admisionremision->horaremision: date('h:m:s')}}" type="time">
           </div>

            <div class="col-md-6">
               <label>Especialidad</label>
               <select class="form-control" name="idespecialidad" id="idespecialidad" style="width: 100%">
                 <option value="" selected="">::Seleccione::</option>
                  @foreach($especialidad as $e)  
                  <option value="{{$e->idespecialidad}}" <?php echo (isset($admisionremision->idespecialidad) and $admisionremision->idespecialidad == $e->idespecialidad)?'selected':'' ?>>{{$e->nombreespecialidad}}</option>
                 @endforeach
               </select>
           </div>

            <div class="col-md-12" style="margin-top:30px;"></div>

            <div class="col-md-12">
               <label>Descripción</label>
               <textarea name="descripcionincapacidad" class="form-control" id="descripcionincapacidad" rows="3">{{(isset($admisionremision->descripcionremision))?$admisionremision->descripcionremision: ''}}</textarea>
           </div>    

          <div class="col-md-12 text-center" style="margin-top: 20px;">
              <button type="submit" class="btn btn-success">Guardar</button>
          </div> 
          <div class="col-md-12" style="margin-top:30px;"></div>   
       </form>

    </div>
 </div>   


<script type="text/javascript">

$("#fecharemision").datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    autoclose: true
});

obj_funciones.setselect2('#idespecialidad');

  function submitIncapacidad() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#incapacidadform').attr("action"), 
            data : $('#incapacidadform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_incapacidad').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_incapacidad');
        }else{
           $('#mensaje_alert_incapacidad').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_incapacidad');
        }
    },300);
    return false;
}

function submitRemision() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#remisionform').attr("action"), 
            data : $('#remisionform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_remision').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_remision');
        }else{
           $('#mensaje_alert_remision').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_remision');
        }
    },300);
    return false;
}
</script>   