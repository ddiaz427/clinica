@extends('main')

@section('content')
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Agregar Tipo entidad</span>
                            </div>
                        </div>
                        <div class="portlet-body">                        
                            <!-- BEGIN FORM-->
                            <form action="{{ route('crear-pto-tipo-entidad')}}" method="post" id="formdata" class="form-horizontal">
 								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                             	@include('pto/maestros/tipo_entidades.partials.form')
                                @include('partials.boton_guardar', array('controller' => 'ptotipoentidad', 'accion' => 'store', 'ruta_index' => 'pto-tipo-entidad'))
                            </form>
                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
@endsection