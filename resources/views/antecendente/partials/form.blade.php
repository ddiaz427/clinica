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

            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre  <span class="required"> * </span></label>
                    <input type="text" name="nombreantecedente" value="{{ old('nombreantecedente', (isset($antecendente->nombreantecedente))?$antecendente->nombreantecedente:'') }}" class="form-control required">
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Tipo de Antecedente  <span class="required"> * </span></label>
                    <select name="idtipoantecedente" class="form-control required">
                        <option value="" selected="">::Seleccione::</option>
                        @foreach($tipoantecendentes as $tipoantecendente)
                        <option value="{{ $tipoantecendente->idtipoantecedente }}" <?php echo (isset($antecendente->idtipoantecedente) and $antecendente->idtipoantecedente == $tipoantecendente->idtipoantecedente)?'selected':'' ?>>{{ $tipoantecendente->nombretipoantecedente }}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
        </div>
    </div>   
</div>    

@section('scripts')
<script type="text/javascript">
</script>
@endsection