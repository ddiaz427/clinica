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
    <div class="form-group">
        <label class="control-label col-md-3">Nombre
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="desc_modulo" value="{{ old('desc_modulo', (isset($modulo->desc_modulo))?$modulo->desc_modulo:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Módulo
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="modulo" value="{{ old('modulo', (isset($modulo->modulo))?$modulo->modulo:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Ruta
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="ruta_index" value="{{ old('ruta_index', (isset($modulo->ruta_index))?$modulo->ruta_index:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Grupo
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
        <select class="form-control required" name="grupomodulo_id">
            <option value="">Seleccione...</option>
        	<?php foreach ($grupomodulos as $grupomodulo):?>
            	<option <?=((isset($modulo) && $modulo->grupomodulo_id == $grupomodulo->id)?'selected':'')?> value="{{ $grupomodulo->id }}">{{ $grupomodulo->nombre }}</option>
			<?php endforeach ?>
        </select>
        </div>
    </div>
</div>
