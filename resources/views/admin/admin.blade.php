@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')

<div class="barra">
    <div class="brand__name">
        <img class="barra_logo" src="{{ asset('images/DDDD.png') }}" alt="Logo">
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </button>
    </form>
</div>

<h1>Panel de Administración</h1>

{{-- TARJETAS --}}
<div class="stats">
    <div class="card">
        <i class="fas fa-users"></i>
        <h3>{{ $usuariosCount }}</h3>
        <p>Usuarios</p>
    </div>
    <div class="card">
        <i class="fas fa-calendar-check"></i>
        <h3>{{ $citasCount }}</h3>
        <p>Citas</p>
    </div>
    <div class="card">
        <i class="fas fa-envelope-open-text"></i>
        <h3>{{ $suscripcionesCount }}</h3>
        <p>Suscripciones</p>
    </div>
</div>

{{-- TABS --}}
<div class="tabs">
    <div class="tab active" onclick="mostrarTab('usuarios')">Usuarios</div>
    <div class="tab" onclick="mostrarTab('citas')">Citas</div>
    <div class="tab" onclick="mostrarTab('suscripciones')">Suscripciones</div>
</div>

{{-- USUARIOS --}}
<div id="usuarios" class="content active">
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Usuario</th><th>Nombre</th><th>Apellidos</th><th>Perfil</th><th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->nombre }}</td>
                <td>{{ $u->apellidos }}</td>
                <td>{{ $u->perfil }}</td>
                <td>{{ $u->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- CITAS --}}
<div id="citas" class="content">
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Teléfono</th><th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->telefono }}</td>
                <td>{{ $c->fecha_cita }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- SUSCRIPCIONES --}}
<div id="suscripciones" class="content">
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Correo</th><th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suscripciones as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
