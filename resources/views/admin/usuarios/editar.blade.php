@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<style>
body {
    font-family: Arial, sans-serif;
    background: #d6ecfa;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #4682B4;
}

label {
    display: block;
    margin: 12px 0 5px;
    font-weight: bold;
    color: #555;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background: #4682B4;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #5a9bd6;
}

.volver {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: #4682B4;
    text-decoration: none;
    font-weight: bold;
}

.volver:hover {
    text-decoration: underline;
}
</style>

<div class="container">
    <h2>Editar Usuario</h2>

    <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
    @csrf
    @method('PUT')

    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>

    <label>Apellidos</label>
    <input type="text" name="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required>

    <label>Perfil</label>
    <select name="perfil" required>
        <option value="user" {{ $usuario->perfil === 'user' ? 'selected' : '' }}>Usuario</option>
        <option value="admin" {{ $usuario->perfil === 'admin' ? 'selected' : '' }}>Administrador</option>
    </select>

    <label>Estado</label>
    <select name="estado" required>
        <option value="1" {{ $usuario->estado ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
    </select>

     <button type="submit">Actualizar</button>
    </form>


    <a href="{{ route('admin.index') }}" class="volver">← Volver</a>
</div>
@endsection
