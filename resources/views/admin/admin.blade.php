@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
    --color-primario: #78b2edff;
    --color-secundario: #004080;
    --color-acento: #004d95ff;
    --fondo: #f4f9ff;
    --texto: #333;
}

body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: var(--fondo);
    color: var(--texto);
}

/* Barra */
.barra {
    background: var(--color-primario);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,.2);
}

.barra_logo { height: 55px; }

.logout-btn {
    background: var(--color-acento);
    border: none;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.logout-btn:hover { background: #c70000; }

h1 {
    text-align: center;
    margin: 25px 0;
    color: var(--color-secundario);
}

/* Cards */
.stats {
    display: flex;
    gap: 20px;
    justify-content: center;
    max-width: 1000px;
    margin: auto;
}

.card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    flex: 1;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
}

.card i { font-size: 30px; color: var(--color-primario); }

/* Tabs */
.tabs {
    display: flex;
    justify-content: center;
    margin: 25px auto 0;
    max-width: 1000px;
    background: #fff;
    border-radius: 10px 10px 0 0;
}

.tab {
    flex: 1;
    padding: 14px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
}

.tab.active {
    border-bottom: 3px solid var(--color-primario);
    color: var(--color-secundario);
}

/* Content */
.content {
    display: none;
    background: white;
    padding: 20px;
    max-width: 1000px;
    margin: auto;
    box-shadow: 0 2px 12px rgba(0,0,0,.1);
}

.content.active { display: block; }

/* Tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

thead {
    background: var(--color-primario);
    color: white;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
</style>
@endsection

@section('content')

<div class="barra">
    <img class="barra_logo" src="{{ asset('images/DDDD.png') }}">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </button>
    </form>
</div>

<h1>Panel de Administración</h1>

<div class="stats">
    <div class="card"><i class="fas fa-users"></i><h3>{{ $usuariosCount }}</h3><p>Usuarios</p></div>
    <div class="card"><i class="fas fa-calendar-check"></i><h3>{{ $citasCount }}</h3><p>Citas</p></div>
    <div class="card"><i class="fas fa-envelope-open-text"></i><h3>{{ $suscripcionesCount }}</h3><p>Suscripciones</p></div>
</div>

<div class="tabs">
    <div class="tab active" onclick="mostrarTab('usuarios')">Usuarios</div>
    <div class="tab" onclick="mostrarTab('citas')">Citas</div>
    <div class="tab" onclick="mostrarTab('suscripciones')">Suscripciones</div>
</div>

{{-- USUARIOS --}}
<div id="usuarios" class="content active">

    <a href="{{ route('usuarios.create') }}" class="btn" style="margin-bottom:10px; display:inline-block;">
        <i class="fas fa-plus"></i> Nuevo Usuario
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Acciones</th> {{-- Nueva columna --}}
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->id_usuario }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->nombre }} {{ $u->apellidos }}</td>
                <td>{{ $u->perfil === 'admin' ? 'admin' : 'user' }}</td>
                <td>{{ $u->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $u->id_usuario) }}" class="btn" style="background:#3498db; color:white; padding:5px 10px; border-radius:5px;">
                        <i class="fas fa-edit"></i> Editar
                    </a>

                    <form action="{{ route('usuarios.destroy', $u->id_usuario) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Desea eliminar este usuario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background:#e74c3c; color:white; padding:5px 10px; border-radius:5px;">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- CITAS --}}
<div id="citas" class="content">
<table>
<thead>
<tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Fecha</th></tr>
</thead>
<tbody>
@foreach($citas as $c)
<tr>
<td>{{ $c->id_cita }}</td>
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
<tr><th>ID</th><th>Correo</th><th>Registro</th><th>Estado</th></tr>
</thead>
<tbody>
@foreach($suscripciones as $s)
<tr>
<td>{{ $s->id_suscripcion }}</td>
<td>{{ $s->correo }}</td>
<td>{{ $s->fecha_registro }}</td>
<td>{{ $s->estado }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

@endsection

@section('scripts')
<script>
function mostrarTab(id){
document.querySelectorAll('.content').forEach(c=>c.classList.remove('active'));
document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
document.getElementById(id).classList.add('active');
event.target.classList.add('active');
}
</script>
@endsection
