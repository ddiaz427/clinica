<div class="form-actions">
    <div class="row">
        <div class="col-md-12 text-center">
            @if(Auth::user()->hasAccess($controller,$accion))
            <button type="submit" class="btn green">Guardar</button>
            @endif
           <a href="{{ route($ruta_index)}}" class="btn green">Cancelar</a>
        </div>
    </div>
</div>
