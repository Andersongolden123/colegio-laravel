<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('nivel');     // Primaria / Secundaria
            $table->string('grado');     // 1° - 6°
            $table->string('seccion');   // A, B, C
            $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
