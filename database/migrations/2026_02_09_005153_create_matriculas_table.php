<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('alumno_id')
                ->constrained('alumnos')
                ->onDelete('cascade');

            $table->integer('anio_escolar');
            $table->string('grado');
            $table->string('seccion');
            $table->string('tipo_alumno');
            $table->boolean('descuento_hermanos')->default(false);
            $table->decimal('descuento_especial', 5, 2)->default(0);
            $table->string('estado')->default('Matriculado');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
