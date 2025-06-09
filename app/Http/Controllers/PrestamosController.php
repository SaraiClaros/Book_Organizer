<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamosModel;
use App\Models\UsuariosModel;
use App\Models\LibrosModel;

class PrestamosController extends Controller
{
    public function index()
    {
        $prestamos = PrestamosModel::with(['usuarios', 'libros'])->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $usuarios = UsuariosModel::all();
        $libros = LibrosModel::all();
        return view('prestamos.create', compact('usuarios', 'libros'));
    }

    public function store(Request $request)
    {
        $accion = $request->input('accion');

        if ($accion === 'consultar') {
            return $this->consultar($request);
        } elseif ($accion === 'modificar') {
            return $this->update($request, $request->input('prestamos_id'));
        } elseif ($accion === 'eliminar') {
            return $this->destroy($request->input('prestamos_id'));
        }

        // Validación para guardar
        $request->validate([
            'prestamos_id' => 'required|integer|unique:prestamos,prestamos_id',
            'usuarios_id' => 'required|exists:usuarios,usuarios_id',
            'libros_id' => 'required|exists:libros,libros_id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'estado' => 'required|in:En curso,Devuelto,Atrasado',
        ], [
            'fecha_devolucion.after_or_equal' => 'La fecha de devolución no puede ser anterior a la fecha de préstamo.',
        ]);

        PrestamosModel::create($request->all());

        return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado correctamente.');
    }

    public function consultar(Request $request)
    {
        $prestamo = PrestamosModel::where('prestamos_id', $request->prestamos_id)
            ->where('usuarios_id', $request->usuarios_id)
            ->where('libros_id', $request->libros_id)
            ->first();

        if (!$prestamo) {
            return response()->json(['error' => 'Préstamo no encontrado'], 404);
        }

        return response()->json([
            'fecha_prestamo' => $prestamo->fecha_prestamo->format('Y-m-d'),
            'fecha_devolucion' => $prestamo->fecha_devolucion->format('Y-m-d'),
            'estado' => $prestamo->estado,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,usuarios_id',
            'libros_id' => 'required|exists:libros,libros_id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'estado' => 'required|in:En curso,Devuelto,Atrasado',
        ], [
            'fecha_devolucion.after_or_equal' => 'La fecha de devolución no puede ser anterior a la fecha de préstamo.',
        ]);

        $prestamo = PrestamosModel::findOrFail($id);
        $prestamo->update($request->all());

        return redirect()->route('prestamos.index')->with('success', 'Préstamo modificado correctamente.');
    }

    public function destroy($id)
    {
        $prestamo = PrestamosModel::findOrFail($id);
        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado correctamente.');
    }
}
