<?php

namespace App\Http\Controllers;

use App\Models\PrestamosModel;
use App\Models\UsuariosModel;
use App\Models\LibrosModel;
use Illuminate\Http\Request;

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
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,usuarios_id',
            'libros_id' => 'required|exists:libros,libros_id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',
            'estado' => 'required|in:En curso,Devuelto,Atrasado',
        ]);

        PrestamosModel::create($request->all());

        return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado correctamente.');
    }


    public function consult(Request $request)
{
    $prestamo = PrestamosModel::where('prestamos_id', $request->prestamos_id)->first();

    if (!$prestamo) {
        return response()->json(['error' => 'Préstamo no encontrado.']);
    }

    return response()->json([
        'id' => $prestamo->prestamos_id,
        'usuarios_id' => $prestamo->usuarios_id,
        'libros_id' => $prestamo->libros_id,
        'fecha_prestamo' => $prestamo->fecha_prestamo,
        'fecha_devolucion' => $prestamo->fecha_devolucion,
        'estado' => $prestamo->estado,
    ]);
}

    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'usuarios_id' => 'required|exists:usuarios,usuarios_id',
            'libros_id' => 'required|exists:libros,libros_id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',
            'estado' => 'required|in:En curso,Devuelto,Atrasado',
        ]);

        $prestamo = PrestamosModel::findOrFail($id);
        $prestamo->update($validated);

        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado correctamente.');
    }


    public function destroy($prestamos_id)
    {
        $prestamo = PrestamosModel::findOrFail($prestamos_id);
        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado correctamente.');
    }
}