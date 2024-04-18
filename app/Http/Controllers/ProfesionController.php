<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;
use App\Http\Resources\Profesion\ProfesionResource;
use App\Http\Resources\Profesion\ProfesionCollection;
use App\Http\Requests\Profesion\StoreProfesionRequest;
use App\Http\Requests\Profesion\UpdateProfesionRequest;

class ProfesionController extends Controller
{
    // Mostrar todas las profesiones
    public function index()
    {
        try {
            // Obtenemos todas las profesiones
            $profesiones = Profesion::paginate(20);

            // Retornamos la colección de profesiones en formato JSON
            return new ProfesionCollection($profesiones);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las profesiones',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear una nueva profesión
    public function store(StoreProfesionRequest $request)
    {
        try {
            // Creamos una nueva profesión
            return new ProfesionResource(Profesion::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la profesión',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar una profesión específica
    public function show(string $id)
    {
        try {
            // Buscamos una profesión por su ID
            $profesion = Profesion::find($id);

            // Si la profesión no existe retornamos un error
            if (!$profesion) {
                return response()->json([
                    'message' => 'Profesión no encontrada',
                    'error' => 'La profesión con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos la profesión en formato JSON
            return new ProfesionResource($profesion);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la profesión',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar una profesión
    public function update(UpdateProfesionRequest $request, string $id)
    {
        try {
            // Buscamos una profesión por su ID
            $profesion = Profesion::find($id);

            // Si la profesión no existe retornamos un error
            if (!$profesion) {
                return response()->json([
                    'message' => 'Profesión no encontrada',
                    'error' => 'La profesión con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos la profesión
            $profesion->update($request->all());

            // Retornamos la profesión actualizada en formato JSON
            return new ProfesionResource($profesion);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la profesión',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar una profesión
    public function destroy(string $id)
    {
        try {
            // Buscamos una profesión por su ID
            $profesion = Profesion::find($id);

            // Si la profesión no existe retornamos un error
            if (!$profesion) {
                return response()->json([
                    'message' => 'Profesión no encontrada',
                    'error' => 'La profesión con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos la profesión
            $profesion->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Profesión eliminada con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la profesión',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
