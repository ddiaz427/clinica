@extends('layout')

@section('content')
    <!-- BEGIN : LOGIN PAGE 5-2 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 login-container bs-reset">
                <img class="login-logo login-6" src="{{ asset('assets/pages/img/login/login-invert.png') }}" />
                <div class="login-content">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button> 
                            Por favor corrige los siguientes errores:<br />
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif
                    <h1>CMS TARIFAS DE LUZ</h1>
                    <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>

					<form class="form-horizontal" role="form" method="POST" action="/password/reset">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Restablecer Contraseña
								</button>
							</div>
						</div>
					</form>
                </div>
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                            <ul class="login-social">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright &copy; Tarifas de Luz 2016</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bs-reset">
                <div class="login-bg"> </div>
            </div>
        </div>
    </div>
    <!-- END : LOGIN PAGE 5-2 -->
@endsection