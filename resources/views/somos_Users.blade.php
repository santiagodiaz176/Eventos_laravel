  @extends('layouts.app')

  @section('title', 'Quienes Somos')

  @section('styles')
  <style>
    .ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;}
    html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
  </style>
  @endsection

  @section('content')
      <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="{{ asset('images/ie8-panel/warning_bar_0000_us.jpg') }}" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
      <!-- Page Loader-->
      <div id="page-loader">
        <div class="page-loader-body">
          <div class="cssload-spinner">
            <div class="cssload-cube cssload-cube0"></div>
            <div class="cssload-cube cssload-cube1"></div>
            <div class="cssload-cube cssload-cube2"></div>
            <div class="cssload-cube cssload-cube3"></div>
            <div class="cssload-cube cssload-cube4"></div>
            <div class="cssload-cube cssload-cube5"></div>
            <div class="cssload-cube cssload-cube6"> </div>
            <div class="cssload-cube cssload-cube7"></div>
            <div class="cssload-cube cssload-cube8"></div>
            <div class="cssload-cube cssload-cube9"></div>
            <div class="cssload-cube cssload-cube10"></div>
            <div class="cssload-cube cssload-cube11"></div>
            <div class="cssload-cube cssload-cube12"></div>
            <div class="cssload-cube cssload-cube13"></div>
            <div class="cssload-cube cssload-cube14"></div>
            <div class="cssload-cube cssload-cube15"></div>
          </div>
        </div>
      </div>
      <!-- Page-->
      <div class="page">
        
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
                      <div class="brand__name"><img class="brand__logo-dark" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="237" height="35"/><img class="brand__logo-light" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="37" height="35"/>
                        </div><span class="brand__slogan">Amamos Lo Que Hacemos</span></a></div>
                  </div>
                  <!-- RD Navbar Nav-->
                  <div class="rd-navbar-nav-wrap">
                    <div class="rd-navbar-element">
                      <ul class="list-icons list-inline-sm">
                        <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="#"><span></span><span></span><span></span><span></span></a></li>
                        <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="#"><span></span><span></span><span></span><span></span></a></li>

                        <li><a class="icon icon-sm fa  icon-style-camera" href="../vistas/index.html">Cerrar sesión<span></span><span></span><span></span><span></span></a></li>

        

                        <!--Hasta aqui llega el codigo del boton-->
                      </ul>
                    </div>
                    <!-- RD Navbar Nav-->
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

        <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom bg-image" style="background-image: url({{ asset('images/1111.jpg') }});">
          <div class="shell">
            <h1 class="breadcrumbs-custom__title">Quienes Somos</h1>
            <ul class="breadcrumbs-custom__path">
              <li><a href="index.html">Inicio</a></li>
              <li class="active">Quienes Somos</li>
            </ul>
          </div>
        </section>

        <!-- About Me-->
        <section class="section section-md bg-white">
          <div class="shell">
            <div class="range range-50 range-sm-center range-md-left">
                <div class="cell-sm-6 cell-md-5">
                <div class="thumb-line">
                  <video controls width="551" height="430">
                    <source src="{{ asset('images/Dreams_2.mp4') }}" type="video/mp4">
                    <track kind="captions" src="{{ asset('subtitles/Dreams_2.vtt') }}" srclang="es" label="Español">
                    <track kind="descriptions" src="{{ asset('descriptions/Dreams_2.vtt') }}" srclang="es" label="Descripción">
                    Tu navegador no soporta el elemento de video.
                  </video>
                
                </div>
                  
                </div>
              </div>
              <div class="cell-sm-6 cell-md-7">
                <div class="box-width-3 box-centered">
                  <article class="quote-big">
                    <p class="q">Dreams.</p>
                  </article>
                  <div class="divider"></div>
                  <p class="text-spacing-05">cumpliendo sueños nos ha llevado hacer lo que somos, líder en el medio. Ofrecemos una amplia gama de servicios para bodas, quinceaños, bautizos, grados, cumpleaños, eventos empresariales entre otros, contamos con cuatro salones estrategicamente ubicados en el área metropolitana de Medellin.</p>
                  <div class="group-3-columns" data-lightgallery="group">
            <div class="column-item"><a class="thumb-light" href="{{ asset('images/zzz.png') }}" data-lightgallery="item"><img src="{{ asset('images/zzz.png') }}" alt="Galería 1" width="120" height="171"/>
              <div class="thumb-light__overlay"></div></a></div>
            <div class="column-item"><a class="thumb-light" href="{{ asset('images/pej.png') }}" data-lightgallery="item"><img src="{{ asset('images/pej.png') }}" alt="Galería 2" width="120" height="171"/>
              <div class="thumb-light__overlay"></div></a></div>
            <div class="column-item"><a class="thumb-light" href="{{ asset('images/pendj.png') }}" data-lightgallery="item"><img src="{{ asset('images/pendj.png') }}" alt="Galería 3" width="120" height="171"/>
              <div class="thumb-light__overlay"></div></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- My Best Photos
      What People Say-->
        <section class="section section-md bg-white text-center">
          <div class="shell">
            <h1>Blog</h1>
            <p><span>IDEAS & ANUNCIOS </span><a href="#">Click aqui!</a></p>
            <div class="range range-50 range-sm-center">
              <div class="cell-sm-9 cell-md-6">
                      <!-- Quote boxed-->
                      <article class="quote-boxed"><span></span><span></span><span></span><span></span>
                        <p class="quote-boxed__title">Las tendencias en bodas</p>
                        <div class="quote-boxed__text">
                          <svg class="quote-boxed__shape" version="1.1" x="0px" y="0px" viewbox="0 0 32.2 28" width="32.2" height="28">
                            <path d="M6.2,0C2.8,0,0,2.8,0,6.3s2.8,6.3,6.2,6.3c6.2,0,2.1,12.3-6.2,12.3v3C14.7,27.9,20.4,0,6.2,0L6.2,0z M23.9,0       c-3.4,0-6.2,2.8-6.2,6.3s2.8,6.3,6.2,6.3c6.2,0,2.1,12.3-6.2,12.3v3C32.4,27.9,38.2,0,23.9,0L23.9,0z M23.9,0"></path>
                          </svg>
                          <p>Las bodas son una de las celebraciones más importantes en la vida de una persona, y la moda juega un papel crucial en la ceremonia y la recepción. Este año, las tendencias en moda para bodas están enfocadas en la elegancia y la comodidad.</p>
                        </div>
                        <ul class="quote-boxed__meta">
                          <li>
                            <div class="unit unit-horizontal unit-middle">
                              <div class="unit__left"><img class="quote-boxed__avatar" src="{{ asset('images/tort.png') }}" alt="Torta" width="46" height="46"/>
                              </div>
                            
                            </div>
                          </li>
                          <li>
                            <time class="quote-boxed__time" datetime="2019">Abril 20, 2023
                            </time>
                          </li>
                        </ul>
                      </article>
              </div>
              <div class="cell-sm-9 cell-md-6">
                      <!-- Quote boxed-->
                      <article class="quote-boxed"><span></span><span></span><span></span><span></span>
                        <p class="quote-boxed__title">¿estas buscando el vestido perfecto para tu gran dia?</p>
                        <div class="quote-boxed__text">
                          <svg class="quote-boxed__shape" version="1.1" x="0px" y="0px" viewbox="0 0 32.2 28" width="32.2" height="28">
                            <path d="M6.2,0C2.8,0,0,2.8,0,6.3s2.8,6.3,6.2,6.3c6.2,0,2.1,12.3-6.2,12.3v3C14.7,27.9,20.4,0,6.2,0L6.2,0z M23.9,0       c-3.4,0-6.2,2.8-6.2,6.3s2.8,6.3,6.2,6.3c6.2,0,2.1,12.3-6.2,12.3v3C32.4,27.9,38.2,0,23.9,0L23.9,0z M23.9,0"></path>
                          </svg>
                          <p>Bienvenidos al mundo de la moda y las bodas, donde cada detalle cuenta para hacer de ese día el más especial y memorable. Si eres la novia y estás buscando el vestido perfecto para tu gran día, hay algunos consejos que debes tener en cuenta para elegir el mejor.</p>
                        </div>
                        <ul class="quote-boxed__meta">
                          <li>
                            <div class="unit unit-horizontal unit-middle">
                              <div class="unit__left"><img class="quote-boxed__avatar" src="{{ asset('images/15.1.png') }}" alt="Icono" width="46" height="46"/>
                              </div>
                            
                            </div>
                          </li>
                          <li>
                            <time class="quote-boxed__time" datetime="2019">Abril 2, 2023</time>
                          </li>
                        </ul>
                      </article>
              </div>
            </div>
          </div>
        </section>





        
              <section class="section parallax-container bg-image-dark" data-parallax-img="{{ asset('images/boda1.jpg') }}">
                <div class="parallax-content">
                  <section class="section-lg text-center">
                    <div class="shell">
                      <div class="range range-50 range-sm-center range-md-reverse range-md-middle">
                        <div class="cell-md-6 cell-lg-5">
                          <div class="box-width-4 box-centered">
                            <p class="heading-1">Disfruta Con Nosotros, <br> Recerva </p>
                            <div class="divider-small"></div>
                            <p>Danos todos los detalles posible para hacer tu sueño realidad.</p>
                          </div>
                        </div>
                        <div class="cell-sm-10 cell-md-6 cell-lg-7">
                          <article class="box-bordered">
                            <div class="box-bordered__main">
                              <!-- RD Mailform-->
                              <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="#">
                                @csrf
                                <div class="form-wrap">
                                  <input class="form-input" id="contact-date" type="text" data-time-picker="date" name="date" data-constraints="@@Required">
                                  <label class="form-label" for="contact-date">Fecha del evento</label>
                                </div>
                                <div class="form-wrap">
                                  <input class="form-input" id="contact-name" type="text" name="name" data-constraints="@@Required">
                                  <label class="form-label" for="contact-name">Tu Nombre</label>
                                </div>
                                <div class="form-wrap">
                                  <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@@Email @@Required">
                                  <label class="form-label" for="contact-email">Gmail.com</label>
                                </div>
                                <div class="form-wrap">
                                  <label class="form-label" for="contact-message">Cuenta nos, ¿que tienes en mente para cumplir tus sueños?</label>
                                  <textarea class="form-input" id="contact-message" name="message" data-constraints="@@Required"></textarea>
                                </div>
                                <div class="form-wrap form-button offset-1">
                                  <button class="button button-block button-primary-outline button-ujarak" type="submit">Agende una cita</button>
                                </div>
                              </form>
                            </div>
                          </article>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </section>


        
        <footer class="footer-centered section bg-gray-darker">
          <div class="shell">
            <div class="range range-sm-center">
              <div class="cell-sm-10 cell-md-8 cell-lg-6">
                <!-- Brand--><a class="brand" href="index.html">
                  <div class="brand__name"><img class="brand__logo-dark" src="{{ asset('images/invertido.png') }}" alt="Logo Dreams Footer" width="237" height="35"/><img class="brand__logo-light" src="{{ asset('images/invertido.png') }}" alt="Logo Dreams Footer" width="237" height="35"/>
                  </div><span class="brand__slogan">Amamos lo que Hacemos</span></a>
                      <!-- RD Mailform-->
                      <form class="rd-mailform form_inline" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="#">
                        @csrf
                        <div class="form__inner">
                          <div class="form-wrap">
                            <input class="form-input" id="subscribe-form-footer-email" type="email" name="email" data-constraints="@@Email @@Required">
                            <label class="form-label" for="subscribe-form-footer-email">Your E-mail...</label>
                          </div>
                          <div class="form-button">
                            <button class="button button-link" type="submit">Subscribe</button>
                          </div>
                        </div>
                      </form>
                <ul class="list-icons list-inline-sm">
                  <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="https://www.instagram.com"><span></span><span></span><span></span><span></span></a></li>
                  <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="https://www.facebook.com"><span></span><span></span><span></span><span></span></a></li>
                </ul>
                <!-- Rights-->
                <p class="rights"><span>Dreams</span><span>&nbsp;&copy;&nbsp; </span><span class="copyright-year"></span>.&nbsp; <br class="veil-xs"><a class="link-underline" href="#">Privacy Policy</a><span> Design&nbsp;by&nbsp;<a href="#">Dahiana.D</a></span></p>
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