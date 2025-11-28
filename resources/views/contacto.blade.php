@extends('layouts.app')

@section('title', 'Contáctanos')

@section('content')

@include('partials.navbar')

<section class="breadcrumbs-custom bg-image" style="background-image: url({{ asset('images/1111.jpg') }});">
    <div class="shell">
        <h1 class="breadcrumbs-custom__title">Contáctanos</h1>
        <ul class="breadcrumbs-custom__path">
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li class="active">Contáctanos</li>
        </ul>
    </div>
</section>

<!-- Get in Touch -->
<section class="section section-md bg-white text-center">
    <div class="shell">
        <div class="range range-md-center">
            <div class="cell-md-11 cell-lg-10">
                <h2 class="text-bold">Ponte en Contacto</h2>
                <p><span class="box-width-2">Estamos Disponibles</span></p>
                <div class="layout-columns">
                    <div class="layout-columns__main">
                        <div class="layout-columns__main-inner">

                            <!-- Formulario de registro/reserva -->
                            <form class="rd-mailform" method="POST" action="{{ route('contact.submit') }}">
                                @csrf
                                <div class="cell-sm-10 cell-md-6 wow fadeInLeft">
                                    <article class="box-line">
                                        <div class="box-line__main">
                                            <p>Regístrate con nosotros, así podrás agendar una cita y podremos cumplir tu sueño.</p>
                                        </div>

                                        <div class="form-wrap">
                                            <label class="form-label">REGÍSTRATE CON NOSOTROS & HAZ TU RESERVA</label>
                                            <div class="box-width-4 box-centered">
                                                <p>Danos todos los detalles posibles para hacer tu sueño realidad.</p>
                                            </div>
                                        </div>

                                        <div class="form-wrap form-button offset-1">
                                            <a href="{{ url('login') }}" class="button button-block button-primary-outline button-ujarak">Regístrate</a>
                                        </div>
                                    </article>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="layout-columns__aside">
                        <div class="layout-columns__aside-item">
                            <p class="heading-5">Socials</p>
                            <div class="divider-modern"></div>
                            <ul class="list-inline-xs">
                                <li><a class="icon icon-md icon-gray-7 fa fa-facebook" href="#"></a></li>
                                <li><a class="icon icon-md icon-gray-7 fa fa-twitter" href="#"></a></li>
                                <li><a class="icon icon-md icon-gray-7 fa fa-google" href="#"></a></li>
                                <li><a class="icon icon-md icon-gray-7 fa fa-youtube" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="layout-columns__aside-item">
                            <p class="heading-5">Teléfono / Correo</p>
                            <div class="divider-modern"></div>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit__left"><span class="icon icon-md icon-primary material-icons-local_phone"></span></div>
                                <div class="unit__body"><a href="tel:3136743492">3136743492</a> <br>INFO@DREAMSBANQUETES.COM</div>
                            </div>
                        </div>
                        <div class="layout-columns__aside-item">
                            <p class="heading-5">Medellín</p>
                            <div class="divider-modern"></div>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit__left"><span class="icon icon-md icon-primary material-icons-location_on"></span></div>
                                <div class="unit__body"><a href="#">Carrera 90 #####</a></div>
                            </div>
                        </div>
                        <div class="layout-columns__aside-item">
                            <p class="heading-5">Horarios disponibles</p>
                            <div class="divider-modern"></div>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit__left"><span class="icon icon-md icon-primary mdi mdi-clock"></span></div>
                                <div class="unit__body"><span></span>7:00 a.m - 7:00 p.m</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Mapa -->
<div id="map" style="height: 500px; width: 100%;"></div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  // Crear el mapa
  var map = L.map('map').setView([6.219627, -75.612793], 17);

  // Cargar mapa de OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
  }).addTo(map);

  // ----------------------------
  // ICONO PERSONALIZADO
  // ----------------------------
var customIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/512/2776/2776067.png",
    iconSize: [40, 40],
    iconAnchor: [20, 40],
    popupAnchor: [0, -40]
});


  // Marcador Medellín con icono personalizado
  // Marcador Medellín con icono personalizado
var marker = L.marker([6.219627, -75.612793], { icon: customIcon }).addTo(map);

// Popup con HTML (texto + botón)
marker.bindPopup(`
    <div style="text-align:center;">
        <h2 style="
            font-family: 'Great Vibes';">Dream</h2>
        <button 
            onclick="window.location.href='{{ url('/register') }}'" 
            style="
            font-family: 'Josefin Sans', Helvetica, Arial, sans-serif;
                padding:8px 12px;
                background:#3465e7;
                color:white;
                border:none;
                border-radius:6px;
                cursor:pointer;
                margin-top:5px;
            ">
            Registrate
        </button>
    </div>
`).openPopup();

</script>


@include('partials.footer')

@endsection
