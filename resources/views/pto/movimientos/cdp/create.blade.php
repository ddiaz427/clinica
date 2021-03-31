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
                        <div class="portlet-body">                        
                            <!-- BEGIN FORM-->
                            <form action="{{ route('crear-pto-cdp')}}" method="post" id="formdata" class="form-horizontal">
 								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                             	@include('pto.movimientos.cdp.partials.form')
                                @include('partials.boton_guardar', array('controller' => 'ptomovto', 'accion' => 'store', 'ruta_index' => 'pto-cdp'))
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