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
    <div class="row">
        <div class="portlet-body">

            <div class="col-md-4">
                <div class="form-group">
                    <label>Código  <span class="required"> * </span></label>
                    <input type="text" name="codigodiagnostico" value="{{ old('codigodiagnostico', (isset($diagnostico->codigodiagnostico))?$diagnostico->codigodiagnostico:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Nombre Diagnostico  <span class="required"> * </span></label>
                    <input type="text" name="nombrediagnostico" value="{{ old('nombrediagnostico', (isset($diagnostico->nombrediagnostico))?$diagnostico->nombrediagnostico:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Sexo </label>
                   <select name="idsexo" class="form-control">
                        <option value="0" selected="">::Seleccione::</option>
                        @foreach($sexos as $sexo)
                        <option value="{{$sexo->idsexo}}" <?php echo (isset($diagnostico->idsexo) and $diagnostico->idsexo == $sexo->idsexo)?'selected':'' ?>>{{$sexo->nombresexo}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Edad Minima  <span class="required"> * </span></label>
                    <input type="number" name="edadminima" value="{{ old('edadminima', (isset($diagnostico->edadminima))?$diagnostico->edadminima:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Edad Máxima  <span class="required"> * </span></label>
                    <input type="number" name="edadmaxima" value="{{ old('edadmaxima', (isset($diagnostico->edadmaxima))?$diagnostico->edadmaxima:'') }}" class="form-control required">
                </div>  
            </div>
        </div>
    </div>   
</div>    

@section('scripts')
<script type="text/javascript">
</script>
@endsection