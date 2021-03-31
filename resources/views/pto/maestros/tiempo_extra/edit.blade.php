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
                                <span class="caption-subject font-dark sbold uppercase">Editar Transaccion</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                        
                            <!-- BEGIN FORM-->
                            <form action="{{ route('actualizar-transacciones', ['id' => $tipotransacciones->pk_id_tipo_transaccion]) }}" method="post" id="formdata" class="form-horizontal">
 								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                             	@include('pto/maestros/tipo_transacciones.partials.form');
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