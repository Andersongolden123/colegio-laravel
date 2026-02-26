@extends('layouts.app')

@section('content')

<h2 class="mb-4">Registrar Matrícula</h2>

<form method="POST" action="{{ route('matriculas.store') }}" class="card p-4 shadow">
@csrf

{{-- ALUMNO --}}
<div class="mb-3">
    <label class="form-label">Alumno</label>
    <select name="alumno_id" class="form-select" required>
        <option value="">-- Seleccione alumno --</option>
        @foreach($alumnos as $a)
            <option value="{{ $a->id }}">
                {{ $a->apellidos }}, {{ $a->nombres }} ({{ $a->dni }})
            </option>
        @endforeach
    </select>
</div>

{{-- AÑO --}}
<div class="mb-3">
    <label class="form-label">Año Escolar</label>
    <input type="text" name="anio_escolar" class="form-control" value="2026" required>
</div>

{{-- NIVEL --}}
<div class="mb-3">
    <label class="form-label">Nivel</label>
    <select name="nivel" id="nivel" class="form-select" required>
        <option value="">-- Seleccione nivel --</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
    </select>
</div>

{{-- GRADO --}}
<div class="mb-3">
    <label class="form-label">Grado</label>
    <select name="grado" id="grado" class="form-select" required>
        <option value="">-- Seleccione grado --</option>
    </select>
</div>

{{-- SECCIÓN --}}
<div class="mb-3">
    <label class="form-label">Sección</label>
    <select name="seccion" class="form-select" required>
        <option>A</option>
        <option>B</option>
        <option>C</option>
    </select>
</div>

{{-- TIPO --}}
<div class="mb-3">
    <label class="form-label">Tipo de Alumno</label>
    <select name="tipo_alumno" class="form-select">
        <option>Nuevo</option>
        <option>Antiguo</option>
        <option>Traslado</option>
    </select>
</div>

{{-- DESCUENTOS --}}
<div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="descuento_hermanos" value="1">
    <label class="form-check-label">Descuento por hermanos</label>
</div>

<div class="mb-3">
    <label class="form-label">Descuento especial (%)</label>
    <input type="number" name="descuento_especial" class="form-control" value="0" min="0" max="100">
</div>

<button class="btn btn-primary">Guardar Matrícula</button>
<a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>

</form>

{{-- SCRIPT PARA GRADOS --}}
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
