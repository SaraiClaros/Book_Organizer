<?php

namespace App\Http\Controllers;

use App\Models\ExistenciasModel;
use App\Models\LibrosModel;
use Illuminate\Http\Request;

class ExistenciasController extends Controller
{
    
    public function index()
    {
        $existencias = ExistenciasModel::with('libro')->get(); 
        return view('existencias.index', compact('existencias'));
    }

    public function create()
    {
        $libros = LibrosModel::all(); 
        return view('existencias.create', compact('libros'));
    }
   
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'libros_id' => 'required|integer',
            'ubicacion_general' => 'required|string',
            'codigo_identificacion' => 'required|string|unique:existencias,codigo_identificacion',
        ]);

       
        ExistenciasModel::create($validated);

       
        return redirect()->route('existencias.index')->with('success', 'Existencia registrada correctamente.');
    }

  
    public function consult(Request $request)
{
    $existencia = ExistenciasModel::where('codigo_identificacion', $request->codigo_identificacion)->first();

    if (!$existencia) {
        return response()->json(['error' => 'Existencia no encontrada']);
    }

    return response()->json([
        'id_existencia' => $existencia->id_existencia,
        'libros_id' => $existencia->libros_id,
        'ubicacion_general' => $existencia->ubicacion_general,
    ]);
}


    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'libros_id' => 'required|integer',
            'ubicacion_general' => 'required|string',
            'codigo_identificacion' => 'required|string',
        ]);

        $existencia = ExistenciasModel::findOrFail($id);
        $existencia->update($validated);

        return redirect()->route('existencias.index')->with('success', 'Existencia actualizada correctamente.');
    }

   
    public function destroy($id_existencia)
    {
        $existencia = ExistenciasModel::findOrFail($id_existencia);
        $existencia->delete();

        return redirect()->route('existencias.index')->with('success', 'Existencia eliminada correctamente.');
    }
}