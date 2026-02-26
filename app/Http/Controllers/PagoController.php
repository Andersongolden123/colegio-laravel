<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pension;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    // Listado de pensiones pendientes
    public function index()
    {
        $pensiones = Pension::with('matricula.alumno')
            ->where('estado', 'Pendiente')
            ->orderBy('created_at')
            ->get();

        return view('pagos.index', compact('pensiones'));
    }

    // Formulario registrar pago
    public function create($pension_id)
    {
        $pension = Pension::with('matricula.alumno')->findOrFail($pension_id);
        return view('pagos.create', compact('pension'));
    }

    // Guardar pago
    public function store(Request $request)
    {
        $request->validate([
            'pension_id' => 'required|exists:pensiones,id',
            'monto_pagado' => 'required|numeric|min:0',
            'metodo' => 'required|string',
        ]);

        $pension = Pension::findOrFail($request->pension_id);

        if ($pension->estado === 'Pagado') {
            return redirect('/pagos')
                ->with('error', 'Esta pensión ya fue pagada.');
        }

        $pago = Pago::create([
            'pension_id' => $pension->id,
            'fecha_pago' => now(),
            'monto_pagado' => $request->monto_pagado,
            'metodo' => $request->metodo,
        ]);

        $pension->estado = 'Pagado';
        $pension->save();

        return redirect('/pagos/pdf/'.$pago->id);
    }

    // 🧾 Generar PDF
    public function generarPDF($id)
    {
        $pago = Pago::with('pension.matricula.alumno')
            ->findOrFail($id);

        $pdf = Pdf::loadView('pagos.recibo_pdf', compact('pago'));

        return $pdf->stream('recibo_pago_'.$pago->id.'.pdf');
    }
}
