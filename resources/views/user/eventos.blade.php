@extends('layouts.app')

@section('title', 'Dreams - Mis Eventos')

@section('styles')
<style>
    .event-card {
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        background: #fff;
    }
</style>
@endsection

@section('content')
<div class="page">

    {{-- NAVBAR --}}
    @include('partials.navbar_user')

    {{-- HEADER --}}
    <section class="section text-center bg-gray-lighter">
        <div class="shell">
            <h2 class="heading-1">Mis Eventos</h2>
            <p>Aquí puedes gestionar tus eventos antes de solicitar una cita.</p>

            <a href="{{ route('eventos.create') }}"
               class="button button-primary button-ujarak">
                Crear nuevo evento
            </a>
        </div>
    </section>

    {{-- LISTA DE EVENTOS --}}
    <section class="section section-md bg-white">
        <div class="shell">

            @if($eventos->isEmpty())
                <div class="text-center">
                    <p>No tienes eventos creados aún.</p>
                </div>
            @else
                <div class="range range-30">

                    @foreach($eventos as $evento)
                        <div class="cell-sm-6 cell-md-4">
                            <div class="event-card">

                                {{-- TIPO DE EVENTO --}}
                                <h4>
                                    {{ $evento->tipoevento->descripcion_tipoevento ?? 'Evento' }}
                                </h4>

                                {{-- FECHA --}}
                                <p>
                                    <strong>Fecha tentativa:</strong><br>
                                    {{ $evento->fecha_evento }}
                                </p>

                                {{-- CANTIDAD DE PERSONAS REAL --}}
                                <p>
                                    <strong>Personas:</strong>
                                    {{ $evento->cantidad_personas }}
                                </p>

                                {{-- ESTADO --}}
                                <p>
                                    <strong>Estado:</strong>
                                    <span class="text-primary">
                                       {{ $evento->estado->nombre_estado ?? 'Pendiente' }}
                                    </span>
                                </p>

                                {{-- BOTÓN SOLICITAR CITA --}}
                                @if (!$evento->cita)
                                    <a href="{{ route('citas.create', ['id_evento' => $evento->id_evento]) }}"
                                      class="button button-sm button-primary-outline button-ujarak">
                                      Solicitar cita
                                    </a>
                                @else
                                    <a href="{{ route('citas.estado', $evento->cita->id_cita) }}"
                                      class="button button-sm button-secondary-outline button-ujarak">
                                      Ver estado de la cita
                                    </a>
                                @endif


                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

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
