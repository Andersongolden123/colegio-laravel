@extends('layouts.app')

@section('content')

<h2 class="mb-4">Buscar Pensiones por Alumno</h2>

<form method="GET" action="/pensiones" class="mb-4">
    <select name="alumno" class="form-select w-50 d-inline">
        <option value="">-- Seleccione Alumno --</option>
        @foreach($alumnos as $a)
            <option value="{{ $a->id }}"
                {{ $alumno_id == $a->id ? 'selected' : '' }}>
                {{ $a->apellidos }} {{ $a->nombres }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Buscar</button>
</form>

@if($pensiones && count($pensiones) > 0)

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Mes</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pensiones as $p)
        <tr>
            <td>{{ $p->mes }}</td>
            <td>S/ {{ number_format($p->monto,2) }}</td>
            <td>
                @if($p->estado == 'Pagado')
                    <span class="badge bg-success">Pagado</span>
                @else
                    <span class="badge bg-danger">Pendiente</span>
                @endif
            </td>
            <td>
                @if($p->estado == 'Pendiente')
                    <a href="/pagos/registrar/{{ $p->id }}"
                       class="btn btn-sm btn-primary">
                       Pagar
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection
