<?php 
if(empty($ruta)):
	$ruta = $controller;
endif;?>

@if(Auth::user()->hasAccess($controller,$accion1))
    <a href="{{ route('editar-'.$ruta, ['id' => $id]) }}" class="btn btn-info" title="Editar">
        <i class="fa fa-edit"></i>
    </a>
@endif
@if(Auth::user()->hasAccess($controller,$accion2))
    <a title="Borrar" href="{{ route('eliminar-'.$ruta, ['id' => $id]) }}" onclick="return confirm('¿Realmente desea borrar el registro?'); return false;" class="item-borrar btn btn-danger">
        <i class="fa fa-trash"></i>
    </a>
@endif
