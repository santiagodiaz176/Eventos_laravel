@extends('layouts.app')

@section('title', 'Dreams - Servicios')

@section('styles')
<style>
    .ie-panel {
        display: none;
        background: #212121;
        padding: 10px 0;
        box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);
        clear: both;
        text-align:center;
        position: relative;
        z-index: 1;
    }
    html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {
        display: block;
    }
</style>
@endsection

@section('content')

<div class="ie-panel">
    <a href="http://windows.microsoft.com/en-US/internet-explorer/">
        <img src="{{ asset('images/ie8-panel/warning_bar_0000_us.jpg') }}" height="42" width="820">
    </a>
</div>

<div class="page">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- ENCABEZADO/BANNER --}}
    <section class="breadcrumbs-custom bg-image" 
             style="background-image: url({{ asset('images/1111.jpg') }});">
        <div class="shell">
            <h1 class="breadcrumbs-custom__title">Servicios</h1>
            <ul class="breadcrumbs-custom__path">
                <li><a href="{{ route('user.index') }}">Inicio</a></li>
                <li class="active">Servicios</li>
            </ul>
        </div>
    </section>

    {{-- SECCIÓN PRINCIPAL --}}
    <section class="section section-md bg-white">
        <div class="shell">
            <div class="range range-md-middle">

                <div class="cell-sm-6">
                    <div class="thumb-line">
                        <img src="{{ asset('images/decoracion.jpeg') }}" alt="">
                    </div>
                </div>

                <div class="cell-sm-6">
                    <p class="heading-1">Nuestros servicios</p>
                    <article class="quote-big">
                        <p>En nuestra casa de banquetes ofrecemos todo lo que necesitas
                           para que tu celebración sea un sueño hecho realidad.</p>
                    </article>

                    <div class="divider"></div>

                    <p>Contamos con salones, decoración, banquetes, fotografía y mucho más.</p>

                    <a class="button button-primary-outline button-size-1" href="#">
                        Leer más
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- GALERÍA DE SERVICIOS --}}
    <section class="section section-sm bg-gray-lighter text-center">
        <div class="shell">
            <h1>Ofrecemos:</h1>
            <p>Todo lo necesario para hacer de tu evento el mejor momento.</p>
        </div>

        <div class="owl-carousel-wrap owl-carousel_style-2">
            <div class="owl-carousel owl-carousel-stretch"
                 data-items="1" data-sm-items="2"
                 data-lg-items="3" data-autoplay="true"
                 data-nav="true" data-dots="true">

                {{-- SERVICIO #1 --}}
                <a class="thumb-ruby thumb-mixed_large" href="{{ asset('images/tort.png') }}">
                    <img src="{{ asset('images/tort.png') }}">
                    <div class="thumb-ruby__caption">
                        <p class="heading-3">Banquetes – Alimentación</p>
                        <p>Contamos con repostería propia y cocina profesional.</p>
                    </div>
                </a>

                {{-- SERVICIO #2 --}}
                <a class="thumb-ruby thumb-mixed_large" href="{{ asset('images/fotografos.jpeg') }}">
                    <img src="{{ asset('images/fotografos.jpeg') }}">
                    <div class="thumb-ruby__caption">
                        <p class="heading-3">Fotografía profesional</p>
                        <p>Capturamos tus mejores momentos.</p>
                    </div>
                </a>

                {{-- SERVICIO #3 --}}
                <a class="thumb-ruby thumb-mixed_large" href="{{ asset('images/arreglo2.jpeg') }}">
                    <img src="{{ asset('images/arreglo2.jpeg') }}">
                    <div class="thumb-ruby__caption">
                        <p class="heading-3">Decoración</p>
                        <p>Diseños personalizados para cada evento.</p>
                    </div>
                </a>

                {{-- SERVICIO #4 --}}
                <a class="thumb-ruby thumb-mixed_large" href="{{ asset('images/sonido.jpeg') }}">
                    <img src="{{ asset('images/sonido.jpeg') }}">
                    <div class="thumb-ruby__caption">
                        <p class="heading-3">Sonido & Ambientación</p>
                        <p>Equipos de alta calidad.</p>
                    </div>
                </a>

            </div>
        </div>

    </section>

    {{-- REGISTRO / RESERVA --}}
    <section class="section section-md bg-white">
        <div class="shell">
            <div class="range range-50 range-sm-center range-md-left range-md-middle range-md-reverse">

                <div class="cell-sm-10 cell-md-6">
                    <div class="box-width-4 box-centered">
                        <p class="heading-1">Disfruta con nosotros<br>haz tu reserva.</p>
                        <p>Danos todos los detalles posibles para hacer tu sueño realidad.</p>
                    </div>
                </div>

                <div class="cell-sm-10 cell-md-6">
                    <article class="box-line">
                        <div class="box-line__main">

                            <div class="form-wrap">
                                <label class="form-label">REGÍSTRATE CON NOSOTROS Y HAZ TU RESERVA</label>
                                <br>
                            </div>

                            <div class="form-wrap form-button offset-1">
                                <a href="{{ route('register') }}"
                                   class="button button-block button-primary-outline button-ujarak">
                                   Regístrate
                                </a>
                            </div>

                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    @include('partials.footer')

</div>

@endsection

@section('scripts')
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
@endsection
