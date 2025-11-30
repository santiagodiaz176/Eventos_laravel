@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('styles')
    {{-- Solo iconos, el CSS ya viene del layout --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')

<div class="barra">
    <img class="barra_logo" src="{{ asset('images/DDDD.png') }}" alt="Logo">
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

    <a href="{{ route('usuarios.create') }}" class="btn" style="margin-bottom:10px;">
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
            <th>Acciones</th>
        </tr>
        </thead>

        <tbody>
        @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->id_usuario }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->nombre }} {{ $u->apellidos }}</td>
                <td>{{ $u->perfil }}</td>
                <td>{{ $u->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $u->id_usuario) }}" class="btn">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('usuarios.destroy', $u->id_usuario) }}"
                          method="POST" style="display:inline-block;"
                          onsubmit="return confirm('¿Desea eliminar este usuario?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
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

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
        @forelse($citas as $c)
            @php
                $estadoCita = $c->estado->nombre_estado ?? 'Pendiente';
                $evento = $c->evento ?? null;
            @endphp

            <tr>
                <td>{{ $c->id_cita }}</td>
                <td>{{ $c->usuario->nombre ?? $c->nombre }}</td>
                <td>{{ $c->telefono }}</td>
                <td>{{ $c->fecha_cita }}</td>
                <td>{{ $estadoCita }}</td>

                <td class="acciones">

                    {{-- ✅ PENDIENTE / POSPUESTA --}}
                    @if(in_array($estadoCita, ['Pendiente', 'Pospuesta']))

                        <form action="{{ route('admin.citas.update', $c->id_cita) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="accion" value="aceptar">
                            <button class="btn btn-success btn-sm">Aceptar</button>
                        </form>

                        <form action="{{ route('admin.citas.update', $c->id_cita) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="accion" value="cancelar">
                            <button class="btn btn-danger btn-sm">Cancelar</button>
                        </form>

                        @if($estadoCita === 'Pendiente')
                            <a href="{{ route('admin.citas.edit', $c->id_cita) }}"
                               class="btn btn-warning btn-sm">
                                Posponer
                            </a>
                        @endif

                    {{-- ✅ CITA APROBADA + EVENTO --}}
                    @elseif($estadoCita === 'Aprobada' && $evento)

                        @if($evento->id_estado == 1)
                            <a href="{{ route('admin.eventos.editar', $evento->id_evento) }}"
                               class="btn btn-primary btn-sm">
                                Ver evento
                            </a>

                        @elseif($evento->id_estado == 2)
                            <span class="badge badge-success">
                                Se aceptó el evento
                            </span>

                        @elseif($evento->id_estado == 3)
                            <span class="badge badge-danger">
                                Se canceló el evento
                            </span>
                        @endif

                    {{-- CITA CANCELADA --}}
                    @elseif($estadoCita === 'Cancelada')
                        <span class="badge badge-danger">
                            Se canceló la cita
                        </span>

                    @endif

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6" class="sin-registros">
                    No hay citas registradas
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>


{{-- SUSCRIPCIONES --}}
<div id="suscripciones" class="content">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Correo</th>
            <th>Registro</th>
            <th>Estado</th>
        </tr>
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
    document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

/* ✅ Detecta ?tab=citas en la URL */
const params = new URLSearchParams(window.location.search);
const tab = params.get('tab');

if(tab){
    mostrarTab(tab);

    const tabBtn = document.querySelector(`[onclick="mostrarTab('${tab}')"]`);
    if(tabBtn){
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        tabBtn.classList.add('active');
    }
}
</script>
@endsection
