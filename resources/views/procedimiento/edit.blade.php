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
                                <span class="caption-subject font-dark sbold uppercase">{{ $titulo }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                        
                            <!-- BEGIN FORM-->
                            <form action="{{ route('editar-procedimiento', ['idprocedimiento' => $procedimiento->idprocedimiento]) }}" method="post" id="formdata">
 								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                             	@include('procedimiento.partials.form')
                                @include('partials.boton_guardar', array('controller' => 'procedimiento', 'accion' => 'edit', 'ruta_index' => 'procedimientos'))
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