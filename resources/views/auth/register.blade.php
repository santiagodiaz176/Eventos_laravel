@extends('layouts.app')

@section('title', 'Registro')


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
                <form id="registroForm" class="login100-form validate-form"
                method="POST" action="{{ route('register.store') }}" novalidate>
                    @csrf

                    <span class="login100-form-title p-b-49">
                        Registro
                    </span>

                <table width="100%">
    <tr>
        <td>
            <div class="wrap-input100 m-b-23">
                <span class="label-input100">Nombre</span>
                <input class="input100" type="text" id="nombre" name="nombre"
                       placeholder="Ingrese su nombre" value="{{ old('nombre') }}">
                <span class="focus-input100" data-symbol="&#xf206;"></span>

                {{-- Error de JS --}}
                <div class="error" id="errorNombre"></div>

                {{-- Error de Laravel --}}
                @error('nombre')
                    <div class="error" style="color:red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
        </td>

        <td>
            <div class="wrap-input100 m-b-23">
                <span class="label-input100">Apellidos</span>
                <input class="input100" type="text" id="apellidos" name="apellidos"
                    placeholder="Ingrese apellidos" value="{{ old('apellidos') }}">
                <span class="focus-input100" data-symbol="&#xf206;"></span>

                <div class="error" id="errorApellidos"></div>

                @error('apellidos')
                    <div class="error" style="color:red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
        </td>
    </tr>
    
    <tr>
        <td colspan="2">
            <div class="wrap-input100 m-b-23">
                <span class="label-input100">Correo electrónico</span>
                <input class="input100" type="email" id="email" name="email"
                    placeholder="ejemplo@correo.com" value="{{ old('email') }}">
                <span class="focus-input100" data-symbol="&#xf206;"></span>

                <div class="error" id="errorEmail"></div>

                @error('email')
                    <div class="error" style="color:red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="wrap-input100 m-b-23">
                <span class="label-input100">Contraseña</span>
                <input class="input100" type="password" id="password" name="password"
                    placeholder="Introduce tu contraseña">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
                
                {{-- Icono para mostrar/ocultar contraseña --}}
                <i class="fa fa-eye-slash password-toggle-icon" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>

                <div class="error" id="errorPassword"></div>

                @error('password')
                    <div class="error" style="color:red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
        </td>

        <td>
            <div class="wrap-input100 m-b-23">
                <span class="label-input100">Confirmar contraseña</span>
                <input class="input100" type="password" id="password_confirmation" 
                       name="password_confirmation" placeholder="Confirma tu contraseña">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
                
                {{-- Icono para mostrar/ocultar confirmación de contraseña --}}
                <i class="fa fa-eye-slash password-toggle-icon" id="togglePasswordConfirmation" onclick="togglePasswordVisibility('password_confirmation', 'togglePasswordConfirmation')"></i>

                <div class="error" id="errorConfirmacion"></div>

                @error('password_confirmation')
                    <div class="error" style="color:red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
        </td>
    </tr>
</table>


                <div class="container-login100-form-btn p-t-20">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Registrarme
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-30">
                    <span class="txt1 p-b-10">
                        ¿Ya tienes cuenta?
                    </span>

                    <a href="{{ route('login') }}" class="txt2">
                        Iniciar sesión
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
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    {{-- VALIDACIÓN REGISTRO --}}
    <script src="{{ asset('js/validacionRegistro.js') }}"></script>
@endsection