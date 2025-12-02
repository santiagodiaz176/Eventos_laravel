@extends('layouts.app')

@section('title', 'Iniciar Sesión')

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
    
    <style>
        .password-toggle-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #999;
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .password-toggle-icon:hover {
            color: #333;
        }
        
        .wrap-input100 {
            position: relative;
        }
    </style>
@endsection

{{-- CONTENIDO --}}
@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image:url('{{ asset('images1/01.jpg') }}');">

        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" 
             action="{{ route('login.store') }}" id="loginForm">
                @csrf

                <span class="login100-form-title p-b-49">
                    Iniciar Sesión
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Correo requerido">
                    <span class="label-input100">Correo Electrónico</span>
                    <input class="input100" type="email" name="email" id="email" placeholder="correo@ejemplo.com">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                    <div class="error" id="errorEmail"></div>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                    <span class="label-input100">Contraseña</span>
                    <input class="input100" type="password" name="clave" id="password" placeholder="Introduce tu contraseña">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                    
                    {{-- Icono para mostrar/ocultar contraseña --}}
                    <i class="fa fa-eye-slash password-toggle-icon" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>
                    
                    <div class="error" id="errorPassword"></div>
                </div>

                <div class="text-right p-t-8 p-b-31">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Ingresar
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-50">
                    <span class="txt1 p-b-17">
                        ¿No tienes cuenta?
                    </span>

                    <a href="{{ route('register') }}" class="txt2">
                        Crear cuenta
                    </a>

                    <a href="{{ url('/') }}" class="txt2">
                        Volver al inicio
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
    <script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>

    {{-- Script para mostrar/ocultar contraseña --}}
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>

    {{-- VALIDACIÓN LOGIN --}}
    <script src="{{ asset('js/validacionLogin.js') }}"></script>
@endsection