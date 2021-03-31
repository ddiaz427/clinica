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

            <div class="col-md-4 col-md-offset-4">


            <div class="form-group">
                <label >Departamento  <span class="required"> * </span></label>
                <select name="iddepartamento" class="form-control select2" id="iddepartamento">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach($departamento as $d)
                        <option value="{{ $d->iddepartamento }}" <?php echo (isset($municipio->iddepartamento) and $municipio->iddepartamento == $d->iddepartamento)?'selected':''; ?>>{{ $d->nombredepartamento }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label >Municipio  <span class="required"> * </span></label>
                <input type="text" name="nombremunicipio" value="{{ old('nombremunicipio', (isset($municipio->nombremunicipio))?$municipio->nombremunicipio:'') }}" class="form-control required">
            </div>

              <div class="form-group">
                <label >Código Municipio  <span class="required"> * </span></label>
                <input type="text" name="codigomunicipiodane" value="{{ old('codigomunicipiodane', (isset($municipio->codigomunicipiodane))?$municipio->codigomunicipiodane:'') }}" class="form-control required">
              </div>
            </div>
        </div>
    </div>  
 </div>    

@section('scripts')
<script type="text/javascript">
obj_funciones_setselect2('#iddepartamento');
</script>
@endsection