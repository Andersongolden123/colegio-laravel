@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Estado de Cuenta</h2>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5>
                {{ $alumno->nombres }} {{ $alumno->apellidos }}
            </h5>
        </div>
    </div>

    @foreach($alumno->matriculas as $matricula)

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Año Escolar: {{ $matricula->anio_escolar }}
            </div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>Mes</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($matricula->pensiones as $pension)
                        <tr>
                            <td>{{ $pension->mes }}</td>
                            <td>S/ {{ number_format($pension->monto,2) }}</td>
                            <td>
                                @if($pension->estado == 'Pagado')
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-danger">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                @if($pension->estado == 'Pendiente')
                                    <a href="/pagos/registrar/{{ $pension->id }}"
                                       class="btn btn-sm btn-primary">
                                       Pagar
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    @endforeach

</div>

@endsection
