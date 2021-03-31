@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 util-btn-margin-bottom-5">
                    <a href="{{ route('crear-tiempo')}}" class="btn blue">
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
                                        <th class="desktop">Observaciones</th>                                        
                                        <th class="all">Fecha Inicial</th>
                                        <th class="all">Fecha Final</th>                                       
                                        <th class="all">Creado por</th>
                                        <th class="all">Fecha Creación</th>
                                        <th class="all">Fecha Actualización</th>
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tiempoextra as $tiempo):?>
                                    <tr>
                                         <td class="all">{{ $tiempo->observacion }}</td>
                                        <td class="desktop">{{ $tiempo->hora_inicio }}</td>
                                        <td class="all">{{ $tiempo->hora_final }}</td>                 
                                        <td class="all">{{ $tiempo->created_by }}</td>
                                        <td class="all">{{ $tiempo->created_at }}</td>
                                        <td class="all">{{ $tiempo->updated_at }}</td>
                                        <td class="all">
                                        <a href="{{ route('editar-transacciones', ['id' => $tiempo->pk_id_tipo_transaccion]) }}" class="btn blue">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Borrar" href="{{ route('eliminar-usuario', ['id' => $tiempo->pk_id_tipo_transaccion]) }}" class=" item-borrar btn blue">
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