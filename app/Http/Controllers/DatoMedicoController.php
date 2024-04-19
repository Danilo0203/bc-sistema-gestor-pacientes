<?php

namespace App\Http\Controllers;

use App\Models\DatoMedico;
use Illuminate\Http\Request;
use App\Http\Resources\DatoMedico\DatoMedicoResource;
use App\Http\Resources\DatoMedico\DatoMedicoCollection;
use App\Http\Requests\DatoMedico\StoreDatoMedicoRequest;
use App\Http\Requests\DatoMedico\UpdateDatoMedicoRequest;

class DatoMedicoController extends Controller
{
    // Mostrar todos los datos médicos
    public function index()
    {
        try {
            // Obtenemos todos los datos médicos
            $datosMedicos = DatoMedico::all();

            // Retornamos la colección de datos médicos en formato JSON
            return new DatoMedicoCollection($datosMedicos);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los datos médicos',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo dato médico
    public function store(StoreDatoMedicoRequest $request)
    {
        try {
            // Creamos un nuevo dato médico
            return new DatoMedicoResource(DatoMedico::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el dato médico',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un dato médico específico
    public function show(string $id)
    {
        try {
            // Buscamos un dato médico por su ID
            $datoMedico = DatoMedico::find($id);

            // Si el dato médico no existe retornamos un error
            if (!$datoMedico) {
                return response()->json([
                    'message' => 'Dato médico no encontrado',
                    'error' => 'El dato médico con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el dato médico en formato JSON
            return new DatoMedicoResource($datoMedico);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el dato médico',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un dato médico
    public function update(UpdateDatoMedicoRequest $request, string $id)
    {
        try {
            // Buscamos un dato médico por su ID
            $datoMedico = DatoMedico::find($id);

            // Si el dato médico no existe retornamos un error
            if (!$datoMedico) {
                return response()->json([
                    'message' => 'Dato médico no encontrado',
                    'error' => 'El dato médico con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el dato médico
            $datoMedico->update($request->all());

            // Retornamos el dato médico actualizado en formato JSON
            return new DatoMedicoResource($datoMedico);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el dato médico',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un dato médico
    public function destroy(string $id)
    {
        try {
            // Buscamos un dato médico por su ID
            $datoMedico = DatoMedico::find($id);

            // Si el dato médico no existe retornamos un error
            if (!$datoMedico) {
                return response()->json([
                    'message' => 'Dato médico no encontrado',
                    'error' => 'El dato médico con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el dato médico
            $datoMedico->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Dato médico eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el dato médico',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
