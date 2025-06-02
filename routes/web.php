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
use App\Http\Controllers\PdfController;

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
Route::get('/prestamos/consultar-ajax', [PrestamosController::class, 'consult'])->name('prestamos.consultarAjax');


Route::get('/prestamos/create', [PrestamosController::class, 'create'])->name('prestamos.create');
Route::post('/prestamos/store', [PrestamosController::class, 'store'])->name('prestamos.store');
Route::post('/prestamos/consultar', [PrestamosController::class, 'consult'])->name('prestamos.consultar');
Route::post('/prestamos/update/{id}', [PrestamosController::class, 'update'])->name('prestamos.update');
Route::post('/prestamos/delete/{id}', [PrestamosController::class, 'destroy'])->name('prestamos.destroy');


// PDF – Subir, Ver, Descargar y Categorías

Route::get('/categorias', [PdfController::class, 'vistaCategorias'])->name('categorias');
Route::get('/categoria/{id}', [PdfController::class, 'mostrarPorCategoria'])->name('categoria.pdfs');

Route::get('/subir', [PdfController::class, 'subirFormulario'])->name('formulario.pdf');
Route::post('/subir', [PdfController::class, 'subir'])->name('subir.pdf');

Route::get('/ver/{id}', [PdfController::class, 'ver'])->name('ver.pdf');
Route::get('/descargar/{id}', [PdfController::class, 'descargar'])->name('descargar.pdf');


require __DIR__.'/auth.php';
