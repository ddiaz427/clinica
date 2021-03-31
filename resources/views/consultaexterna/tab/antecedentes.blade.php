<form action="{{ route('antecedentesubmit')}}" method="post" id="antecedenteform" onsubmit="submitAntecedente(); return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="admisionid" value="{{ $admisionid }}">

        <div id="mensaje_alert_antecedente"></div>

         <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1_115030" data-toggle="tab">Antecedentes</a>
            </li>
         </ul>
         
         <div class="tab-content" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">

            <div class="tab-pane active" id="tab1_115030">
            <div class="col-md-12" style="margin-top: 20px;"></div>
            @if(count($dataantecedente) > 0)
            
            @foreach($dataantecedente as $dc)
            
              @foreach($antecedentes as $ac)

                @if($dc->idantecedente == $ac->idantecedente)
                  <div class="col-md-3 text-danger" style="padding-bottom: 20px;">
                    <b><i class="fa fa-info-circle"></i> {{ $ac->nombreantecedente }}</b>
                    <input type="hidden" name="antecedentesid[]" value="{{$ac->idantecedente}}">
                  </div>
                   @if($ac->nombreantecedente != 'NUMERO HIJOS')
                    <div class="col-md-2" style="padding-bottom: 20px;">
                      <select name="estado[]" class="form-control select2" id="estadoid">
                         <option value="" selected="">::Seleccione::</option>
                         <option value="1" <?php echo ($dc->estado == '1')? 'selected':'' ?>>SI</option>  
                         <option value="2" <?php echo ($dc->estado == '2')? 'selected':'' ?>>NO</option>  
                      </select>
                    </div>
                   @endif
                  <div class="<?php echo ($ac->nombreantecedente != 'NUMERO HIJOS')?'col-md-6':'col-md-8' ?>" style="padding-bottom: 20px;">
                    <input class="form-control bs-autocomplete required" name="descripcionantecedente[]" id="descripcionexamen" value="{{ $dc->descripcion }}" type="<?php echo ($ac->nombreantecedente != 'NUMERO HIJOS')?'text':'number' ?>">
                  </div>
                  @endif
                @endforeach
             @endforeach   

            @else

                @foreach($antecedentes as $ac)
                  <div class="col-md-3 text-danger" style="padding-bottom: 20px;">
                    <b><i class="fa fa-info-circle"></i> {{ $ac->nombreantecedente }}</b>
                    <input type="hidden" name="antecedentesid[]" value="{{$ac->idantecedente}}">
                  </div>
                   @if($ac->nombreantecedente != 'NUMERO HIJOS')
                  <div class="col-md-2" style="padding-bottom: 20px;">
                    <select name="estado[]" class="form-control select2" id="estadoid">
                       <option value="" selected="">::Seleccione::</option>
                       <option value="1">SI</option>  
                       <option value="2">NO</option>  
                    </select>
                  </div>
                  @endif
                  <div class="<?php echo ($ac->nombreantecedente != 'NUMERO HIJOS')?'col-md-6':'col-md-8' ?>" style="padding-bottom: 20px;">
                    <input class="form-control" name="descripcionantecedente[]" id="descripcionexamen" value="" type="<?php echo ($ac->nombreantecedente != 'NUMERO HIJOS')?'text':'number' ?>">
                  </div>
                @endforeach
               @endif   
            </div>
          </div>   

    <div class="col-md-12 text-center" style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Guardar</button>
    </div> 

    <div class="col-md-12" style="margin-top:30px;"></div>
    </form>

<script type="text/javascript">

  function submitAntecedente() {
     obj_funciones.inicio_ajax('10','Enviado Datos...');
     setTimeout(function(){

        var data = obj_funciones.getajaxsimple({
            url :  $('#antecedenteform').attr("action"), 
            data : $('#antecedenteform').serialize(),
        });
        
        if(data.response == true){
          $('#mensaje_alert_antecedente').html(data.mensaje);
          obj_funciones.mostrar_div('#mensaje_alert_enfermedad');
        }else{
           $('#mensaje_alert_antecedente').html(data.mensaje);
           obj_funciones.mostrar_div('#mensaje_alert_enfermedad');
        }
    },300);
    return false;
}
</script>   