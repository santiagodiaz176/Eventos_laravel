@extends('layouts.app')

@section('title', 'Crear Usuario')

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
.btn-primary {
    background: #3498db;
    color: #fff;
}
.btn-primary:hover { background: #2980b9; }
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
    <h2>Nuevo Usuario</h2>

    <form method="POST" action="{{ route('usuarios.store') }}" onsubmit="return validarClaves()">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" name="apellidos" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="clave" id="clave" required>
        </div>

        <div class="form-group">
            <label>Confirmar contraseña</label>
            <input type="password" name="clave_confirmation" id="clave_confirmation" required>
        </div>

        <div class="form-group">
            <label>Perfil</label>
            <select name="perfil" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <!-- Por defecto el estado será activo al crear -->
        <input type="hidden" name="estado" value="1">

        <button class="btn btn-primary" type="submit">
            Guardar Usuario
        </button>
    </form>

    <a href="{{ route('admin.index') }}" class="btn-back">
        ← Volver al Panel
    </a>
</div>

<script>
function validarClaves() {
    const clave = document.getElementById('clave').value;
    const claveConfirm = document.getElementById('clave_confirmation').value;

    if (clave !== claveConfirm) {
        alert('Las contraseñas no coinciden');
        return false; 
    }

    return true; 
}
</script>
@endsection
