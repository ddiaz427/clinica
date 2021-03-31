@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
					@include('usuarios.partials.sidebar')
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Perfil</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Información personal</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Cambiar Avatar</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Cambiar contraseña</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_4" data-toggle="tab">Datos SMTP</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form action="" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @if(Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif
                                                    @if (isset($errors) && count($errors) > 0)
                                                        <div class="alert alert-danger">
                                                            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo.<br> 
                                                            @foreach (isset($errors) && $errors->all() as $error)
                                                                {{ $error }}<br>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo. 
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="control-label">Nombres</label>
            											<input type="text" name="name" value="{{ old('name', (isset($user->name))?$user->name:'') }}" class="form-control required" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Apellidos</label>
            											<input type="text" name="lastname" value="{{ old('lastname', (isset($user->lastname))?$user->lastname:'') }}" class="form-control required" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">E-mail</label>
                                                        <input type="text" name="email" value="{{ old('email', (isset($user->email))?$user->email:'') }}" class="email form-control required" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Teléfono</label>
                                                        <input type="text" name="phone" value="{{ old('phone', (isset($user->phone))?$user->phone:'') }}" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Móvil</label>
                                                        <input type="text" name="mobile" value="{{ old('mobile', (isset($user->mobile))?$user->mobile:'') }}" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Fax</label>
                                                        <input type="text" name="fax" value="{{ old('fax', (isset($user->fax))?$user->fax:'') }}" class="form-control" /> </div>
                                                    <div class="margiv-top-10">
                                                        <button type="submit" class="btn green"> Guardar </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <p> Sube una imagen para mostrar en tu perfil. </p>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="{{ asset($user->avatar()) }}" class="img-responsive" alt="{{ $user->rol->nombre }}"> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Seleccionar imagen </span>
                                                                    <span class="fileinput-exists"> Cambiar </span>
                                                                    <input type="file" name="avatar"> </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <div class="margiv-top-10">
                                                            <button type="submit" class="btn green"> Guardar </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label class="control-label">Contraseña actual</label>
                                                        <input type="password" id="password_old" name="password_old" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nueva contraseña</label>
                                                        <input type="password" id="password" name="password" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">nueva contraseña</label>
                                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" /> </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green"> Guardar </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- CHANGE SMTP TAB -->
                                            <div class="tab-pane" id="tab_1_4">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label class="control-label">E-mail</label>
                                                        <input type="text" name="email_smtp" value="{{ old('email_smtp', (isset($user->email_smtp))?$user->email_smtp:'') }}" class="email form-control required" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Contraseña</label>
                                                        <input type="password" id="pass_smtp" name="pass_smtp" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Repetir contraseña</label>
                                                        <input type="password" id="pass_smtp_confirmation" name="pass_smtp_confirmation" class="form-control" /> </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green"> Guardar </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END SMTP TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
@endsection