<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'anio_escolar',
        'grado',
        'seccion',
        'tipo_alumno',
        'descuento_hermanos',
        'descuento_especial',
        'estado'
    ];

    public function alumno()
    {
        return $this->belongsTo(\App\Models\Alumno::class);
    }

    public function pensiones()
    {
        return $this->hasMany(\App\Models\Pension::class);
    }
}
