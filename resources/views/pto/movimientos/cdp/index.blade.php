@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 util-btn-margin-bottom-5">
                @include('partials.mensajes_crud')
                @include('partials.boton_nuevo', array('controller' => 'ptomovto', 'ruta' => 'pto-cdp', 'accion' => 'create'))
                </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>
                            </div>
							<div class="tools"> </div>
                        </div>
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3" cellspacing="0">
                               <thead>
                                    <tr>
                                        <th class="all">Tipo</th>                                        
                                        <th class="all">No.</th>                                        
                                        <th class="all">Fecha</th>                                        
                                        <th class="all">Descripcion</th>
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($movimientos as $movimiento):?>
                                    <tr>
                                        <td class="all">{{ (isset($movimiento->tipotransaccion->descrip))?$movimiento->tipotransaccion->descrip:'' }}</td>
                                        <td class="all">{{ $movimiento->nro_documento }}</td>
                                        <td class="all">{{ $movimiento->fecha_movto }}</td>
                                        <td class="all">{{ $movimiento->observacion }}</td>
                                        <td class="all">
                						@include('partials.botones_listado', array('controller' => 'ptomovto', 'ruta' => 'pto-cdp', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $movimiento->pk_id_movto))
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
@endsection