<?php

namespace App\Http\Controllers;
  
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Http\Resources\Roles\RolesCollection;
use App\Http\Resources\Roles\RolesResource;
use App\Http\Requests\Roles\StoreRolRequest;
use App\Http\Requests\Roles\UpdateRolRequest;

class RolController extends Controller
{
    // Mostrar todos los roles
    public function index()
    {
        try {
            // Obtenemos todos los roles
            $roles = Rol::all()->makeHidden('updated_at');

            // Retornamos la colección de roles en formato JSON
            return new RolesCollection($roles);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los roles',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo rol
    public function store(StoreRolRequest $request)
    {
        try {
            // Creamos un nuevo rol
            return new RolesResource(Rol::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el rol',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un rol específico
    public function show(string $id)
    {
        try {
            // Buscamos un rol por su ID
            $rol = Rol::find($id);

            // Si el rol no existe retornamos un error
            if (!$rol) {
                return response()->json([
                    'message' => 'Rol no encontrado',
                    'error' => 'El rol con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el rol en formato JSON
            return new RolesResource($rol);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el rol',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un rol
    public function update(UpdateRolRequest $request, string $id)
    {
        try {
            // Buscamos un rol por su ID
            $rol = Rol::find($id);

            // Si el rol no existe retornamos un error
            if (!$rol) {
                return response()->json([
                    'message' => 'Rol no encontrado',
                    'error' => 'El rol con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el rol
            $rol->update($request->all());

            // Retornamos el rol actualizado en formato JSON
            return new RolesResource($rol);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el rol',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un rol
    public function destroy(string $id)
    {
        try {
            // Buscamos un rol por su ID
            $rol = Rol::find($id);

            // Si el rol no existe retornamos un error
            if (!$rol) {
                return response()->json([
                    'message' => 'Rol no encontrado',
                    'error' => 'El rol con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el rol
            $rol->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Rol eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el rol',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
