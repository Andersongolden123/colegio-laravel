@extends('layouts.app')

@section('content')

<h2 class="mb-4">Registrar Alumno</h2>

<form method="POST" action="{{ route('alumnos.store') }}" class="card p-4 shadow">
@csrf

<div class="mb-3">
    <label class="form-label">DNI</label>
    <input type="text" name="dni" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Nombres</label>
    <input type="text" name="nombres" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Apellidos</label>
    <input type="text" name="apellidos" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Nivel</label>
    <select name="nivel" id="nivel" class="form-select" required>
        <option value="">-- Seleccione nivel --</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Grado</label>
    <select name="grado" id="grado" class="form-select" required>
        <option value="">-- Seleccione grado --</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Sección</label>
    <select name="seccion" class="form-select" required>
        <option>A</option>
        <option>B</option>
        <option>C</option>
    </select>
</div>

<button class="btn btn-primary">Guardar Alumno</button>
<a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>

</form>

<script>
document.getElementById('nivel').addEventListener('change', function () {
    let grado = document.getElementById('grado');
    grado.innerHTML = '<option value="">-- Seleccione grado --</option>';

    if (this.value === 'Primaria') {
        for (let i = 1; i <= 6; i++) {
            grado.innerHTML += `<option value="${i}°">${i}°</option>`;
        }
    }

    if (this.value === 'Secundaria') {
        for (let i = 1; i <= 5; i++) {
            grado.innerHTML += `<option value="${i}°">${i}°</option>`;
        }
    }
});
</script>

@endsection
