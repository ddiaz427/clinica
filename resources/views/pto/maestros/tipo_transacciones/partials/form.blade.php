<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach (isset($errors) && $errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo. 
        </div>
    @endif
    <div class="form-group">
        <label class="control-label col-md-3">Descripción
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="descrip" value="{{ old('descrip', (isset($tipotransacciones->descrip))?$tipotransacciones->descrip:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Abreviatura
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="abrebiatura" value="{{ old('abrebiatura', (isset($tipotransacciones->abrebiatura))?$tipotransacciones->abrebiatura:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Factor
        </label>
        <div class="col-md-4">
            <input type="text" name="factor" value="{{ old('factor', (isset($tipotransacciones->factor))?$tipotransacciones->factor:'') }}" class="form-control" /> </div>
    </div>
     <div class="form-group">
        <label class="control-label col-md-3">Requiere Solicitud
        </label>
        <div class="col-md-4">
            <input type="radio" name="req_solicitud" value="S" {{ (isset($tipotransacciones->req_solicitud)?(($tipotransacciones->req_solicitud=='S')?'checked="checked"':''):'')}} class="form-control"  />Si
            <input type="radio" name="req_solicitud" value="N" {{ (isset($tipotransacciones->req_solicitud)?(($tipotransacciones->req_solicitud=='N')?'checked="checked" ':''):'')}}  class="form-control" />No
          
        </div>
    </div>
  
    <div class="form-group">
     <label class="control-label col-md-3">Documento Afectado
        </label>
        <div class="col-md-4">
        <select class="form-control required" name="documento_afectado">
            <option value="">Seleccione...</option>
            <?php foreach ($transacciones as $transac):?>
                <option <?=((isset($tipotransacciones) && $tipotransacciones->documento_afectado == $transac->pk_id_tipo_transaccion)?'selected':'')?> value="{{ $transac->pk_id_tipo_transaccion }}">{{ $transac->descrip }}</option>
            <?php endforeach ?> </div>
        </select>
    </div>
</div>  
   
    

<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Guardar</button>
            <a href="{{ route('transacciones')}}" class="btn green">Listado</a>
        </div>
    </div>
</div>
