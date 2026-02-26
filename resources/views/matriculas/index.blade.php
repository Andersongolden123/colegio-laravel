@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Matrículas</h2>

    <a href="{{ route('matriculas.create') }}" class="btn btn-success">
        ➕ Nueva Matrícula
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Alumno</th>
            <th>Año</th>
            <th>Grado</th>
            <th>Tipo</th>
            <th>Descuentos</th>
            <th>Estado</th>
            <th width="200">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($matriculas as $m)
            <tr>
                <td>
                    {{ $m->alumno->nombres }}
                    {{ $m->alumno->apellidos }}
                </td>

                <td>{{ $m->anio_escolar }}</td>

                <td>
                    {{ $m->grado }}
                    {{ $m->seccion }}
                </td>

                <td>{{ $m->tipo_alumno }}</td>

                <td>
                    @if($m->descuento_hermanos)
                        <span class="badge bg-info">Hermanos</span>
                    @endif

                    <span class="badge bg-secondary">
                        {{ $m->descuento_especial }} %
                    </span>
                </td>

                <td>
                    <span class="badge bg-success">
                        {{ $m->estado }}
                    </span>
                </td>

                <td>
                    <a href="{{ url('/pensiones/generar/' . $m->id) }}"
                       class="btn btn-sm btn-primary"
                       onclick="return confirm('¿Generar pensiones para esta matrícula?')">
                        💰 Generar Pensiones
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    No hay matrículas registradas
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
