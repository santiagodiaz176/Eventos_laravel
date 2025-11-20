@extends('layouts.app')

@section('title', 'Dreams - Inicio')

@section('styles')
<style>
    .ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;}
    html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
</style>
@endsection

@section('content')
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="{{ asset('images/ie8-panel/warning_bar_0000_us.jpg') }}" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>

    <div class="page">
      
      <!-- Page header-->
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="5px" data-lg-stick-up-offset="5px" data-md-stick-up="true" data-lg-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand" href="{{ url('/') }}">
                    <div class="brand__name"><img class="brand__logo-dark" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="237" height="35"/><img class="brand__logo-light" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="237" height="35"/>
                      </div><span class="brand__slogan">Amamos lo que hacemos</span></a></div>
                </div>
                <!-- RD Navbar Nav-->
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-element">
                    <ul class="list-icons list-inline-sm">
                      <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="#"><span></span><span></span><span></span><span></span></a></li>
                      <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="#"><span></span><span></span><span></span><span></span></a></li>
                      
                    </ul>
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

      <!-- My Best Photos -->
      <section class="section text-center">
        <!-- Slick Carousel-->
        <div class="slick-wrap">
          <div class="slick-slider slick-style-1" data-arrows="true" data-autoplay="true" data-loop="true" data-dots="true" data-swipe="true" data-xs-swipe="true" data-sm-swipe="false" data-items="1" data-sm-items="3" data-md-items="3" data-lg-items="3" data-center-mode="true" data-lightgallery="group-slick">
            <div class="item">
              <div class="slick-slide-inner">
                <div class="slick-slide-caption"><a class="thumb-ann thumb-mixed_large" href="{{ asset('images/boda.png') }}" data-lightgallery="item"><img class="thumb-ann__image" src="{{ asset('images/boda.png') }}" alt="Escena de boda" width="961" height="664"/>
                    <div class="thumb-ann__caption">
                      <p class="thumb-ann__title heading-3">Dreams</p>
                      <p class="thumb-ann__title heading-2">Tus sueños hechos realidad.</p>
                    </div></a>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="slick-slide-inner">
                <div class="slick-slide-caption"><a class="thumb-ann thumb-mixed_large" href="{{ asset('images/15.png') }}" data-lightgallery="item"><img class="thumb-ann__image" src="{{ asset('images/15.png') }}" alt="Decoración para eventos" width="961" height="664"/>
                    <div class="thumb-ann__caption">
                      <p class="thumb-ann__title heading-3">Decoración</p>
                      <p class="thumb-ann__text">Ofrecemos como empresa uno de los mejores servicios de medellin.</p>
                    </div></a>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="slick-slide-inner">
                <div class="slick-slide-caption"><a class="thumb-ann thumb-mixed_large" href="{{ asset('images/boda2.png') }}" data-lightgallery="item"><img class="thumb-ann__image" src="{{ asset('images/boda2.png') }}" alt="" width="961" height="664"/>
                    <div class="thumb-ann__caption">
                      <p class="thumb-ann__title heading-3">Sueños</p>
                      <p class="thumb-ann__text">Hazlo realidad y disfruta de la magnifica experiencia que te brindaremos.</p>
                    </div></a>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="slick-slide-inner">
                <div class="slick-slide-caption"><a class="thumb-ann thumb-mixed_large" href="{{ asset('images/15.1.png') }}" data-lightgallery="item"><img class="thumb-ann__image" src="{{ asset('images/15.1.png') }}" alt="" width="961" height="664"/>
                    <div class="thumb-ann__caption">
                      <p class="thumb-ann__title heading-3">Fantasía</p>
                      <p class="thumb-ann__text">Con nosotros viviras la experiencia que tanto deseaste.</p>
                    </div></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- About Me-->
      <section class="section section-md bg-white">
        <div class="shell">
          <div class="range range-50 range-sm-center range-md-left range-md-middle range-md-reverse">
            <div class="cell-sm-6 wow fadeInRightSmall">
              <div class="thumb-line">
                <video controls src="{{ asset('images/Dreams_2.mp4') }}" width="551" height="430">
                  <track kind="captions" src="{{ asset('videos/captions.vtt') }}" srclang="es" label="Español">
                  Tu navegador no soporta el elemento de video.
                </video>
              </div>
            </div>
            <div class="cell-sm-6">
              <div class="box-width-3">
                <p class="heading-1 wow fadeInLeftSmall">Acerca de nosotros</p>
                <article class="quote-big wow fadeInLeftSmall" data-wow-delay=".1s">
                  <p class="q">La mejor empresa de Medellín y su área metropolitana en organización de reuniones y eventos sociales.</p>
                </article>
                <div class="divider wow fadeInLeftSmall" data-wow-delay=".2s"></div>
                <p class="wow fadeInLeftSmall" data-wow-delay=".3s">...</p><a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall" href="{{ route('about') }}" data-wow-delay=".4s">Leer más</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Awards-->



      <!-- mini galeria   -->
      <section class="section section-md bg-white text-center">
        <div class="shell-fluid">
          <p class="heading-1">Galería</p>
          <div class="isotope thumb-ruby-wrap wow fadeIn" data-isotope-layout="masonry" data-isotope-group="gallery" data-lightgallery="group">
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md" href="{{ asset('images/sa.png') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/sa.png') }}" alt="Salón de eventos" width="440" height="327"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">Salones</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-3 thumb-mixed_md" href="{{ asset('images/parj.png') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/parj.png') }}" alt="" width="444" height="683"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">Boda</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md" href="{{ asset('images/xv.png') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/xv.png') }}" alt="" width="440" height="327"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">XV</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-3 thumb-mixed_md" href="{{ asset('images/par.png') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/par.png') }}" alt="" width="444" height="683"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">Boda</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md" href="{{ asset('images/cum.png') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/cum.png') }}" alt="" width="440" height="327"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">Cumpleaños</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item"><a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md" href="{{ asset('images/comunion.jpg') }}" data-lightgallery="item"><img class="thumb-ruby__image" src="{{ asset('images/comunion.jpg') }}" alt="" width="440" height="327"/>
                        <div class="thumb-ruby__caption">
                          <p class="thumb-ruby__title heading-3">Comuniones</p>
                          <p class="thumb-ruby__text">If you are looking for high quality wedding photography, I will be glad to help you.</p>
                        </div></a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- REGISTRO DE USURIOS-->
      <section class="section section-md bg-white">
        <div class="shell">
          <div class="range range-50 range-sm-center range-md-left range-md-reverse range-md-middle">
            <div class="cell-sm-10 cell-md-6 wow fadeInRight">
              <div class="box-width-4 box-centered">
                <p class="heading-1">Disfruta con nosotros, <br> reserva.</p>
                <p>Danos todos los detalles posible para hacer tu sueño realidad.</p>
              </div>
            </div>
            <div class="cell-sm-10 cell-md-6 wow fadeInLeft">
              <article class="box-line"><span></span><span></span><span></span><span></span>
                <div class="box-line__main">
                  <!-- RD Mailform-->
  
                    </div>

                    <div class="form-wrap">
                      <label class="form-label" for="contact-message">REGISTRATE CON NOSOTROS & HAS TU RESERVA</label>
                    <br>
                    </div>
                    <div class="form-wrap form-button offset-1">
                      <a href="{{ route('register') }}" class="button button-block button-primary-outline button-ujarak">Regístrate</a>
                    </div>
                  </form>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>


      <footer class="footer-centered section bg-gray-darker">
        <div class="shell">
          <div class="range range-sm-center">
            <div class="cell-sm-10 cell-md-8 cell-lg-6">
              <!-- Brand--><a class="brand" href="{{ url('/') }}">
                <div class="brand__name">
                    <img src="{{ asset('images/invertido.png') }}" alt="Logo Dreams Footer" width="237" height="35"/>
                </div>
                <span class="brand__slogan">Amamos lo Que Hacemos</span></a>
                    <!-- RD Mailform-->
                    <form class="rd-mailform form_inline" data-form-output="form-output-global" data-form-type="subscribe" method="POST" action="{{ route('newsletter.subscribe') }}">
                      @csrf
                      <div class="form__inner">
                        <div class="form-wrap">
                          <input class="form-input" id="subscribe-form-footer-email" type="email" name="email" required>
                          <label class="form-label" for="subscribe-form-footer-email">Email</label>
                          @error('email')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-button">
                          <button class="button button-link" type="submit">Suscribirse</button>
                        </div>
                      </div>
                    </form>
              <ul class="list-icons list-inline-sm">
                <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="{{ config('social.instagram_url', 'https://www.instagram.com') }}" target="_blank"><span></span><span></span><span></span><span></span></a></li> <br>
                <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="{{ config('social.facebook_url', 'https://www.facebook.com') }}" target="_blank"><span></span><span></span><span></span><span></span></a></li>
              </ul>
              <!-- Rights-->
              <p class="rights"><span>  Dreams   </span><span>&nbsp;&copy;&nbsp; </span><span class="copyright-year"></span>.&nbsp; <br class="veil-xs"><a class="link-underline" href="#">Privacy Policy</a><span> Design&nbsp;by&nbsp;<a href="#">dahiana</a></span></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
