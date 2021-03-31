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
                @include('partials.boton_nuevo', array('controller' => 'grupomodulo', 'ruta' => '', 'accion' => 'create'))
                </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box default">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>{{ $titulo_pagina }}
                            </div>
							<div class="tools"> </div>
                        </div>
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="datatable" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="all">Nombre</th>
                                        <th class="all">Estado</th>
                                        <th class="desktop">Creado por</th>
                                        <th class="desktop">Fecha Creación</th>
                                        <th class="desktop">Fecha Actualización</th>
                                        <th class="desktop">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach ($grupomodulos as $grupomodulo): ?>
                                    <tr class="text-center">
                                        <td class="all">{{ $grupomodulo['nombre'] }}</td>
                                        <td class="all">{{ $grupomodulo['estado'] }}</td>
                                        <td class="desktop">{{ $grupomodulo['created_by'] }}</td>
                                        <td class="desktop">{{ $grupomodulo['created_at'] }}</td>
                                        <td class="desktop">{{ $grupomodulo['updated_at'] }}</td>
                                        <td class="desktop">
                						@include('partials.botones_listado', array('controller' => 'grupomodulo', 'ruta' => '', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $grupomodulo['id']))
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