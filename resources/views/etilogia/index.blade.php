@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 util-btn-margin-bottom-5">
                @include('partials.mensajes_crud')
                @include('partials.boton_nuevo', array('controller' => 'etiologia', 'ruta' => '', 'accion' => 'create'))
                </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box default">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $titulo }}
                            </div>
							<div class="tools"> </div>
                        </div>
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="all text-center">Nombre</th>
                                        <th class="all text-center">Fecha de Creación</th>
                                        <th class="all text-center">Fecha de Actualización</th>
                                        <th class="desktop text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($etilogias as $etilogia)
                                    <tr>
                                        <td class="all text-center">{{ $etilogia->nombreetiologia }}</td>
                                        <td class="all text-center">{{ fechaseteada($etilogia->fechacreacion) }}</td>
                                        <td class="all text-center">{{ fechaseteada($etilogia->fechaultmodificacion) }}</td>
                                    <td class="desktop text-center">
                                    @include('partials.botones_listado', array('controller' => 'etiologia', 'ruta' => '', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $etilogia->idetiologia))
                                    </td>
                                 </tr>
                                  @endforeach
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