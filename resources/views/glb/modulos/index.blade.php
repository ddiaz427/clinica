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
                @include('partials.boton_nuevo', array('controller' => 'modulo', 'ruta' => '', 'accion' => 'create'))
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
                                        <th class="desktop">Módulo</th>
                                        <th class="desktop">Grupo</th>
                                        <th class="all">Estado</th>
                                        <th class="desktop">Creado por</th>
                                        <th class="desktop">Fecha Creación</th>
                                        <th class="desktop">Fecha Actualización</th>
                                        <th class="desktop">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach ($modulos as $modulo): ?>
                                    <tr class="text-center">
                                        <td class="all">{{ $modulo->desc_modulo }}</td>
                                        <td class="desktop">{{ $modulo->modulo }}</td>
                                        <td class="desktop">{{ $modulo->grupomodulos->nombre }}</td>
                                        <td class="all">{{ $modulo->estado }}</td>
                                        <td class="desktop">{{ $modulo->created_by }}</td>
                                        <td class="desktop">{{ $modulo->created_at }}</td>
                                        <td class="desktop">{{ $modulo->updated_at }}</td>
                                        <td class="desktop text-center">
                						@include('partials.botones_listado', array('controller' => 'modulo', 'ruta' => '', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $modulo['id']))
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