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
        return view('usuario.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8',
            'rol' => 'required|in:admin,lector',
        ]);

        $validated['password'] = bcrypt($validated['password']); // encripta la contraseña

        UsuariosModel::create($validated);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente.');
    }

    public function consult(Request $request)
{
    $usuario = UsuariosModel::where('nombre', $request->nombre)->first();

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado']);
    }

    return response()->json([
        'id' => $usuario->usuarios_id,
        'email' => $usuario->email,
        'rol' => $usuario->rol,
    ]);
}

   
    public function update(Request $request, $usuario_id)
    {
        $usuario = UsuariosModel::find($usuario_id);
        if (!$usuario) {
        return redirect()->back()->withErrors(['error' => 'usuario no encontrado']);
    }
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:80',
            'password' => 'nullable|string|min:8',
            'rol' => 'required|in:admin,lector',
        ]);

        $usuario = UsuariosModel::findOrFail($usuario_id);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($usuarios_id)
    {
        $usuario = UsuariosModel::findOrFail($usuarios_id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}