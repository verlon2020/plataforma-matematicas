<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfessorController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
require __DIR__.'/auth.php';

// ================================
// RUTAS PROTEGIDAS (AUTH)
// ================================
Route::middleware(['auth'])->group(function () {

    // ================================
    // ADMIN
    // ================================
    Route::get('/admin', function () {
        return view('admin');
    })->middleware('role:Admin')->name('admin.panel');

    // ================================
    // PROFESOR
    // ================================
    Route::get('/profesor', [ProfessorController::class, 'index'])
        ->middleware('role:Profesor')
        ->name('profesor.panel');

    // Guardar / actualizar calificación
    Route::post('/profesor/calificar', [ProfessorController::class, 'grade'])
        ->middleware('role:Profesor')
        ->name('profesor.grade');

    // 🆕 GENERAR PDF DEL RESULTADO
    Route::get('/profesor/pdf/{grade}', [ProfessorController::class, 'generarPdf'])
        ->middleware('role:Profesor')
        ->name('profesor.pdf');

    // ================================
    // ESTUDIANTE
    // ================================
    Route::get('/estudiante', function () {
        return view('estudiante');
    })->middleware('role:Estudiante')->name('estudiante.panel');

    // ================================
    // SIMULACIONES
    // ================================
    Route::get('/geometry/cube', [SimulationController::class, 'cube'])
        ->name('geometry.cube');

    Route::get('/trig/sine', [SimulationController::class, 'sine'])
        ->name('trig.sine');

    Route::get('/ar/box', [SimulationController::class, 'arBox'])
        ->name('ar.box');

    // Guardar intento del estudiante
    Route::post('/attempts', [SimulationController::class, 'storeAttempt'])
        ->name('attempts.store');
});

// ================================
// DASHBOARD (REDIRECCIÓN POR ROL)
// ================================
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role_id == 1) {
        return redirect()->route('admin.panel');
    }

    if ($user->role_id == 2) {
        return redirect()->route('profesor.panel');
    }

    return redirect()->route('estudiante.panel');
})->middleware(['auth', 'verified'])->name('dashboard');

// ================================
// PERFIL
// ================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
