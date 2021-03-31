@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 util-btn-margin-bottom-5">
                    <a href="{{ route('crear-usuario')}}" class="btn blue">
                        Nuevo
                        <i class="fa fa-plus"></i>
                    </a>
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
                                        <th class="desktop">Nombre</th>
                                        <th class="all">Email</th>
                                        <th class="all">Rol</th>
                                        <th class="desktop">Fecha Creación</th>
                                        <th class="desktop">Ultimo Login</th>
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach ($usuarios as $usuario):?>
                                    <tr>
                                        <td class="desktop">{{ $usuario->name }}</td>
                                        <td class="all">{{ $usuario->email }}</td>
                                        <td class="all">{{ $usuario->rol['nombre'] }}</td>
                                        <td class="desktop">{{ $usuario->created_at }}</td>
                                        <td class="desktop">{{ $usuario->last_login }}</td>
                                        <td class="all text-center">
                                        <a href="{{ route('editar-usuario', ['id' => $usuario->id]) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Borrar" href="{{ route('eliminar-usuario', ['id' => $usuario->id]) }}" class=" item-borrar btn btn-danger">
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