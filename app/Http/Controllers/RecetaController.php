<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Http\Resources\Receta\RecetaResource;
use App\Http\Resources\Receta\RecetaCollection;
use App\Http\Requests\Receta\UpdateRecetaRequest;
use App\Http\Requests\Receta\StoreRecetaRequest;

class RecetaController extends Controller
{
    // Mostrar todas las recetas
    public function index()
    {
        try {
            // Obtenemos todas las recetas
            $recetas = Receta::all();

            // Retornamos la colección de recetas en formato JSON
            return new RecetaCollection($recetas);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las recetas',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear una nueva receta
    public function store(StoreRecetaRequest $request)
    {
        try {
            // Creamos una nueva receta
            return new RecetaResource(Receta::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la receta',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar una receta específica
    public function show(string $id)
    {
        try {
            // Buscamos una receta por su ID
            $receta = Receta::find($id);

            // Si la receta no existe retornamos un error
            if (!$receta) {
                return response()->json([
                    'message' => 'Receta no encontrada',
                    'error' => 'La receta con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos la receta en formato JSON
            return new RecetaResource($receta);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la receta',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar una receta
    public function update(UpdateRecetaRequest $request, string $id)
    {
        try {
            // Buscamos una receta por su ID
            $receta = Receta::find($id);

            // Si la receta no existe retornamos un error
            if (!$receta) {
                return response()->json([
                    'message' => 'Receta no encontrada',
                    'error' => 'La receta con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos la receta
            $receta->update($request->all());

            // Retornamos la receta en formato JSON
            return new RecetaResource($receta);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la receta',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar una receta
    public function destroy(string $id)
    {
        try {
            // Buscamos una receta por su ID
            $receta = Receta::find($id);

            // Si la receta no existe retornamos un error
            if (!$receta) {
                return response()->json([
                    'message' => 'Receta no encontrada',
                    'error' => 'La receta con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos la receta
            $receta->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Receta eliminada con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la receta',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
