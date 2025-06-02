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

    public function store(Request $request)
    {
        $accion = $request->input('accion');

        switch ($accion) {
            case 'guardar':
                $request->validate([
                    'prestamos_id' => 'required|integer|exists:prestamos,id',
                    'fecha_devolucion_real' => 'required|date',
                ]);

                DevolucionesModel::create([
                    'prestamos_id' => $request->prestamos_id,
                    'fecha_devolucion_real' => $request->fecha_devolucion_real,
                    'observaciones' => $request->observaciones,
                ]);

                return redirect()->back()->with('success', 'Devolución guardada correctamente');
                break;

            case 'consultar':
                $prestamoId = $request->input('prestamos_id');
                $devolucion = DevolucionesModel::where('prestamos_id', $prestamoId)->first();

                if (!$devolucion) {
                    return redirect()->back()->withErrors('No se encontró la devolución.');
                }

                
                return view('devoluciones.index', ['devoluciones' => collect([$devolucion])]);
                break;

            case 'modificar':
                $request->validate([
                    'prestamos_id' => 'required|integer|exists:prestamos,id',
                    'fecha_devolucion_real' => 'required|date',
                ]);

                $devolucion = DevolucionesModel::where('prestamos_id', $request->prestamos_id)->first();

                if (!$devolucion) {
                    return redirect()->back()->withErrors('No se encontró la devolución para modificar.');
                }

                $devolucion->fecha_devolucion_real = $request->fecha_devolucion_real;
                $devolucion->observaciones = $request->observaciones;
                $devolucion->save();

                return redirect()->back()->with('success', 'Devolución modificada correctamente');
                break;

            case 'eliminar':
                $prestamoId = $request->input('prestamos_id');
                $devolucion = DevolucionesModel::where('prestamos_id', $prestamoId)->first();

                if (!$devolucion) {
                    return redirect()->back()->withErrors('No se encontró la devolución para eliminar.');
                }

                $devolucion->delete();

                return redirect()->back()->with('success', 'Devolución eliminada correctamente');
                break;

            default:
                return redirect()->back()->withErrors('Acción no válida');
                break;
        }
    }

    public function destroy($id)
    {
        $devolucion = DevolucionesModel::findOrFail($id);
        $devolucion->delete();

        return redirect()->route('devoluciones.index')->with('success', 'Devolución eliminada correctamente.');
    }
}
