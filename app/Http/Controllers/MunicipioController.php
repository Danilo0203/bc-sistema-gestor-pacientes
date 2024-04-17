<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Resources\Direccion\MunicipioResource;
use App\Http\Resources\Direccion\MunicipioCollection;
use App\Http\Requests\Direccion\StoreMunicipioRequest;
use App\Http\Requests\Direccion\UpdateMunicipioRequest;

class MunicipioController extends Controller
{
    // Mostrar todos los municipios
    public function index()
    {
        try {
            // Obtenemos todos los municipios
            $municipios = Municipio::paginate(20);

            // Retornamos la colección de municipios en formato JSON
            return new MunicipioCollection($municipios);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los municipios',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo municipio
    public function store(StoreMunicipioRequest $request)
    {
        try {
            // Creamos un nuevo municipio
            return new MunicipioResource(Municipio::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el municipio',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un municipio específico
    public function show(string $id)
    {
        try {
            // Buscamos un municipio por su ID
            $municipio = Municipio::find($id);

            // Si el municipio no existe retornamos un error
            if (!$municipio) {
                return response()->json([
                    'message' => 'Municipio no encontrado',
                    'error' => 'El municipio con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el municipio en formato JSON
            return new MunicipioResource($municipio);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el municipio',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
    
    // Actualizar un municipio
    public function update(UpdateMunicipioRequest $request, string $id)
    {
        try {
            // Buscamos un municipio por su ID
            $municipio = Municipio::find($id);

            // Si el municipio no existe retornamos un error
            if (!$municipio) {
                return response()->json([
                    'message' => 'Municipio no encontrado',
                    'error' => 'El municipio con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el municipio
            $municipio->update($request->all());

            // Retornamos el municipio actualizado en formato JSON
            return new MunicipioResource($municipio);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el municipio',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un municipio
    public function destroy(string $id)
    {
        try {
            // Buscamos un municipio por su ID
            $municipio = Municipio::find($id);

            // Si el municipio no existe retornamos un error
            if (!$municipio) {
                return response()->json([
                    'message' => 'Municipio no encontrado',
                    'error' => 'El municipio con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el municipio
            $municipio->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Municipio eliminado',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el municipio',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
