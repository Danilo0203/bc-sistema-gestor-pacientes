<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        // Crear usuario
        $user = User::create([
            'nombre' => $request->nombre,
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Crear token de acceso
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respuesta JSON
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer' 
        ], 201);
    }

    public function login(LoginRequest $request){
        // Validar credenciales
        $credentials = $request->only('usuario', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        // Obtener usuario
        $user = User::where('usuario', $request->usuario)->firstOrFail();

        // Crear token de acceso
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respuesta JSON
        return response()->json([
            'message' => 'Autenticación exitosa, Bienvenido ' . $user->nombre,
            'usuario' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(){
        // Revocar token de acceso
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}
