@extends('layouts.app')

@section('content')

<h2 class="mb-3">Alumnos</h2>

<a href="{{ route('alumnos.create') }}" class="btn btn-success mb-3">
    ➕ Registrar Alumno
</a>

<form method="GET" action="{{ route('alumnos.index') }}" class="row mb-4">

    <div class="col-md-3">
        <input type="text"
               name="buscar"
               value="{{ $buscar ?? '' }}"
               class="form-control"
               placeholder="Buscar por DNI, nombre o apellido">
    </div>

    <div class="col-md-3">
        <select name="nivel" class="form-select">
            <option value="">-- Todos los niveles --</option>
            <option value="Primaria" {{ ($nivel ?? '') == 'Primaria' ? 'selected' : '' }}>
                Primaria
            </option>
            <option value="Secundaria" {{ ($nivel ?? '') == 'Secundaria' ? 'selected' : '' }}>
                Secundaria
            </option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="grado" class="form-select">
            <option value="">-- Todos los grados --</option>

            <optgroup label="Primaria">
                @for($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}°" {{ ($grado ?? '') == $i.'°' ? 'selected' : '' }}>
                        {{ $i }}° Primaria
                    </option>
                @endfor
            </optgroup>

            <optgroup label="Secundaria">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}°" {{ ($grado ?? '') == $i.'°' ? 'selected' : '' }}>
                        {{ $i }}° Secundaria
                    </option>
                @endfor
            </optgroup>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary w-100">
            🔍 Buscar
        </button>
    </div>

</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>DNI</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Nivel</th>
            <th>Grado</th>
            <th>Sección</th>
            <th width="180">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($alumnos as $a)
        <tr>
            <td>{{ $a->dni }}</td>
            <td>{{ $a->nombres }}</td>
            <td>{{ $a->apellidos }}</td>
            <td>{{ $a->nivel }}</td>
            <td>{{ $a->grado }}</td>
            <td>{{ $a->seccion }}</td>
            <td>
                <a href="/alumnos/{{ $a->id }}/estado-cuenta"
                   class="btn btn-sm btn-primary mb-1">
                   📄 Estado de Cuenta
                </a>

                <form method="POST"
                      action="{{ route('alumnos.destroy', $a->id) }}"
                      onsubmit="return confirm('¿Eliminar alumno?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        🗑 Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                No hay alumnos registrados
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
