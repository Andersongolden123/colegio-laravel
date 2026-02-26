@extends('layout')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Registrar Pago</h2>

    <div class="card">
        <div class="card-body">

            <p><strong>Alumno:</strong>
                {{ $pension->matricula->alumno->nombres }}
                {{ $pension->matricula->alumno->apellidos }}
            </p>

            <p><strong>Mes:</strong> {{ $pension->mes }}</p>
            <p><strong>Monto a pagar:</strong> S/ {{ number_format($pension->monto, 2) }}</p>

            <form method="POST" action="/pagos/guardar">
                @csrf

                <input type="hidden" name="pension_id" value="{{ $pension->id }}">

                <div class="mb-3">
                    <label class="form-label">Monto Pagado</label>
                    <input type="number" step="0.01"
                           name="monto_pagado"
                           class="form-control"
                           value="{{ $pension->monto }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Método de Pago</label>
                    <select name="metodo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Yape">Yape</option>
                        <option value="Plin">Plin</option>
                        <option value="Transferencia">Transferencia</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar Pago
                </button>

                <a href="/pagos" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>

        </div>
    </div>

</div>
@endsection
