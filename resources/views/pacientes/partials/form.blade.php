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

        <?php //echo Form::file('file', ['class' => 'form-conto']); ?>

    <div class="portlet light portlet-fit portlet-form ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="caption-subject font-dark sbold">Datos Paciente</span>
            </div>
        </div>
        <div class="portlet-body">

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Tipo de Documento
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                <select name="idtipodocumento" class="form-control select2 required" id="idtipodocumento">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($tipodocuemtos as $td)
                     <option value="{{ $td['idtipodocumento'] }}" <?php echo (isset($paciente->idtipodocumento) and $paciente->idtipodocumento == $td['idtipodocumento'])?'selected':''; ?>>{{ $td['nombretipodocumento'] }}</option>
                    @endforeach
                </select>
                <!--<input type="text" name="nombre" value="{{ old('nombre', (isset($comercializadora->nombre))?$comercializadora->nombre:'') }}" class="form-control required" /> -->
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Nro de Documento
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="text" name="numerodocumento" value="{{ old('numerodocumento', (isset($paciente->numerodocumento))?$paciente->numerodocumento:'') }}" class="form-control required">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Primer Nombre
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="text" name="primernombre" value="{{ old('primernombre', (isset($paciente->primernombre))?$paciente->primernombre:'') }}" class="form-control required">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Segundo Nombre
            </label>
            <div class="col-md-9">
                  <input type="text" name="segundonombre" value="{{ old('segundonombre', (isset($paciente->segundonombre))?$paciente->segundonombre:'') }}" class="form-control">
            </div>
        </div>

        <div class="col-md-12"></div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Primer Apellido
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="text" name="primerapellido" value="{{ old('primerapellido', (isset($paciente->primerapellido))?$paciente->primerapellido:'') }}" class="form-control">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Segundo Apellido
            </label>
            <div class="col-md-9">
                  <input type="text" name="segundoapellido" value="{{ old('segundoapellido', (isset($paciente->segundoapellido))?$paciente->segundoapellido:'') }}" class="form-control">
            </div>
        </div>


        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Sexo
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idsexo" class="form-control select2 required" id="idsexo">
                   <option value="" selected="">::Seleccione::</option>
                   @foreach ($sexo as $sx)
                    <option value="{{ $sx['idsexo'] }}" <?php echo (isset($paciente->idsexo) and $paciente->idsexo == $sx['idsexo'])?'selected':''; ?>>{{ $sx['nombresexo'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Estado Civil
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idestadocivil" class="form-control select2 required" id="idestadocivil">
                   <option value="" selected="">::Seleccione::</option>
                    @foreach ($estadocivil as $cv)
                    <option value="{{ $cv['idestadocivil'] }}" <?php echo (isset($paciente->idestadocivil) and $paciente->idestadocivil == $cv['idestadocivil'])?'selected':''; ?>>{{ $cv['nombreestadocivil'] }}</option>
                    @endforeach 
                </select>
            </div>
        </div>

         <div class="col-md-12"></div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Grupo Sanguinio
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idgruposanguineo" id="idgruposanguineo" class="form-control select2 required">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($gruposanguineo as $gs)
                    <option value="{{ $gs['idgruposanguineo'] }}" <?php echo (isset($paciente->idgruposanguineo) and $paciente->idgruposanguineo == $gs['idgruposanguineo'])?'selected':''; ?>>{{ $gs['nombregruposanguineo'] }}</option>
                    @endforeach 
                </select>
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Ocupación
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idocupacion" class="form-control select2 required" id="idocupacion">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($ocupacion as $op)
                    <option value="{{ $op['idocupacion'] }}" <?php echo (isset($paciente->idocupacion) and $paciente->idocupacion == $op['idocupacion'])?'selected':''; ?>>{{ $op['nombreocupacion'] }}</option>
                    @endforeach 
                </select>
            </div>
        </div>

         <div class="col-md-12"></div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Religión
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idreligion" class="form-control select2 required" id="idreligion">
                  
                  <option value="" selected="">::Seleccione::</option>
                    @foreach ($religion as $rl)
                    <option value="{{ $rl['idreligion'] }}" <?php echo (isset($paciente->idreligion) and $paciente->idreligion == $rl['idreligion'])?'selected':''; ?>>{{ $rl['nombrereligion'] }}</option>
                    @endforeach 
                </select>
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Dirección
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                <textarea class="form-control" name="direccion" rows="3"><?php echo isset($paciente->direccion)?$paciente->direccion:''; ?></textarea>
            </div>
        </div>

        <div class="col-md-12"></div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Numero de Télefono
            <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="text" name="numerotelefonofijo" value="{{ old('numerotelefonofijo', (isset($paciente->numerotelefonofijo))?$paciente->numerotelefonofijo:'') }}" class="form-control required">
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Numero de Celular
            <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="text" name="numerocelular" value="{{ old('numerocelular', (isset($paciente->numerocelular))?$paciente->numerocelular:'') }}" class="form-control required">
            </div>
        </div>

        <div class="col-md-12"></div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Email
            <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                  <input type="email" name="email" value="{{ old('email', (isset($paciente->email))?$paciente->email:'') }}" class="form-control required" required>
            </div>
        </div>

        <div class="col-md-12"></div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Departamento Dirección
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="departamento_id" id="departamento_id" class="form-control select2 required" onchange="obj_funciones.municipios(this.value,'#idmunicipio', '{{ route('municipios')}}');">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($departamentos as $d)
                    <option value="{{ $d['iddepartamento'] }}" <?php echo (isset($departamentoid2) && $departamentoid2 == $d['iddepartamento'])?'selected':'' ?>>{{ $d['nombredepartamento'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Municipio Dirección
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idmunicipio" id="idmunicipio" class="form-control select2 required">
                @if(isset($departamentoid))
                         @foreach ($municipios as $muni)
                            <option value="{{ $muni['idmunicipio'] }}" <?php echo (isset($paciente->idmunicipio) && $paciente->idmunicipio == $muni['idmunicipio'])?'selected':'' ?>>{{ $muni['nombremunicipio'] }}</option>
                        @endforeach
                    @endif;
               </select>
            </div>
        </div>

        <div class="col-md-12"></div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Barrio
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idbarrio" class="form-control select2 required" id="idbarrio">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($barrios as $bos)
                    <option value="{{ $bos['idbarrio'] }}" <?php echo (isset($paciente->idbarrio) and $paciente->idbarrio == $bos['idbarrio'])?'selected':''; ?>>{{ $bos['nombrebarrio'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Zona Residencial
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idzonaresidencial" class="form-control required select2" id="idzonaresidencial">
                   <option value="" selected="">::Seleccione::</option>
                    @foreach ($zonas as $zna)
                    <option value="{{ $zna['idzonaresidencial'] }}" <?php echo (isset($paciente->idzonaresidencial) and $paciente->idzonaresidencial == $zna['idzonaresidencial'])?'selected':''; ?>>{{ $zna['nombrezonaresidencial'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

      </div>
    </div>    

        <div class="col-md-12"></div>

         <div class="portlet light portlet-fit portlet-form ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="caption-subject font-dark sbold">Datos Nacimiento</span>
            </div>
        </div>
        <div class="portlet-body">

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Fecha de Nacimiento
            </label>
            <div class="col-md-9">
                  <input type="text" name="fechanacimiento" id="fechanacimiento" value="{{ old('fechanacimiento', (isset($paciente->fechanacimiento))?$paciente->fechanacimiento:'') }}" class="form-control required" onchange="obj_funciones.calcularedad(this.value,'#edad','{{ route('calcularedad')}}')">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Edad
            </label>
            <div class="col-md-9">
                  <input type="text" readonly="" id="edad" name="edad" value="<?php echo (isset($paciente->fechanacimiento))? calcularedad($paciente->fechanacimiento) : '' ?>" class="form-control">
            </div>
        </div>

        <div class="col-md-12"></div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Departamento Nacimiento
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="departamento_id" id="departamento_id" class="form-control select2 required" onchange="obj_funciones.municipios(this.value,'#municipio', '{{ route('municipios')}}');">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($departamentos as $d)
                    <option value="{{ $d['iddepartamento'] }}" <?php echo (isset($departamentoid) && $departamentoid == $d['iddepartamento'])?'selected':'' ?>>{{ $d['nombredepartamento'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

         <div class="form-group col-md-6">
            <label class="control-label col-md-3">Municipio Nacimiento
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idmunicipionacimiento" id="municipio" class="form-control select2 required">
                    @if(isset($departamentoid))
                         @foreach ($municipios as $muni)
                            <option value="{{ $muni['idmunicipio'] }}" <?php echo (isset($paciente->idmunicipionacimiento) && $paciente->idmunicipionacimiento == $muni['idmunicipio'])?'selected':'' ?>>{{ $muni['nombremunicipio'] }}</option>
                        @endforeach
                    @endif;
                </select>
            </div>
        </div>
      </div>
    </div> 


        <div class="col-md-12"></div>

        <div class="portlet light portlet-fit portlet-form ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="caption-subject font-dark sbold">Datos de Seguridad Social</span>
            </div>
        </div>
        <div class="portlet-body">

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Entidad de Salud
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idinstitucioneapb" class="form-control select2 required" id="idinstitucioneapb">
                    <option value="" selected="">::Seleccione::</option>
                    @foreach ($instituciones as $is)
                    <option value="{{ $is['idinstitucioneapb'] }}" <?php echo (isset($paciente->idinstitucioneapb) and $paciente->idinstitucioneapb == $is['idinstitucioneapb'])?'selected':''; ?>>{{ $is['nombreinstitucioneapb'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="control-label col-md-3">Regimen
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
               <select name="idregimen" class="form-control select2 required" id="idregimen">
                  <option value="" selected="">::Seleccione::</option>
                    @foreach ($regimen as $rg)
                    <option value="{{ $rg['idregimen'] }}" <?php echo (isset($paciente->idregimen) and $paciente->idregimen == $rg['idregimen'])?'selected':''; ?>>{{ $rg['nombreregimen'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12"></div>

             <div class="form-group col-md-6">
                <label class="control-label col-md-3">Tipo de Afiliación
                    <span class="required"> * </span>
                </label>
                <div class="col-md-9">
                   <select name="idtipoafiliacion" class="form-control select2 required" id="idtipoafiliacion">
                       <option value="" selected="">::Seleccione::</option>
                        @foreach ($afiliaciones as $af)
                        <option value="{{ $af['idtipoafiliacion'] }}" <?php echo (isset($paciente->idtipoafiliacion) and $paciente->idtipoafiliacion == $af['idtipoafiliacion'])?'selected':''; ?>>{{ $af['nombretipoafiliacion'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label col-md-3">Nivel
                    <span class="required"> * </span>
                </label>
                <div class="col-md-9">
                   <select name="idnivel" class="form-control select2 required" id="idnivel">
                      <option value="" selected="">::Seleccione::</option>
                        @foreach ($niveles as $nivel)
                        <option value="{{ $nivel['idnivel'] }}" <?php echo (isset($paciente->idnivel) and $paciente->idnivel == $nivel['idnivel'])?'selected':''; ?>>{{ $nivel['nombrenivel'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            </div>
        </div>
    </div>    
</div>

@section('scripts')
<script type="text/javascript">
obj_funciones.setselect2('#idinstitucioneapb, #idtipodocumento, #idsexo, #idestadocivil, #idgruposanguineo, #idocupacion, #idreligion, #departamento_id, #idmunicipio, #idbarrio, #idzonaresidencial, #departamento_id, #municipio, #idregimen, #idtipoafiliacion, #idnivel');
$("#fechanacimiento").datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>
@endsection