<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'nivel',
        'grado',
        'seccion',
        'estado',
    ];

    // 🔥 Relación con matrículas
    public function matriculas()
    {
        return $this->hasMany(\App\Models\Matricula::class);
    }
}
