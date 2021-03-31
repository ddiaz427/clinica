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
        <label class="control-label col-md-3">Nombre
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="name" value="{{ old('name', (isset($usuario->name))?$usuario->name:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">E-mail
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="email" value="{{ old('email', (isset($usuario->email))?$usuario->email:'') }}" class="email form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Teléfono
        </label>
        <div class="col-md-4">
            <input type="text" name="phone" value="{{ old('phone', (isset($usuario->phone))?$usuario->phone:'') }}" class="form-control" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Móvil
        </label>
        <div class="col-md-4">
            <input type="text" name="mobile" value="{{ old('mobile', (isset($usuario->mobile))?$usuario->mobile:'') }}" class="form-control" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Fax
        </label>
        <div class="col-md-4">
            <input type="text" name="fax" value="{{ old('fax', (isset($usuario->fax))?$usuario->fax:'') }}" class="form-control" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Rol
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
        <select class="form-control required" name="rol_id">
            <option value="">Seleccione...</option>
        	<?php foreach ($roles as $rol):?>
            	<option <?=((isset($usuario->rol_id) && $usuario->rol_id==$rol->id)?'selected':'')?> value="{{ $rol->id }}">{{ $rol->nombre }}</option>
			<?php endforeach ?>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Password
            <?= ((isset($usuario->id))?'':'<span class="required"> * </span>') ?>
        </label>
        <div class="col-md-4">
            <input type="password" id="password" name="password" class="form-control  {{ ((isset($usuario))?'':'required') }}" /> </div>
    </div>
    <div class="form-group last">
        <label class="control-label col-md-3">Confirmar Password
            <?= ((isset($usuario->id))?'':'<span class="required"> * </span>') ?>
        </label>
        <div class="col-md-4">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control {{ ((isset($usuario->id))?'':'required') }}" /> </div>
    </div>
</div>
