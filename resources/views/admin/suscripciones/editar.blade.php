@extends('layouts.app')

@section('title', 'Editar Suscripción')

@section('content')
<style>
body {
    font-family: Arial, sans-serif;
    background: #d9ecf5;
}

.container {
    max-width: 480px;
    margin: 50px auto;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

h2 {
    text-align: center;
    color: #2c3e50;
}

.form-group { margin-bottom: 15px; }

label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
}

input, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    background: #f8f9fa;
    border: 1px solid #bbb;
}

.btn {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.btn-success {
    background: #2ecc71;
    color: #fff;
}

.btn-success:hover {
    background: #27ae60;
}

.btn-back {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: #3498db;
    font-weight: bold;
    text-decoration: none;
}
</style>

<div class="container">
    <h2>Editar Suscripción</h2>

    <form action="{{ route('admin.suscripciones.update', $suscripcion->id_suscripcion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Correo</label>
            <input type="email" name="correo" value="{{ old('correo', $suscripcion->correo) }}" required>
            @error('correo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado</label>
            <select name="estado" required>
                <option value="activo" {{ (old('estado', $suscripcion->estado) == 'activo') ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ (old('estado', $suscripcion->estado) == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            Guardar Cambios
        </button>
    </form>

    <a href="{{ route('admin.index', ['tab' => 'suscripciones']) }}" class="btn btn-secondary">
        ← Volver al Panel de Suscripciones
    </a>
</div>
@endsection
