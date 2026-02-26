<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        $nivel  = $request->get('nivel');
        $grado  = $request->get('grado');
        $buscar = $request->get('buscar');

        $query = Alumno::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('dni', 'like', "%$buscar%")
                  ->orWhere('nombres', 'like', "%$buscar%")
                  ->orWhere('apellidos', 'like', "%$buscar%");
            });
        }

        if ($nivel) {
            $query->where('nivel', $nivel);
        }

        if ($grado) {
            $query->where('grado', $grado);
        }

        $alumnos = $query->orderBy('apellidos')->get();

        return view('alumnos.index', compact(
            'alumnos',
            'nivel',
            'grado',
            'buscar'
        ));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni'       => 'required',
            'nombres'   => 'required',
            'apellidos' => 'required',
            'nivel'     => 'required',
            'grado'     => 'required',
            'seccion'   => 'required',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index');
    }

    public function destroy($id)
    {
        Alumno::findOrFail($id)->delete();
        return redirect()->route('alumnos.index');
    }

    // ✅ MÉTODO QUE FALTABA
    public function estadoCuenta($id)
    {
        $alumno = Alumno::with([
            'matriculas.pensiones.pagos'
        ])->findOrFail($id);

        return view('alumnos.estado_cuenta', compact('alumno'));
    }
}
