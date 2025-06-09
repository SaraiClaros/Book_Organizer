<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use App\Models\Categoria;

class PdfController extends Controller
{
    public function subirFormulario()
    {
        $categorias = Categoria::all();
        return view('subir_pdf', compact('categorias'));
    }

    public function subir(Request $request)
    {
        /*$request->validate([
            'archivo' => 'required|mimes:pdf|max:20480',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string|max:255',
        ])*/

     
        $rutaPdf = $request->file('archivo')->store('storage/pdfs','public');
        $rutaPdf = str_replace('public/', '', $rutaPdf);
        

        
        $rutaPortada = null;
        if ($request->hasFile('portada')) {
            $rutaPortada = $request->file('portada')->store('storage/portadas', 'public');
            $rutaPortada = str_replace('public/', '', $rutaPortada);
        }

       
        Pdf::create([
            'nombre' => $request->file('archivo')->getClientOriginalName(),
            'ruta' => $rutaPdf,
            'portada' => $rutaPortada,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
        ]);

        return back()->with('exito', 'PDF subido correctamente.');
    }

    public function vistaCategorias()
    {
        $categorias = Categoria::all();
        return view('categorias', compact('categorias'));
    }

    public function mostrarPorCategoria(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $query = $categoria->pdfs();

        if ($request->has('busqueda')) {
            $query->where('nombre', 'like', '%' . $request->busqueda . '%');
        }

        $libros = $query->get();

        return view('libros_categoria', compact('libros', 'categoria'));
    }

    public function ver($id)
    {
        $pdf = Pdf::findOrFail($id);
        $url = asset('storage/' . $pdf->ruta);
        return view('ver_pdf', compact('url'));
    }

    public function descargar($id)
    {
        $pdf = Pdf::findOrFail($id);
        return response()->download(storage_path('app/public/' . $pdf->ruta), $pdf->nombre);
    }
}
