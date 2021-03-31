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
                    <label>Cups  <span class="required"> * </span></label>
                    <input type="text" name="cups" value="{{ old('cups', (isset($procedimiento->cups))?$procedimiento->cups:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Soat  <span class="required"> * </span></label>
                    <input type="text" name="soat" value="{{ old('soat', (isset($procedimiento->soat))?$procedimiento->soat:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Es Cirugia  <span class="required"> * </span></label>
                    <select name="escirugia" class="form-control required">
                        <option value="" selected="">::Seleccione::</option>
                        <option value="1" <?php echo (isset($procedimiento->escirugia) and $procedimiento->escirugia == 1)?'selected':'' ?>>Si</option>
                        <option value="0" <?php echo (isset($procedimiento->escirugia) and $procedimiento->escirugia == 0)?'selected':'' ?>>NO</option>
                    </select>
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Nombre Procedimiento  <span class="required"> * </span></label>
                    <input type="text" name="nombreprocedimiento" value="{{ old('nombreprocedimiento', (isset($procedimiento->nombreprocedimiento))?$procedimiento->nombreprocedimiento:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Forma Generica  <span class="required"> * </span></label>
                    <input type="text" name="formagenerica" value="{{ old('formagenerica', (isset($procedimiento->formagenerica))?$procedimiento->formagenerica:'') }}" class="form-control required">
                </div>  
            </div>

             <div class="col-md-4">
                <div class="form-group">
                    <label>Tipo de Servicio  <span class="required"> * </span></label>
                    <select name="idtiposervicio" class="form-control required">
                        <option value="" selected="">::Seleccione::</option>
                        @foreach($servicios as $servicio)
                        <option value="{{$servicio->idtiposervicio}}" <?php echo (isset($procedimiento->idtiposervicio) and $procedimiento->idtiposervicio == $servicio->idtiposervicio)?'selected':'' ?>>{{$servicio->nombretiposervicio}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Sexo </label>
                   <select name="idsexo" class="form-control">
                        <option value="0" selected="">::Seleccione::</option>
                        @foreach($sexos as $sexo)
                        <option value="{{$sexo->idsexo}}" <?php echo (isset($procedimiento->idsexo) and $procedimiento->idsexo == $sexo->idsexo)?'selected':'' ?>>{{$sexo->nombresexo}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Edad Minima Procedmiento  <span class="required"> * </span></label>
                    <input type="number" name="edadminimaprocedimiento" value="{{ old('edadminimaprocedimiento', (isset($procedimiento->edadminimaprocedimiento))?$procedimiento->edadminimaprocedimiento:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Edad Máxima Procedmiento  <span class="required"> * </span></label>
                    <input type="number" name="edadmaximaprocedimiento" value="{{ old('edadmaximaprocedimiento', (isset($procedimiento->edadmaximaprocedimiento))?$procedimiento->edadmaximaprocedimiento:'') }}" class="form-control required">
                </div>  
            </div>
        </div>
    </div>   
</div>    

@section('scripts')
<script type="text/javascript">
</script>
@endsection