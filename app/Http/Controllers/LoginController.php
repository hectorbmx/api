<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Iniciar sesión
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
    
            return response()->json([
                'message' => 'Login exitoso',
                'token' => $token,
                'user' => $user
            ]);
        }
    
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
    

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout exitoso'
        ]);
    }
}
