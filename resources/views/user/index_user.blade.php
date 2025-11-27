<!DOCTYPE html>
<html class="wide wow-animation" lang="es">

<head>
    <title>Inicio</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/st.css') }}">

    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            text-align: center;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, .3);
            z-index: 1;
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }
    </style>
</head>

<body>

    {{-- SOLO SI USAS ESTE ELEMENTO --}}
    <div class="ie-panel">
        <img src="{{ asset('images/ie8-panel/warning_bar_0000_us.jpg') }}" height="42" width="820">
    </div>

    {{-- LOADER --}}
    <div id="page-loader">
        <div class="page-loader-body">
            <div class="cssload-spinner">
                @for ($i = 0; $i <= 15; $i++)
                    <div class="cssload-cube cssload-cube{{ $i }}"></div>
                @endfor
            </div>
        </div>
    </div>

    {{-- PAGE --}}
    <div class="page">

        {{-- NAVBAR --}}
        <header class="section page-header">
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar" data-layout="rd-navbar-fixed">
                    <div class="rd-navbar-main-outer">
                        <div class="rd-navbar-main">

                            <div class="rd-navbar-panel">

                                <button class="rd-navbar-toggle"
                                    data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                                    <span></span>
                                </button>

                                {{-- LOGO --}}
                                <div class="rd-navbar-brand">
                                    <a class="brand" href="{{ url('/') }}">
                                        <div class="brand__name">
                                            <img class="brand__logo-dark"
                                                src="{{ asset('images/DDDD.png') }}" width="237">
                                            <img class="brand__logo-light"
                                                src="{{ asset('images/DDDD.png') }}" width="237">
                                        </div>
                                        <span class="brand__slogan">Amamos lo que hacemos</span>
                                    </a>
                                </div>

                            </div>

                            <div class="rd-navbar-nav-wrap">

                                <div class="rd-navbar-element">
                                    <ul class="list-icons list-inline-sm">
                                        <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="#"></a>
                                        </li>
                                        <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="#"></a></li>
                                        <li><a class="icon icon-sm fa icon-style-camera"
                                                href="{{ route('logout') }}">Cerrar sesión</a></li>
                                    </ul>
                                </div>

                                <ul class="rd-navbar-nav">
                                    <li class="active"><a href="{{ route('usuario') }}">Inicio</a></li>
                                    <li><a href="{{ route('usuario.somos') }}">Quienes Somos</a></li>
                                    <li><a href="{{ route('usuario.servicios') }}">Servicios</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>
                </nav>
            </div>
        </header>

        {{-- SLIDER --}}
        <section class="section text-center">
            <div class="slick-wrap">
                <div class="slick-slider slick-style-1"
                    data-arrows="true" data-autoplay="true" data-loop="true"
                    data-dots="true" data-swipe="true" data-items="1" data-sm-items="3"
                    data-md-items="3" data-lg-items="3">

                    @foreach ([
                        ['boda.png', 'Dreams', 'Tus sueños hechos realidad.'],
                        ['15.png', 'Decoración', 'Ofrecemos el mejor servicio de Medellín.'],
                        ['boda2.png', 'Sueños', 'Hazlo realidad con nuestra experiencia.'],
                        ['15.1.png', 'Fantasía', 'Vive la experiencia que buscabas.']
                    ] as $item)
                        <div class="item">
                            <div class="slick-slide-inner">
                                <div class="slick-slide-caption">
                                    <a class="thumb-ann thumb-mixed_large"
                                        href="{{ asset('images/' . $item[0]) }}"
                                        data-lightgallery="item">
                                        <img class="thumb-ann__image"
                                            src="{{ asset('images/' . $item[0]) }}" width="961">

                                        <div class="thumb-ann__caption">
                                            <p class="thumb-ann__title heading-3">{{ $item[1] }}</p>
                                            <p class="thumb-ann__text">{{ $item[2] }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        {{-- ABOUT --}}
        <section class="section section-md bg-white">
            <div class="shell">
                <div class="range range-50 range-sm-center range-md-left range-md-middle">

                    <div class="cell-sm-6">
                        <video controls src="{{ asset('images/Dreams_2.mp4') }}" width="551"></video>
                    </div>

                    <div class="cell-sm-6">
                        <p class="heading-1">Acerca de nosotros</p>
                        <p>La mejor empresa de Medellín en organización de eventos sociales.</p>
                        <a class="button button-primary-outline button-ujarak" href="#">Leer más</a>
                    </div>

                </div>
            </div>
        </section>

        {{-- GALERÍA --}}
        <section class="section section-md bg-white text-center">
            <div class="shell-fluid">
                <p class="heading-1">Galería</p>

                <div class="row">

                    @foreach ([
                        ['sa.png', 'Salones'],
                        ['parj.png', 'Boda'],
                        ['xv.png', 'XV'],
                        ['par.png', 'Boda'],
                        ['cum.png', 'Cumpleaños'],
                        ['comunion.jpg', 'Comuniones']
                    ] as $g)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 isotope-item">
                            <a class="thumb-ruby" href="{{ asset('images/' . $g[0]) }}"
                                data-lightgallery="item">
                                <img class="thumb-ruby__image"
                                    src="{{ asset('images/' . $g[0]) }}" width="440">

                                <div class="thumb-ruby__caption">
                                    <p class="thumb-ruby__title heading-3">{{ $g[1] }}</p>
                                    <p class="thumb-ruby__text">Fotografía profesional disponible.</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        {{-- FORMULARIO RESERVA --}}
        <section class="section section-md bg-white">
            <div class="shell">
                <div class="range range-50 range-sm-center range-md-left">

                    <div class="cell-sm-6">
                        <p class="heading-1">Disfruta con nosotros, reserva.</p>
                        <p>Danos tus datos para hacer tu sueño realidad.</p>
                    </div>

                    <div class="cell-sm-6">

                        <form method="POST" action="{{ route('reserva.store') }}">
                            @csrf

                            <div class="form-wrap">
                                <input class="form-input" type="text" name="nombre" required>
                                <label class="form-label">Nombre completo</label>
                            </div>

                            <div class="form-wrap">
                                <input class="form-input" type="text" name="celular" required>
                                <label class="form-label">Celular</label>
                            </div>

                            <div class="form-wrap">
                                <input class="form-input" type="email" name="correo" required>
                                <label class="form-label">Correo electrónico</label>
                            </div>

                            <div class="form-wrap">
                                <input class="form-input" type="date" name="fecha" required>
                                <label class="form-label">Fecha del evento</label>
                            </div>

                            <div class="form-wrap">
                                <select class="form-input" name="tipo_evento">
                                    <option value="boda">Boda</option>
                                    <option value="XV">XV</option>
                                    <option value="primera comunion">Primera comunión</option>
                                    <option value="cumpleaños">Cumpleaños</option>
                                    <option value="empresariales">Empresarial</option>
                                </select>
                                <label class="form-label">Tipo de evento</label>
                            </div>

                            <div class="form-wrap form-button">
                                <button class="button button-primary-outline">Agendar cita</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="footer-centered section bg-gray-darker">
            <div class="shell">
                <a class="brand">
                    <img src="{{ asset('images/invertido.png') }}" width="237">
                </a>

                <ul class="list-icons list-inline-sm">
                    <li><a class="icon fa fa-instagram" href="#"></a></li>
                    <li><a class="icon fa fa-facebook" href="#"></a></li>
                </ul>

                <p class="rights">
                    Dreams © <span class="copyright-year"></span>.
                </p>
            </div>
        </footer>

    </div>

    {{-- JS --}}
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>

