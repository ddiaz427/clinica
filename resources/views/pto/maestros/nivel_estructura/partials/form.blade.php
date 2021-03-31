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
        <label class="control-label col-md-3">Vigencia
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
        <select class="form-control required" name="vigencia">
            <option value="">Seleccione...</option>
            <option <?=((isset($nivelestructura) && $nivelestructura->vigencia == '2015')?'selected':'')?> value="2015">2015</option>    
            <option <?=((isset($nivelestructura) && $nivelestructura->vigencia == '2016')?'selected':'')?> value="2016">2016</option>                         
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Vigencia
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
        <select class="form-control required" name="fk_id_tipo_mov">
            <option value="">Seleccione...</option>
            <?php foreach ($tiposmovtos as $tipomovto):?>
                <option <?=((isset($nivelestructura) && $nivelestructura->fk_id_tipo_mov == $tipomovto->pk_id_tipo_mov)?'selected':'')?> value="{{ $tipomovto->pk_id_tipo_mov }}">{{ $tipomovto->descrip_mov }}</option>
            <?php endforeach ?>
        </select>
        </div>
    </div>    
    
    <div class="form-group">
        <label class="control-label col-md-3">Descripción
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="descripcion" value="{{ old('descripcion', (isset($nivelestructura->descripcion))?$nivelestructura->descripcion:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Nivel
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="nivel" value="{{ old('nivel', (isset($nivelestructura->nivel))?$nivelestructura->nivel:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Longitud
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="longitud" value="{{ old('longitud', (isset($nivelestructura->longitud))?$nivelestructura->longitud:'') }}" class="form-control required" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Desde
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" name="desde" value="{{ old('desde', (isset($nivelestructura->desde))?$nivelestructura->desde:'') }}" class="form-control required" /> </div>
    </div>
</div> 