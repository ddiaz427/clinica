<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach (isset($errors) && $errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo. 
        </div>
    @endif
</div>
<div class="form-group">
    <label class="control-label col-md-3">Nombre
        <span class="required"> * </span>
    </label>
    <div class="col-md-4">
        <input type="text" name="nombre" value="{{ old('nombre', (isset($grupomodulo->nombre))?$grupomodulo->nombre:'') }}" class="form-control required" /> </div>
</div>
