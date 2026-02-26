<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PensionController;
use App\Http\Controllers\PagoController;

Route::get('/', function () {
    return view('welcome');
});

/* ===========================
   ALUMNOS
=========================== */
Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos/create', [AlumnoController::class, 'create'])->name('alumnos.create');
Route::post('/alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');
Route::get('/alumnos/{id}/estado-cuenta', [AlumnoController::class, 'estadoCuenta']);

/* ===========================
   MATRÍCULAS
=========================== */
Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
Route::get('/matriculas/create', [MatriculaController::class, 'create'])->name('matriculas.create');
Route::post('/matriculas', [MatriculaController::class, 'store'])->name('matriculas.store');

/* ===========================
   PENSIONES
=========================== */
Route::get('/pensiones', [PensionController::class, 'index']);
Route::get('/pensiones/generar/{matricula}', [PensionController::class, 'generar']);

/* ===========================
   PAGOS
=========================== */
Route::get('/pagos', [PagoController::class, 'index']);
Route::get('/pagos/registrar/{pension}', [PagoController::class, 'create']);
Route::post('/pagos/guardar', [PagoController::class, 'store']);

Route::get('/pagos/pdf/{id}', [PagoController::class, 'generarPDF']);

use Illuminate\Support\Facades\Artisan;

Route::get('/migrate-now', function () {
    Artisan::call('migrate', ['--force' => true]);
    return "Migraciones ejecutadas";
});