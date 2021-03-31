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
                @include('partials.boton_nuevo', array('controller' => 'paciente', 'ruta' => '', 'accion' => 'create'))
                </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box default">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>{{ $titulo }}
                            </div>
							<div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                        
                        <?php //print_r($pacientes); ?>
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="all text-center">Paciente</th>
                                        <th class="all text-center">Tipo Documento</th>
                                        <th class="all text-center">Nro de Documento</th>
                                        <th class="all text-center">Fecha de Nacimiento</th>
                                        <th class="all text-center">Sexo</th>
                                        <th class="all text-center">Estado Civil</th>
                                        <th class="desktop text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td class="all text-center">{{ $paciente->nombrepaciente }}</td>
                                        <td class="all text-center">{{ $paciente->nombretipodocumento }}</td>
                                        <td class="all text-center">{{ $paciente->numerodocumento }}</td>
                                        <td class="all text-center">{{ fechaseteada($paciente->fechanacimiento) }}</td>
                                        <td class="all text-center">{{ $paciente->nombresexo }}</td>
                                        <td class="all text-center">{{ $paciente->nombreestadocivil }}</td>
                                    <td class="desktop">
                                    @include('partials.botones_listado', array('controller' => 'paciente', 'ruta' => '', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $paciente->idpaciente))
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