@extends('layouts.app')

@section('title', 'Servicios')

@section('styles')
    {{-- Si tus css no están incluidos en layouts.app, los añadimos aquí --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <header class="section page-header">
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar"
             data-layout="rd-navbar-fixed"
             data-sm-layout="rd-navbar-fixed"
             data-md-layout="rd-navbar-static"
             data-lg-layout="rd-navbar-static"
             data-md-stick-up="true"
             data-lg-stick-up="true">

          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <div class="rd-navbar-panel">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>

                <div class="rd-navbar-brand">
                  <a class="brand" href="{{ url('/') }}">
                    <div class="brand__name">
                      <img class="brand__logo-dark" src="{{ asset('images/DDDD.png') }}" width="237" height="35" alt="Logo Dreams">
                      <img class="brand__logo-light" src="{{ asset('images/DDDD.png') }}" width="237" height="35" alt="Logo Dreams">
                    </div>
                    <span class="brand__slogan">Amamos lo que hacemos</span>
                  </a>
                </div>
              </div>
              
                <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}">Inicio<span></span><span></span><span></span><span></span></a>
                    </li>
                    <li class="{{ Request::is('quienes-somos') ? 'active' : '' }}">
                        <a href="{{ url('quienes-somos') }}">Quienes Somos<span></span><span></span><span></span><span></span></a>
                    </li>
                    <li class="{{ Request::is('servicios') ? 'active' : '' }}">
                        <a href="{{ url('servicios') }}">Servicios<span></span><span></span><span></span><span></span></a>
                    </li>
                    <li class="{{ Request::is('contacto') ? 'active' : '' }}">
                        <a href="{{ url('contacto') }}">Contáctenos<span></span><span></span><span></span><span></span></a>
                    </li>
                  </ul>
              </div>

            </div>
          </div>
        </nav>
      </div>
    </header>

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
                En nuestra casa de banquetes ofrecemos todo lo que necesitas para hacer de tu celebración un sueño hecho realidad.
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
          <div class="cell-sm-6">
            <div class="box-width-4 box-centered">
              <p class="heading-1">Disfruta con nosotros,<br> reserva.</p>
              <p>Danos todos los detalles posibles para hacer tu sueño realidad.</p>
            </div>
          </div>

          <div class="cell-sm-6">
            <article class="box-line">
              <div class="box-line__main">
                <label class="form-label">REGÍSTRATE CON NOSOTROS & HAZ TU RESERVA</label>
                <div class="form-wrap form-button offset-1">
                  <a href="{{ route('register') }}" class="button button-block button-primary-outline button-ujarak">Regístrate</a>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    {{-- FOOTER --}}
    <footer class="footer-centered section bg-gray-darker">
      <div class="shell text-center">
        <a class="brand" href="{{ url('/') }}">
          <img src="{{ asset('images/invertido.png') }}" width="237" alt="Dreams">
        </a>

        <ul class="list-icons list-inline-sm">
          <li><a class="icon icon-sm fa fa-instagram" href="#"></a></li>
          <li><a class="icon icon-sm fa fa-facebook" href="#"></a></li>
        </ul>

        <p class="rights">Dreams © <span class="copyright-year"></span> — Design by Dahiana.D</p>
      </div>
    </footer>

  </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
