<?php 
if(empty($ruta)):
	$ruta = $controller;
endif;?>
@if(Auth::user()->hasAccess($controller,$accion))
    <a href="{{ route('crear-'.$ruta)}}" class="btn btn-default">
        Nuevo
        <i class="fa fa-plus"></i>
    </a>
@endif
