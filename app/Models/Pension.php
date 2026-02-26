<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;

    // 👇 IMPORTANTE
    protected $table = 'pensiones';

    protected $fillable = [
        'matricula_id',
        'anio',
        'mes',
        'monto',
        'estado'
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
