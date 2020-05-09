@extends('layouts.negocios')

@section('content')
    <div class="bg_color_2">
        <div class="container margin_60_35">
            <div id="login-2">
                <h1>Inicia Sesión en RioBooking</h1>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="box_form clearfix">
                        <div class="box_login last">
                            <div class="form-group">
                                <input placeholder="Cédula ó Nombre de Usuario" id="login”" type="login" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                @if ($errors->has('login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input placeholder="Contraseña" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <a href="{{ route('password.request') }}" class="forgot"><small>Olvidaste tu contraseña?</small></a>
                            </div>
                            <div class="form-group">
                                <input class="btn_1" type="submit" value="Iniciar Sesión">
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center link_bright">No tienes cuenta? <a href="{{ route('register') }}"><strong>¡Registrate aquí!</strong></a></p>
            </div>
            <!-- /login -->
        </div>
    </div>
@endsection
