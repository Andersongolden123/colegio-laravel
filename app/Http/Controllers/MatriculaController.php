<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumno;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with('alumno')
            ->orderBy('anio_escolar', 'desc')
            ->get();

        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $alumnos = Alumno::where('estado', 'activo')
            ->orderBy('apellidos')
            ->get();

        return view('matriculas.create', compact('alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'anio_escolar' => 'required',
            'grado' => 'required',
            'seccion' => 'required',
            'tipo_alumno' => 'required',
        ]);

        Matricula::create([
            'alumno_id' => $request->alumno_id,
            'anio_escolar' => $request->anio_escolar,
            'grado' => $request->nivel . ' ' . $request->grado,
            'seccion' => strtoupper($request->seccion),
            'tipo_alumno' => $request->tipo_alumno,
            'descuento_hermanos' => $request->has('descuento_hermanos'),
            'descuento_especial' => $request->descuento_especial ?? 0,
        ]);

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula registrada correctamente');
    }
}
