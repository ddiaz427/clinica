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
            <input type="text" name="nombre" value="{{ old('nombre', (isset($rol->nombre))?$rol->nombre:'') }}" class="form-control required" /> </div>
    </div>
    <?php if(!empty($modulos)):?>
		<?php foreach($modulos as $modulo):?>
        <div class="form-group">
            <label class="control-label col-md-3">{{ $modulo->desc_modulo }}
                <span class="required"> * </span>
            </label>
            <div class="input-group">
                <div class="icheck-inline">
                    <label>
                        <input name="modulos[{{ $modulo->id }}][consultar]" <?php if(isset($rol) && isset($permisos[$rol->id][$modulo->id]['consultar']) && $permisos[$rol->id][$modulo->id]['consultar'] == 1):?> checked <?php endif;?> type="checkbox" class="icheck" data-checkbox="icheckbox_flat-blue" value="1"> Consultar </label>
                    <label>
                        <input name="modulos[{{ $modulo->id }}][modificar]" <?php if(isset($rol) && isset($permisos[$rol->id][$modulo->id]['modificar']) && $permisos[$rol->id][$modulo->id]['modificar'] == 1):?> checked <?php endif;?> type="checkbox" class="icheck" data-checkbox="icheckbox_flat-blue" value="1"> Modificar </label>
                    <label>
                        <input name="modulos[{{ $modulo->id }}][agregar]" <?php if(isset($rol) && isset($permisos[$rol->id][$modulo->id]['agregar']) && $permisos[$rol->id][$modulo->id]['agregar'] == 1):?> checked <?php endif;?> type="checkbox" class="icheck" data-checkbox="icheckbox_flat-blue" value="1"> Agregar </label>
                    <label>
                        <input name="modulos[{{ $modulo->id }}][eliminar]" <?php if(isset($rol) && isset($permisos[$rol->id][$modulo->id]['eliminar']) && $permisos[$rol->id][$modulo->id]['eliminar'] == 1):?> checked <?php endif;?> type="checkbox" class="icheck" data-checkbox="icheckbox_flat-blue" value="1"> Eliminar </label>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    <?php endif;?>
</div>