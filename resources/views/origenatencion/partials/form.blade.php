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
                <label >Código Origen Atención  <span class="required"> * </span></label>
                <input type="text" name="codigoorigenatencion" value="{{ old('codigoorigenatencion', (isset($origenatencion->codigoorigenatencion))?$origenatencion->codigoorigenatencion:'') }}" class="form-control required">
            </div>

              <div class="form-group">
                <label >Nombre  <span class="required"> * </span></label>
                <input type="text" name="nombreorigenatencion" value="{{ old('nombreorigenatencion', (isset($origenatencion->nombreorigenatencion))?$origenatencion->nombreorigenatencion:'') }}" class="form-control required">
              </div>
            </div>
        </div>
    </div>  
 </div>    

@section('scripts')
<script type="text/javascript">
</script>
@endsection