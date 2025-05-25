<?php

namespace App\Http\Controllers;

use App\Models\DevolucionesModel;
use App\Models\PrestamosModel;
use Illuminate\Http\Request;

class DevolucionesController extends Controller
{
    
    public function index()
    {
        $devoluciones = DevolucionesModel::with('prestamos')->get(); 
        return view('devoluciones.index', compact('devoluciones'));
    }

    public function create()
    {
        $prestamos = PrestamosModel::all(); 
        return view('devoluciones.create', compact('prestamos'));
    }

    public function destroy($devoluciones_id)
    {
        $devoluciones = DevolucionesModel::findOrFail($devoluciones_id);
        $devoluciones->delete();

        return redirect()->route('devoluciones.index')->with('success', 'devoluciones eliminada correctamente.');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prestamos_id' => 'required|integer|exists:prestamos,prestamos_id',
            'fecha_devolucion_real' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        DevolucionesModel::create($validated);

        return redirect()->route('devoluciones.index')->with('success', 'Devolución registrada correctamente.');
    }
 
     public function consult(Request $request)
    {
         $devolucion = DevolucionesModel::where('prestamos_id', $request->prestamos_id)
            ->first();

           if (!$devolucion) {
        return response()->json(data: ['error' => 'Devolucion no encontrada']);
    }

    return response()->json([
        'fecha_devolucion_real' => $devolucion->fecha_devolucion_real,
        'observaciones' => $devolucion->observaciones,
    ]);
}
   
    public function update(Request $request, $id)
    {
        $devolucion = DevolucionesModel::find($id);
        $validated = $request->validate([
            'prestamos_id' => 'required|integer|exists:prestamos,prestamos_id',
            'fecha_devolucion_real' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        $devolucion->update($validated);

        return redirect()->route('devoluciones.index')->with('success', 'Devolución actualizada correctamente.');
    }

    
  
}

