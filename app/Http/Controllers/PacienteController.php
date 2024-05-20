<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Resources\Paciente\PacienteResource;
use App\Http\Resources\Paciente\PacienteCollection;
use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
use App\Models\Cita;

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
            $paciente = Paciente::create($request->all());

            // Creamos una nueva cita para el paciente
            Cita::create([
                'paciente_id' => $paciente->id,
                'atender' => 0
            ]);

            // Retornamos el paciente en formato JSON
            return new PacienteResource($paciente);
            
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
            
            // Eliminamos la cita del paciente
            $cita = Cita::where('paciente_id', $id)->first();
            $cita->delete();

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

    // Cita de un paciente
    public function citaPaciente(string $id){
        try {
            // Buscamos un paciente por su ID dentro de la tabla de citas
            $citaPaciente = Cita::where('paciente_id', $id)->first();

            // Si la cita del paciente no existe retornamos un error
            if (!$citaPaciente) {
                return response()->json([
                    'message' => 'Cita del paciente no encontrada',
                    'error' => 'El paciente con el ID proporcionado no tiene una cita',
                    'status' => '404'
                ], 404);
            }

            // Cambiamos el estado de la cita del paciente
            $cita = Cita::find($citaPaciente->id);
            if ($cita->atender == 0) {
                $cita->update(['atender' => 1]);
            } else {
                $cita->update(['atender' => 0]);
            }

            // Retornamos la cita del paciente en formato JSON
            return response()->json([
                'message' => 'Cita del paciente',
                'data' => $cita,
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la cita del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
