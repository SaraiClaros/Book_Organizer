<?php

namespace App\Http\Controllers;

use App\Models\HistorialModel;
use App\Models\UsuariosModel;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
       $historiales = HistorialModel::with('usuarios')->get(); 
        return view('historial.index', compact('historiales'));
    }

    
    public function create()
    {
         $usuarios = UsuariosModel::all();
        return view('historial.create', compact('usuarios'));
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuarios_id' => 'required|integer|exists:usuarios,usuarios_id',
            'accion' => 'required|string|max:255',
            'detalle' => 'nullable|string',
            'fecha' => 'required|date',
        ]);

       
        HistorialModel::create($validated);

        
        return redirect()->route('historial.index')->with('success', 'Historial registrado correctamente.');
    }
    public function consult(Request $request)
{
    $historial = HistorialModel::find($request->historial_id);

    if (!$historial) {
        return response()->json(['error' => 'Historial no encontrado']);
    }

    return response()->json([
        'usuarios_id' => $historial->usuarios_id,
        'accion' => $historial->accion,
        'detalle' => $historial->detalle,
        'fecha' => $historial->fecha,
    ]);
}


    public function update(Request $request, $historial_id)
    {
        $validated = $request->validate([
            'usuarios_id' => 'required|integer|exists:usuarios,usuarios_id',
            'accion' => 'required|string|max:255',
            'detalle' => 'nullable|string',
            'fecha' => 'required|date',
        ]);

       
        $historial = HistorialModel::findOrFail($historial_id);

        
        $historial->update($validated);

       
        return redirect()->route('historial.index')->with('success', 'Historial actualizado correctamente.');
    }

    
    public function destroy($historial_id)
    {
        
        $historial = HistorialModel::findOrFail($historial_id);
        $historial->delete();

        
        return redirect()->route('historial.index')->with('success', 'Historial eliminado correctamente.');
    }
}