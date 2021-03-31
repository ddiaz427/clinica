@extends('layout')

@section('content')
    <!-- BEGIN : LOGIN PAGE 5-2 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 col-md-offset-3 login-container">
                <div class="col-md-12 text-center">
                    <img class="" style="width: 200px; margin-top: 30px;" src="{{ asset('images/logo.png') }}" />
                </div>
                <div class="login-content">
                    <div class="text-center" style="margin-top: 20px; font-size: 18px; color: #000;">
                        Iniciar Sesión para entrar al sistema Clinico
                    </div>
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success" style="margin-top: 20px;">
                            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-success" style="margin-top: 20px;">
                            <button class="close" data-close="alert"></button> 
                            Por favor corrige los siguientes errores:<br />
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif
                    <h1>&nbsp;</h1>
                    <form class="login-form" role="form" method="POST" action="{{ route('login')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Ingrese el usuario y la contraseña. </span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group"  name="email" type="email" value="{{ old('email') }}" autocomplete="off" placeholder="E-mail" /> </div>
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group"  type="password" autocomplete="off" placeholder="Contraseña" name="password" /> </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="rem-password">
                                    <p>Recordarme
                                        <input type="checkbox" class="rem-checkbox" />
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-8 text-right">
                                <div class="forgot-password">
								<a class="btn btn-link" href="{{ url('/password/email') }}">Olvidó su contraseña?</a>
                                </div>
                                <button class="btn btn-primary"  type="submit">Entrar</button>
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
                                <p>Copyright &copy; Clinical <?php echo date('Y'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END : LOGIN PAGE 5-2 -->
@endsection