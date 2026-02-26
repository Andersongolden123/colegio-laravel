<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pension_id')
                ->constrained('pensiones')
                ->onDelete('cascade');

            $table->decimal('monto_pagado', 8, 2);
            $table->date('fecha_pago');
            $table->string('metodo')->default('Efectivo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
