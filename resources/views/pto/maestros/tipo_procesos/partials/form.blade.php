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
            <input type="text" name="descripcion" value="{{ old('descripcion', (isset($tipoproceso->descripcion))?$tipoproceso->descripcion:'') }}" class="form-control required" /> </div>
    </div>
    
</div>  
   
    

<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Guardar</button>
            <a href="{{ route('tipoProceso')}}" class="btn green">Listado</a>
        </div>
    </div>
</div>
