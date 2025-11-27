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
        @include('partials.navbar')

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
                        <a href="{{ route('login') }}" class="button button-block button-primary-outline button-ujarak">Regístrate</a>
                      </div>
                    </form>
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
