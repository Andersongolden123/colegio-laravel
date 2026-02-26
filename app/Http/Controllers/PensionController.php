<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pension;
use App\Models\Matricula;
use App\Models\Alumno;

class PensionController extends Controller
{
    // Mostrar pensiones por alumno
    public function index(Request $request)
    {
        $alumno_id = $request->get('alumno');

        $alumnos = Alumno::orderBy('apellidos')->get();

        $pensiones = [];

        if ($alumno_id) {
            $pensiones = Pension::with('matricula.alumno')
                ->whereHas('matricula', function($q) use ($alumno_id) {
                    $q->where('alumno_id', $alumno_id);
                })
                ->get();
        }

        return view('pensiones.index', compact('pensiones', 'alumnos', 'alumno_id'));
    }

    // Generar pensiones
    public function generar($matricula_id)
    {
        $matricula = Matricula::findOrFail($matricula_id);

        if ($matricula->pensiones()->count() > 0) {
            return redirect('/matriculas')
                ->with('error', 'Esta matrícula ya tiene pensiones generadas');
        }

        $meses = [
            'Marzo','Abril','Mayo','Junio','Julio',
            'Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];

        foreach ($meses as $mes) {
            Pension::create([
                'matricula_id' => $matricula->id,
                'anio' => $matricula->anio_escolar,
                'mes' => $mes,
                'monto' => 350,
                'estado' => 'Pendiente'
            ]);
        }

        return redirect('/matriculas')
            ->with('success', 'Pensiones generadas correctamente');
    }
}
