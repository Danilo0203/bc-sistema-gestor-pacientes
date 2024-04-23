<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        try {
            // Obtenemos todos los usuarios
            $users = User::all();

            // Retornamos la colección de usuarios en formato JSON
            return new UserCollection($users);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los usuarios',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un usuario específico
    public function show(string $id)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($id);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                    'error' => 'El usuario con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el usuario en formato JSON
            return new UserResource($user);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el usuario',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un usuario
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($id);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                    'error' => 'El usuario con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el usuario
            $user->update($request->all());

            // Retornamos el usuario actualizado en formato JSON
            return new UserResource($user);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un usuario
    public function destroy(string $id)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($id);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                    'error' => 'El usuario con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el usuario
            $user->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Usuario eliminado correctamente',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
