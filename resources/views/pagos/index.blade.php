@extends('layout')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Caja - Pensiones Pendientes</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Alumno</th>
                <th>Año</th>
                <th>Mes</th>
                <th>Monto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pensiones as $pension)
                <tr>
                    <td>
                        {{ $pension->matricula->alumno->nombres }}
                        {{ $pension->matricula->alumno->apellidos }}
                    </td>
                    <td>{{ $pension->matricula->anio }}</td>
                    <td>{{ $pension->mes }}</td>
                    <td>S/ {{ number_format($pension->monto, 2) }}</td>
                    <td>
                        <a href="/pagos/registrar/{{ $pension->id }}"
                           class="btn btn-success btn-sm">
                            Registrar Pago
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        No hay pensiones pendientes
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
