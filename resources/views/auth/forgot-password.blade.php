@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

{{-- ESTILOS --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts1/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts1/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/main.css') }}">
@endsection

{{-- CONTENIDO --}}
@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image:url('{{ asset('images1/01.jpg') }}');">

        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                @csrf

                <span class="login100-form-title p-b-49">
                    Recuperar Contraseña
                </span>

                <div class="txt1 text-center p-b-20">
                    <p>Ingresa tu correo electrónico y te enviaremos un código para restablecer tu contraseña.</p>
                </div>

                {{-- Mensaje de éxito --}}
                @if (session('status'))
                    <div class="alert alert-success m-b-20" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="alert alert-danger m-b-20" role="alert">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <div class="wrap-input100 validate-input m-b-23" data-validate="Correo requerido">
                    <span class="label-input100">Correo Electrónico</span>
                    <input class="input100" type="email" name="email" id="email" 
                           placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                    <div class="error" id="errorEmail"></div>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Enviar Código
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-50">
                    <a href="{{ route('login') }}" class="txt2">
                        Volver al inicio de sesión
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

{{-- SCRIPTS --}}
@section('scripts')
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
@endsection