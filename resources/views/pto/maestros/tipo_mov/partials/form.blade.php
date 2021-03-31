<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
	@if ($errors->has())
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach ($errors->all() as $error)
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
            <input type="text" name="descripcion" value="{{ old('descripcion', (isset($tipomov->descripcion))?$tipomov->descripcion:'') }}" class="form-control required" /> </div>
    </div>
    
</div> 