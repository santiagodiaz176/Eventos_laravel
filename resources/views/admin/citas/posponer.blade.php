@extends('layouts.app')

@section('title', 'Posponer Cita')

@section('styles')
<style>
.form-card {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.form-card h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}
.form-card label {
    font-weight: 600;
    margin-top: 10px;
}
.form-card .form-control {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.form-card .button-primary {
    background-color: #007bff;
    border: none;
    padding: 12px 25px;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}
.form-card .button-primary:hover {
    background-color: #0056b3;
}
.btn-back {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #3498db;
}
.btn-back:hover {
    color: #21618c;
    text-decoration: underline;
}
</style>
@endsection

@section('content')

<div class="form-card">
    <h2>Posponer Cita</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="accion" value="posponer">

        <label>Fecha de la Cita</label>
        <input type="date" name="fecha_cita"
               class="form-control"
               value="{{ $cita->fecha_cita }}" required>

        <label>Hora de la Cita</label>
        <input type="time" name="hora_cita"
               class="form-control"
               value="{{ $cita->hora_cita }}" required>

        <div style="text-align:center; margin-top:20px;">
            <button type="submit" class="button-primary">
                Guardar Cambios
            </button>
        </div>
    </form>

    <a href="{{ route('admin.citas.index') }}" class="btn-back">
        ← Volver a Citas
    </a>
</div>

@endsection
