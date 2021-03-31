<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button> Usted tiene algunos errores. Por favor, consulte más abajo. 
        </div>
    @endif
    <div>
    <div class="row">
        <div class="portlet-body">
                 <div class="form-group col-md-6">
                    <label class="control-label col-md-3">Nombre
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-9">
                          <input type="text" name="nombresexo" value="{{ old('nombresexo', (isset($sexo->nombresexo))?$sexo->nombresexo:'') }}" class="form-control required">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-3">Codigo
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-9">
                          <input type="text" name="codigosexo" value="{{ old('codigosexo', (isset($sexo->codigosexo))?$sexo->codigosexo:'') }}" class="form-control required">
                    </div>
                </div>
            </div>
        </div>
 </div>   

@section('scripts')
<script type="text/javascript">
</script>
@endsection