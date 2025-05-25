<?php

namespace App\Http\Controllers;

use App\Models\LibrosModel;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $libros = LibrosModel::all();
        return view('libro.index', compact('libros'));
    }
    public function destroy($libros_id)
    {
        $libros = LibrosModel::findOrFail($libros_id);
        $libros->delete();

        return redirect()->route('libro.index')->with('success', 'Libro eliminado correctamente.');
    }


    public function create(Request $request)
    {
       
        if ($request->has('accion') && $request->accion == 'consultar' && $request->has('titulo') && $request->has('autor')) {
            $titulo = $request->input('titulo');
            $autor = $request->input('autor');

            $libros = LibrosModel::where('titulo', $titulo)
                                ->where('autor', $autor)
                                ->first();

            if ($libros) {
                
                return view('libro.create', compact('libros'))
                    ->with('success', '🔍 Libro encontrado.');
            } else {
                return view('libro.create')->with('error', '❌ Libro no encontrado.');
            }
        }

        return view('libro.create');
    }

    public function store(Request $request)
    {
        $accion = $request->input('accion');

        switch ($accion) {
            case 'guardar':
                $validated = $request->validate([
                    'titulo' => 'required|string|max:255',
                    'autor' => 'required|string|max:255',
                    'editorial' => 'required|string|max:255',
                    'anio_publicacion' => 'required|integer',
                    'genero' => 'required|string|max:255',
                    'clasificacion_tematica' => 'nullable|string',
                    'cantidad_disponible' => 'required|integer|min:0',
                    'estado' => 'required|in:Disponible,Prestado,No disponible',
                ]);

                LibrosModel::create($validated);

                return redirect()->route('libro.index')->with('success', '📘 Libro registrado correctamente.');

            case 'modificar':
                $id = $request->input('libros_id');
                $libros = LibrosModel::find($id);

                if (!$libros) {
                    return redirect()->route('libro.index')->with('error', '❌ Libro no encontrado para modificar.');
                }

                $validated = $request->validate([
                    'titulo' => 'required|string|max:255',
                    'autor' => 'required|string|max:255',
                    'editorial' => 'required|string|max:255',
                    'anio_publicacion' => 'required|integer',
                    'genero' => 'required|string|max:255',
                    'clasificacion_tematica' => 'nullable|string',
                    'cantidad_disponible' => 'required|integer|min:0',
                    'estado' => 'required|in:Disponible,Prestado,No disponible',
                ]);

                $libros->update($validated);

                return redirect()->route('libro.index')->with('success', '✏️ Libro modificado correctamente.');

            case 'consultar':
                $libro = LibrosModel::where('titulo', $request->titulo)
            ->where('autor', $request->autor)
            ->first();

            if (!$libro) {
            return redirect()->route('libro.create')->withErrors(['Libro no encontrado']);
        }   

             return view('libro.create', ['libros' => $libro]);
            

            case 'eliminar':
                $libros_id = $request->input('libros_id');
                $libros = LibrosModel::find($libros_id);

                if (!$libros) {
                    return redirect()->route('libro.index')->with('error', '❌ Libro no encontrado para eliminar.');
                }

                $libros->delete();

                return redirect()->route('libro.index')->with('success', '🗑️ Libro eliminado correctamente.');
        }

        return redirect()->route('libro.index')->with('error', '⚠️ Acción no reconocida.');
    }
}