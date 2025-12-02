@extends('layouts.app')

@section('title', 'Quiénes Somos')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

@include('partials.navbar')

<section class="breadcrumbs-custom bg-image"
         style="background-image: url('{{ asset('images/1111.jpg') }}');">
    <div class="shell">
        <h1 class="breadcrumbs-custom__title">Quiénes Somos</h1>
        <ul class="breadcrumbs-custom__path">
            <li><a href="{{ route('inicio') }}">Inicio</a></li>
            <li class="active">Quiénes Somos</li>
        </ul>
    </div>
    
    
</section>

<section class="section section-md bg-white">
    <div class="shell">
        <div class="range range-50 range-sm-center range-md-left">

            <div class="cell-sm-6 cell-md-5">
                <div class="thumb-line">
                    <video controls width="551" height="430">
                        <source src="{{ asset('images/Dreams_2.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="cell-sm-6 cell-md-7">
                <div class="box-width-3 box-centered">
                    <article class="quote-big">
                        <p class="q">Dreams.</p>
                    </article>

                    <div class="divider"></div>

                    <p class="text-spacing-05">
                        Cumpliendo sueños nos ha llevado a ser líderes en el medio.
                        Ofrecemos una amplia gama de servicios para bodas, quinceaños,
                        bautizos, grados, cumpleaños, eventos empresariales y más.
                    </p>

                    <div class="group-3-columns" data-lightgallery="group">

                        <div class="column-item">
                            <a class="thumb-light" href="{{ asset('images/zzz.png') }}" data-lightgallery="item">
                                <img src="{{ asset('images/zzz.png') }}" width="120" height="171">
                                <div class="thumb-light__overlay"></div>
                            </a>
                        </div>

                        <div class="column-item">
                            <a class="thumb-light" href="{{ asset('images/pej.png') }}" data-lightgallery="item">
                                <img src="{{ asset('images/pej.png') }}" width="120" height="171">
                                <div class="thumb-light__overlay"></div>
                            </a>
                        </div>

                        <div class="column-item">
                            <a class="thumb-light" href="{{ asset('images/pendj.png') }}" data-lightgallery="item">
                                <img src="{{ asset('images/pendj.png') }}" width="120" height="171">
                                <div class="thumb-light__overlay"></div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section section-md bg-white text-center">
    <div class="shell">

        <h1>Blog</h1>
        <p><span>IDEAS & ANUNCIOS </span><a href="#">Click aquí!</a></p>

        <div class="range range-50 range-sm-center">

            <div class="cell-sm-9 cell-md-6">
                <article class="quote-boxed">
                    <p class="quote-boxed__title">Las tendencias en bodas</p>
                    <div class="quote-boxed__text">
                        <p>
                            Las bodas son una de las celebraciones más importantes en la vida de una persona, 
                            y la moda juega un papel crucial en la ceremonia y la recepción. Este año, 
                            las tendencias en moda para bodas están enfocadas en la elegancia y la comodidad.
                        </p>
                    </div>

                    <ul class="quote-boxed__meta">
                        <li><img class="quote-boxed__avatar" src="{{ asset('images/tort.png') }}" width="46"></li>
                        <li><time datetime="2023">Abril 20, 2023</time></li>
                    </ul>
                </article>
            </div>

            <div class="cell-sm-9 cell-md-6">
                <article class="quote-boxed">
                    <p class="quote-boxed__title">¿Buscas el vestido perfecto?</p>
                    <div class="quote-boxed__text">
                        <p>
                            Bienvenidos al mundo de la moda y las bodas, donde cada detalle cuenta para hacer de ese día el más especial y 
                            memorable. Si eres la novia y estás buscando el vestido perfecto para tu gran día, 
                            hay algunos consejos que debes tener en cuenta para elegir el mejor.
                        </p>
                    </div>

                    <ul class="quote-boxed__meta">
                        <li><img class="quote-boxed__avatar" src="{{ asset('images/15.1.png') }}" width="46"></li>
                        <li><time datetime="2023">Abril 2, 2023</time></li>
                    </ul>
                </article>
            </div>

        </div>

    </div>
</section>

<section class="section section-md bg-white">
    <div class="shell">
        <div class="range range-50 range-sm-center range-md-left range-md-reverse">

            <div class="cell-sm-10 cell-md-6">
                <div class="box-width-4 box-centered">
                    <p class="heading-1">Disfruta con nosotros,<br> reserva.</p>
                    <p>Danos todos los detalles posibles para hacer tu sueño realidad.</p>
                </div>
            </div>

            <div class="cell-sm-10 cell-md-6">
                <article class="box-line">
                    <div class="box-line__main">
                        <label class="form-label">REGÍSTRATE CON NOSOTROS & HAZ TU RESERVA</label>
                        <div class="form-wrap form-button offset-1">
                            <a href="{{ route('register') }}" class="button button-block button-primary-outline button-ujarak">
                                Regístrate
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
