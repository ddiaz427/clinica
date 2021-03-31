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
                @include('partials.boton_nuevo', array('controller' => 'tipomov', 'ruta' => 'pto-tipo-mov', 'accion' => 'create'))
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
                                        <th class="all">Codigo</th>                                        
                                        <th class="all">Descripcion</th>
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tipomov as $tipomov):?>
                                    <tr>
                                        <td class="all">{{ $tipomov->pk_id_tipo_mov }}</td>
                                        <td class="all">{{ $tipomov->descripcion }}</td>
                                        <td class="all">
                						@include('partials.botones_listado', array('controller' => 'tipomov', 'ruta' => 'pto-tipo-mov', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $tipomov->pk_id_tipo_mov))
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