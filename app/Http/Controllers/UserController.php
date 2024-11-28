<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $users = User::all();
        return response()->json($users); // O retorna una vista si es necesario
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'celular' => 'nullable|string|max:15',
            'fecha_nacimiento' => 'nullable|date',
            'foto' => 'nullable|string|max:255',
            'rol' => 'nullable|string|in:2,1', // Opciones de rol
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'celular' => $validated['celular'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'foto' => $validated['foto'] ?? null,
            'rol' => $validated['rol'] ?? null, // Opciones de rol
        ]);

        return response()->json($user, 201);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8',
            'celular' => 'nullable|string|max:15',
            'fecha_nacimiento' => 'nullable|date',
            'foto' => 'nullable|string|max:255',
            'rol' => 'nullable|string|in:2,1',
        ]);

        $user->update(array_filter($validated));
        return response()->json($user);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }

    public function updatePhoto(Request $request, $id)
    {
        // Buscar al usuario por su ID
        $user = User::find($id);
        
        if (!$user) {
            // Si no se encuentra el usuario, devolver un error 404
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        // Validación de la solicitud
        $validated = $request->validate([
            
            'foto' => 'nullable|file|image|max:10240',  // Acepta solo imágenes y máximo de 10MB
        ]);
    
        // Si se ha enviado una nueva foto, procesarla
        if ($request->hasFile('foto')) {
            // Almacenar la foto y obtener el nombre del archivo
            $path = $request->file('foto')->store('photos', 'public');
            
            // Actualizar el campo 'foto' del usuario con la ruta almacenada
            $user->foto = $path;
        }
    
        // Actualizar otros campos si es necesario (puedes añadir más campos al update)
        // $user->update($validated);
        $user->save();
    
        // Devolver el usuario actualizado
        return response()->json($user, 200);
    }
    

    
}
