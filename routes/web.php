<?php

use App\Http\Controllers\TranscripcionController;
use App\Http\Modules\Diagnostico\Controllers\DiagnosticoController;
use App\Http\Modules\HistoriaClinica\Controllers\HistoriaClinicaController;
use App\Http\Modules\Pacientes\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('pacientes')->group(function () {
    Route::get('/', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::post('/store', [PacienteController::class, 'store'])->name('pacientes.store');
});

Route::prefix('historias')->group(function () {
    Route::get('/', [HistoriaClinicaController::class, 'index'])->name('historias.index');
    Route::get('/create', [HistoriaClinicaController::class, 'create'])->name('historias.create');
    Route::post('/store', [HistoriaClinicaController::class, 'store'])->name('historias.store');
});

Route::post('/diagnostico/sugerir', [DiagnosticoController::class, 'sugerir'])
    ->name('diagnostico.sugerir');


// Route::post('/api/transcribir', [TranscripcionController::class, 'transcribir'])->name('api.transcribir');


// Route::get('/show', [PacienteController::class, 'show'])->name('pacientes.show');
// Route::get('/edit', [PacienteController::class, 'edit'])->name('pacientes.edit');
// Route::post('/update', [PacienteController::class, 'update'])->name('pacientes.update');
// Route::post('/delete', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

// Route::get('/show', [HistoriaClinicaController::class, 'show'])->name('historias.show');
// Route::get('/edit', [HistoriaClinicaController::class, 'edit'])->name('historias.edit');
// Route::post('/update', [HistoriaClinicaController::class, 'update'])->name('historias.update');
// Route::post('/delete', [HistoriaClinicaController::class, 'destroy'])->name('historias.destroy');
