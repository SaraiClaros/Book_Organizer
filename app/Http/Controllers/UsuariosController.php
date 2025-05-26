<?php

namespace App\Http\Controllers;

use App\Models\UsuariosModel;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = UsuariosModel::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create')->with(['usuario' => null]);
    }

    public function store(Request $request)
    {
        $accion = $request->input('accion');

        switch ($accion) {
            case 'guardar':
                $validated = $request->validate([
                    'nombre' => 'required|string|max:255',
                    'email' => 'required|email|unique:usuarios,email',
                    'password' => 'required|string|min:8',
                    'rol' => 'required|in:admin,lector',
                ]);

                $validated['password'] = bcrypt($validated['password']);
                UsuariosModel::create($validated);

                return back()->with('success', '✅ Usuario guardado correctamente.');

            case 'consultar':
                $usuario = UsuariosModel::where('nombre', $request->nombre)->first();
                if (!$usuario) {
                    return back()->with('error', '⚠️ Usuario no encontrado.')->withInput();
                }

                return view('usuario.create')->with([
                    'usuario' => $usuario,
                    'success' => '✅ Usuario encontrado.'
                ]);

            case 'modificar':
                $usuario = UsuariosModel::where('nombre', $request->nombre)->first();
                if (!$usuario) {
                    return back()->with('error', '⚠️ Usuario no encontrado para modificar.')->withInput();
                }

                $validated = $request->validate([
                    'email' => 'required|email|max:80',
                    'password' => 'nullable|string|min:8',
                    'rol' => 'required|in:admin,lector',
                ]);

                if ($request->filled('password')) {
                    $validated['password'] = bcrypt($request->password);
                } else {
                    unset($validated['password']);
                }

                $usuario->update($validated);
                return back()->with('success', '✏️ Usuario modificado correctamente.');

            case 'eliminar':
                $usuario = UsuariosModel::where('nombre', $request->nombre)->first();
                if (!$usuario) {
                    return back()->with('error', '⚠️ Usuario no encontrado para eliminar.')->withInput();
                }

                $usuario->delete();
                return back()->with('success', '🗑️ Usuario eliminado correctamente.');

            default:
                return back()->with('error', '⚠️ Acción no válida.');
        }
    }
}
