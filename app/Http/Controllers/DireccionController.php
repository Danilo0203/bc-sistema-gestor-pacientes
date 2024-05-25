<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Http\Resources\Direccion\DireccionResource;
use App\Http\Resources\Direccion\DireccionCollection;
use App\Http\Requests\Direccion\StoreDireccionRequest;
use App\Http\Requests\Direccion\UpdateDireccionRequest;

class DireccionController extends Controller
{
    // Mostrar todas las direcciones
    public function index()
    {
        try {
            // Obtenemos todas las direcciones
            $direcciones = Direccion::all();

            // Retornamos la colección de direcciones en formato JSON
            return new DireccionCollection($direcciones);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las direcciones',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear una nueva dirección
    public function store(StoreDireccionRequest $request)
    {
        try {
            // Creamos una nueva dirección
            return new DireccionResource(Direccion::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la dirección',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar una dirección específica
    public function show(string $id)
    {
        try {
            // Buscamos una dirección por su ID
            $direccion = Direccion::find($id);

            // Si la dirección no existe retornamos un error
            if (!$direccion) {
                return response()->json([
                    'message' => 'Dirección no encontrada',
                    'error' => 'La dirección con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos la dirección en formato JSON
            return new DireccionResource($direccion);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la dirección',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar una dirección
    public function update(UpdateDireccionRequest $request, string $id)
    {
        try {
            // Buscamos una dirección por su ID
            $direccion = Direccion::find($id);

            // Si la dirección no existe retornamos un error
            if (!$direccion) {
                return response()->json([
                    'message' => 'Dirección no encontrada',
                    'error' => 'La dirección con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos la dirección
            $direccion->update($request->all());

            // Retornamos la dirección actualizada en formato JSON
            return new DireccionResource($direccion);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la dirección',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar una dirección
    public function destroy(string $id)
    {
        try {
            // Buscamos una dirección por su ID
            $direccion = Direccion::find($id);

            // Si la dirección no existe retornamos un error
            if (!$direccion) {
                return response()->json([
                    'message' => 'Dirección no encontrada',
                    'error' => 'La dirección con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos la dirección
            $direccion->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Dirección eliminada con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la dirección',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
