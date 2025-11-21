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
                                            <a href="{{ url('registro') }}" class="button button-block button-primary-outline button-ujarak">Regístrate</a>
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

<!-- Google Maps -->
<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d991.5834721087382!2d-75.61489035201062!3d6.219627206482916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1ses!2sco!4v1731615607164!5m2!1ses!2sco" width="1350" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

@include('partials.footer')

@endsection
