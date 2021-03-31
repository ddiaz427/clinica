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
                @include('partials.boton_nuevo', array('controller' => 'ptonivelestruc', 'ruta' => 'pto-nivel-estructura', 'accion' => 'create'))
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
                                        <th class="all">Vigencia</th>                                        
                                        <th class="all">Descripcion</th>
                                        <th class="all">Tipos de Movimiento</th>
                                        <th class="all">Nivel</th>                                        
                                        <th class="all">Longitud</th>                                        
                                        <th class="all">Desde</th>                                        
                                        <th class="all">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($nivelestructura as $nivel):?>
                                    <tr>
                                        <td class="all">{{ $nivel->pk_id_nivel }}</td>
                                        <td class="desktop">{{ $nivel->vigencia}}</td>   
                                        <td class="all">{{ $nivel->descripcion }}</td>                                        
                                        <td class="desktop">{{ $nivel->tiposmovto->descrip_mov }}</td>   
                                        <td class="all">{{ $nivel->nivel }}</td>
                                        <td class="all">{{ $nivel->longitud }}</td>
                                        <td class="all">{{ $nivel->desde }}</td>                                        
                                                                                                                            
                                        <td class="all">
                						@include('partials.botones_listado', array('controller' => 'ptonivelestruc', 'ruta' => 'pto-nivel-estructura', 'accion1' => 'edit', 'accion2' => 'destroy', 'id' => $nivel->pk_id_nivel))
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>nivel
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
@endsection