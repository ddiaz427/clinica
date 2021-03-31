<?php 
if(empty($ruta)):
	$ruta = $controller;
endif;?>
@if(Auth::user()->hasAccess($controller,$accion))
    <a href="{{ route('ver-'.$ruta, ['id' => $id])}}" class="btn blue" title="Ver">
        <i class="fa fa-search"></i>
    </a>
@endif
