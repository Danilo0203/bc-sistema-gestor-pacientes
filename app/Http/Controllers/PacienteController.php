<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Resources\Paciente\PacienteResource;
use App\Http\Resources\Paciente\PacienteCollection;
use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;

class PacienteController extends Controller
{
    // Mostrar todos los pacientes
    public function index()
    {
        try {
            // Obtenemos todos los pacientes
            $pacientes = Paciente::paginate(20);

            // Retornamos la colección de pacientes en formato JSON
            return new PacienteCollection($pacientes);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los pacientes',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo paciente
    public function store(StorePacienteRequest $request)
    {
        try {
            // Creamos un nuevo paciente
            return new PacienteResource(Paciente::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un paciente específico
    public function show(string $id)
    {
        try {
            // Buscamos un paciente por su ID
            $paciente = Paciente::find($id);

            // Si el paciente no existe retornamos un error
            if (!$paciente) {
                return response()->json([
                    'message' => 'Paciente no encontrado',
                    'error' => 'El paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el paciente en formato JSON
            return new PacienteResource($paciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un paciente 
    public function update(UpdatePacienteRequest $request, string $id)
    {
        try {
            // Buscamos un paciente por su ID
            $paciente = Paciente::find($id);

            // Si el paciente no existe retornamos un error
            if (!$paciente) {
                return response()->json([
                    'message' => 'Paciente no encontrado',
                    'error' => 'El paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el paciente
            $paciente->update($request->all());

            // Retornamos el paciente en formato JSON
            return new PacienteResource($paciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un paciente
    public function destroy(string $id)
    {
        try {
            // Buscamos un paciente por su ID
            $paciente = Paciente::find($id);

            // Si el paciente no existe retornamos un error
            if (!$paciente) {
                return response()->json([
                    'message' => 'Paciente no encontrado',
                    'error' => 'El paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el paciente
            $paciente->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Paciente eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
