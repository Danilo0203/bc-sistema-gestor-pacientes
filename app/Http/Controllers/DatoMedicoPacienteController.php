<?php

namespace App\Http\Controllers;

use App\Models\DatoMedicoPaciente;
use Illuminate\Http\Request;
use App\Http\Resources\DatoMedico\DatoMedicoPacienteResource;
use App\Http\Resources\DatoMedico\DatoMedicoPacienteCollection;
use App\Http\Requests\DatoMedico\StoreDatoMedicoPacienteRequest;
use App\Http\Requests\DatoMedico\UpdateDatoMedicoPacienteRequest;

class DatoMedicoPacienteController extends Controller
{
    // Mostrar todos los datos médicos de un paciente
    public function index()
    {
        try {
            // Obtenemos todos los datos médicos de un paciente
            $datosMedicosPaciente = DatoMedicoPaciente::all();

            // Retornamos la colección de datos médicos de un paciente en formato JSON
            return new DatoMedicoPacienteCollection($datosMedicosPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los datos médicos de un paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo dato médico de un paciente
    public function store(StoreDatoMedicoPacienteRequest $request)
    {
        try {
            // Creamos un nuevo dato médico de un paciente
            return new DatoMedicoPacienteResource(DatoMedicoPaciente::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el dato médico de un paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un dato médico de un paciente específico
    public function show(string $id)
    {
        try {
            // Buscamos un dato médico de un paciente por su ID
            $datoMedicoPaciente = DatoMedicoPaciente::find($id);

            // Si el dato médico de un paciente no existe retornamos un error
            if (!$datoMedicoPaciente) {
                return response()->json([
                    'message' => 'Dato médico de un paciente no encontrado',
                    'error' => 'El dato médico de un paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el dato médico de un paciente en formato JSON
            return new DatoMedicoPacienteResource($datoMedicoPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el dato médico de un paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un dato médico de un paciente
    public function update(UpdateDatoMedicoPacienteRequest $request, string $id)
    {
        try {
            // Buscamos un dato médico de un paciente por su ID
            $datoMedicoPaciente = DatoMedicoPaciente::find($id);

            // Si el dato médico de un paciente no existe retornamos un error
            if (!$datoMedicoPaciente) {
                return response()->json([
                    'message' => 'Dato médico de un paciente no encontrado',
                    'error' => 'El dato médico de un paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el dato médico de un paciente
            $datoMedicoPaciente->update($request->all());

            // Retornamos el dato médico de un paciente en formato JSON
            return new DatoMedicoPacienteResource($datoMedicoPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el dato médico de un paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un dato médico de un paciente
    public function destroy(string $id)
    {
        try {
            // Buscamos un dato médico de un paciente por su ID
            $datoMedicoPaciente = DatoMedicoPaciente::find($id);

            // Si el dato médico de un paciente no existe retornamos un error
            if (!$datoMedicoPaciente) {
                return response()->json([
                    'message' => 'Dato médico de un paciente no encontrado',
                    'error' => 'El dato médico de un paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el dato médico de un paciente
            $datoMedicoPaciente->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Dato médico de un paciente eliminado con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el dato médico de un paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
