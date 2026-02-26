<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
        }
        .title {
            font-size: 22px;
            margin-top: 10px;
        }
        .box {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>COLEGIO SISTEMA ANDERSON</h2>
    <div class="title">RECIBO DE PAGO</div>
</div>

<div class="box">
    <table>
        <tr>
            <td><strong>Recibo N°:</strong></td>
            <td>{{ $pago->id }}</td>
        </tr>
        <tr>
            <td><strong>Alumno:</strong></td>
            <td>
                {{ $pago->pension->matricula->alumno->nombres }}
                {{ $pago->pension->matricula->alumno->apellidos }}
            </td>
        </tr>
        <tr>
            <td><strong>Mes:</strong></td>
            <td>{{ $pago->pension->mes }}</td>
        </tr>
        <tr>
            <td><strong>Año:</strong></td>
            <td>{{ $pago->pension->anio }}</td>
        </tr>
        <tr>
            <td><strong>Monto Pagado:</strong></td>
            <td>S/ {{ number_format($pago->monto_pagado,2) }}</td>
        </tr>
        <tr>
            <td><strong>Método de Pago:</strong></td>
            <td>{{ $pago->metodo }}</td>
        </tr>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td>{{ $pago->fecha_pago }}</td>
        </tr>
    </table>
</div>

<div class="footer">
    Documento generado automáticamente por el sistema.
</div>

</body>
</html>
