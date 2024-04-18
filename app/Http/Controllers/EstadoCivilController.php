<?php

namespace App\Http\Controllers;

use App\Models\EstadoCivil;
use Illuminate\Http\Request;
use App\Http\Resources\EstadoCivil\EstadoCivilResource;
use App\Http\Resources\EstadoCivil\EstadoCivilCollection;
use App\Http\Requests\EstadoCivil\StoreEstadoCivilRequest;
use App\Http\Requests\EstadoCivil\UpdateEstadoCivilRequest;

class EstadoCivilController extends Controller
{
    // Mostrar todos los estados civiles
    public function index()
    {
        try {
            // Obtenemos todos los estados civiles
            $estadosCiviles = EstadoCivil::all();

            // Retornamos la colección de estados civiles en formato JSON
            return new EstadoCivilCollection($estadosCiviles);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los estados civiles',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo estado civil
    public function store(StoreEstadoCivilRequest $request)
    {
        try {
            // Creamos un nuevo estado civil
            return new EstadoCivilResource(EstadoCivil::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el estado civil',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un estado civil específico
    public function show(string $id)
    {
        try {
            // Buscamos un estado civil por su ID
            $estadoCivil = EstadoCivil::find($id);

            // Si el estado civil no existe retornamos un error
            if (!$estadoCivil) {
                return response()->json([
                    'message' => 'Estado civil no encontrado',
                    'error' => 'El estado civil con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el estado civil en formato JSON
            return new EstadoCivilResource($estadoCivil);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el estado civil',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un estado civil
    public function update(UpdateEstadoCivilRequest $request, string $id)
    {
        try {
            // Buscamos un estado civil por su ID
            $estadoCivil = EstadoCivil::find($id);

            // Si el estado civil no existe retornamos un error
            if (!$estadoCivil) {
                return response()->json([
                    'message' => 'Estado civil no encontrado',
                    'error' => 'El estado civil con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el estado civil
            $estadoCivil->update($request->all());

            // Retornamos el estado civil actualizado en formato JSON
            return new EstadoCivilResource($estadoCivil);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el estado civil',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un estado civil
    public function destroy(string $id)
    {
        try {
            // Buscamos un estado civil por su ID
            $estadoCivil = EstadoCivil::find($id);

            // Si el estado civil no existe retornamos un error
            if (!$estadoCivil) {
                return response()->json([
                    'message' => 'Estado civil no encontrado',
                    'error' => 'El estado civil con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el estado civil
            $estadoCivil->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Estado civil eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el estado civil',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
