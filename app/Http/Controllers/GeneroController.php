<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use App\Http\Resources\Genero\GeneroResource;
use App\Http\Resources\Genero\GeneroCollection;
use App\Http\Requests\Genero\StoreGeneroRequest;
use App\Http\Requests\Genero\UpdateGeneroRequest;

class GeneroController extends Controller
{
    // Mostrar todos los géneros
    public function index()
    {
        try {
            // Obtenemos todos los géneros
            $generos = Genero::all();

            // Retornamos la colección de géneros en formato JSON
            return new GeneroCollection($generos);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los géneros',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo género
    public function store(StoreGeneroRequest $request)
    {
        try {
            // Creamos un nuevo género
            return new GeneroResource(Genero::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el género',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un género específico
    public function show(string $id)
    {
        try {
            // Buscamos un género por su ID
            $genero = Genero::find($id);

            // Si el género no existe retornamos un error
            if (!$genero) {
                return response()->json([
                    'message' => 'Género no encontrado',
                    'error' => 'El género con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el género en formato JSON
            return new GeneroResource($genero);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el género',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un género
    public function update(UpdateGeneroRequest $request, string $id)
    {
        try {
            // Buscamos un género por su ID
            $genero = Genero::find($id);

            // Si el género no existe retornamos un error
            if (!$genero) {
                return response()->json([
                    'message' => 'Género no encontrado',
                    'error' => 'El género con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el género
            $genero->update($request->all());

            // Retornamos el género actualizado en formato JSON
            return new GeneroResource($genero);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el género',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un género
    public function destroy(string $id)
    {
        try {
            // Buscamos un género por su ID
            $genero = Genero::find($id);

            // Si el género no existe retornamos un error
            if (!$genero) {
                return response()->json([
                    'message' => 'Género no encontrado',
                    'error' => 'El género con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el género
            $genero->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Género eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el género',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
