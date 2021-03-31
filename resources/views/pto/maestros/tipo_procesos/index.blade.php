@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 util-btn-margin-bottom-5">
                    <a href="{{ route('crear-tipo')}}" class="btn blue">
                        Nuevo
                        <i class="fa fa-plus"></i>
                    </a>
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

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3" cellspacing="0" width="100%">
                               <thead>
                                    <tr>
                                        <th class="desktop">Codigo</th>                                        
                                        <th class="all">Descripcion</th>
                                        
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tipoproceso as $proceso):?>
                                    <tr>
                                         <td class="all">{{ $proceso->pk_id_tipo_proceso }}</td>
                                        <td class="desktop">{{ $proceso->descripcion }}</td>
                                        
                                        <td class="all">
                                        <a href="{{ route('editar-tipo', ['id' => $proceso->pk_id_tipo_proceso]) }}" class="btn blue">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Borrar" href="{{ route('eliminar-tipo', ['id' => $proceso->pk_id_tipo_proceso]) }}" class=" item-borrar btn blue">
                                            <i class="fa fa-trash"></i>
                                        </a>
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