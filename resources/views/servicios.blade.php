@extends('layouts.app')

@section('title', 'Servicios')

@section('styles')
    {{-- Si tus css no están incluidos en layouts.app, los añadimos aquí --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
<link rel="icon" href="{{ asset('images/WhatsApp Image 2025-10-21 at 15.54.34 (1).jpeg') }}">
    <style>
      .ie-panel{display:none;background:#212121;padding:10px 0;box-shadow:3px 3px 5px rgba(0,0,0,.3);text-align:center;}
      html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display:block;}
    </style>
@endsection

@section('content')
  <div class="ie-panel">
    <a href="http://windows.microsoft.com/en-US/internet-explorer/">
      <img src="{{ asset('images/ie8-panel/warning_bar_0000_us.jpg') }}" alt="" height="42" width="820">
    </a>
  </div>

  <div id="page-loader">
    <div class="page-loader-body">
      <div class="cssload-spinner">
        @for($i=0;$i<16;$i++)
          <div class="cssload-cube cssload-cube{{ $i }}"></div>
        @endfor
      </div>
    </div>
  </div>

  <div class="page">

    {{-- HEADER --}}
    @include('partials.navbar')

    {{-- BANNER --}}
    <section class="breadcrumbs-custom bg-image" style="background-image: url('{{ asset('images/1111.jpg') }}');">
      <div class="shell">
        <h1 class="breadcrumbs-custom__title">Servicios</h1>
        <ul class="breadcrumbs-custom__path">
          <li><a href="{{ url('/') }}">Inicio</a></li>
          <li class="active">Servicios</li>
        </ul>
      </div>
    </section>

    {{-- INFO PRINCIPAL --}}
    <section class="section section-md bg-white">
      <div class="shell">
        <div class="range range-50 range-sm-center range-md-left">
          <div class="cell-sm-6">
            <div class="thumb-line">
              <img src="{{ asset('images/decoracion.jpeg') }}" alt="Decoración">
            </div>
          </div>

          <div class="cell-sm-6">
            <p class="heading-1">Nuestros servicios.</p>
            <article class="quote-big">
              <p class="q">
                En nuestra casa de banquetes ofrecemos todo lo que necesitas para que tu celebración sea un sueño hecho realidad.
                Ven a conocernos y vivir la experiencia que tanto deseaste.
              </p>
            </article>
            <div class="divider"></div>
          </div>
        </div>
      </div>
    </section>

    {{-- GALERÍA --}}
    <section class="section section-sm bg-gray-lighter text-center">
      <div class="shell">
        <h1>Ofrecemos:</h1>
      </div>

      <div class="owl-carousel-wrap owl-carousel_style-2">
        <div class="owl-carousel"
             data-items="1" data-lg-items="3"
             data-autoplay="true"
             data-center-mode="true"
             data-loop="true">

          @php
            $galeria = [
              ['tort.png', 'Banquetes', 'Contamos con nuestra propia repostería'],
              ['fotografos.jpeg', 'Fotografía', 'Fotógrafos profesionales'],
              ['caroo.jpg', 'Graduaciones', 'Servicio completo de grados'],
              ['boda_c.jpeg', 'Bodas', 'Momentos únicos para parejas'],
              ['Quinces.jpeg', 'Quinces', 'Celebraciones inolvidables'],
              ['ssaalloonn.jpeg', 'Salones', 'Espacios increíbles'],
              ['deecora.jpeg', 'Decoraciones', 'Decoración memorable'],
              ['collage.jpeg', 'Eventos', 'Creatividad sin límites'],
              ['Bus.jpeg', 'Transporte', 'Buses, autos, limosinas']
            ];
          @endphp

          @foreach ($galeria as $item)
            <a class="thumb-ruby thumb-mixed_large" href="{{ asset('images/'.$item[0]) }}" data-lightgallery="item">
              <img class="thumb-ruby__image" src="{{ asset('images/'.$item[0]) }}" alt="{{ $item[1] }}">
              <div class="thumb-ruby__caption">
                <p class="thumb-ruby__title">{{ $item[1] }}</p>
                <p class="thumb-ruby__text">{{ $item[2] }}</p>
              </div>
            </a>
          @endforeach

        </div>
      </div>
    </section>

    {{-- RESERVA --}}
    <section class="section section-md bg-white">
    <div class="shell">
        <div class="range range-50 range-sm-center">
            {{-- Columna Izquierda --}}
            <div class="cell-sm-6 wow fadeInLeft">
                <div class="box-width-4 box-centered">
                    <p class="heading-1">Disfruta con nosotros,<br> reserva.</p>
                    <p style="margin-top: 20px;">Danos todos los detalles posibles para hacer tu sueño realidad.</p>
                </div>
            </div>

            {{-- Columna Derecha: REGISTRO --}}
            <div class="cell-sm-6 wow fadeInRight">
                <article class="box-line" style="padding: 60px 40px; text-align: center; background: #f8f9fa; border-radius: 10px;">
                    <div class="box-line__main">
                        
                        
                        <div class="form-wrap form-button">
                            <a href="{{ route('register') }}" class="button button-block button-primary-outline button-ujarak" style="max-width: 300px; margin: 0 auto; padding: 15px 30px;">
                                REGÍSTRATE
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

    @include('partials.footer')
  @endsection

@section('scripts')
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
