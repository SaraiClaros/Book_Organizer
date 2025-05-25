<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\DevolucionesController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ExistenciasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PrestamosController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/registros', function () {
    return view('registros');
})->middleware(['auth', 'verified'])->name('registros');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('libro', LibroController::class);
Route::resource('devoluciones', DevolucionesController::class);
Route::resource('genero', GeneroController::class);
Route::resource('historial', HistorialController::class);
Route::resource('existencias', ExistenciasController::class);
Route::resource('usuario', UsuariosController::class);
Route::resource('prestamos', PrestamosController::class);
Route::get('/libro/consultar-ajax', [LibroController::class, 'consultarAjax'])->name('libro.consultarAjax');



require __DIR__.'/auth.php';
