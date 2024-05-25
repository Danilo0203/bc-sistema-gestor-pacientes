<?php

namespace App\Http\Controllers;

use App\Models\RecetaPaciente;
use Illuminate\Http\Request;
use App\Http\Resources\Receta\RecetaPacienteResource;
use App\Http\Resources\Receta\RecetaPacienteCollection;
use App\Http\Requests\Receta\StoreRecetaPacienteRequest;
use App\Http\Requests\Receta\UpdateRecetaPacienteRequest;

class RecetaPacienteController extends Controller
{
    // Mostrar todas las recetas de un paciente
    public function index()
    {
        try {
            // Obtenemos todas las recetas de un paciente
            $recetasPaciente = RecetaPaciente::all();

            // Retornamos la colección de recetas en formato JSON
            return new RecetaPacienteCollection($recetasPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las recetas del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear una nueva receta para un paciente
    public function store(StoreRecetaPacienteRequest $request)
    {
        try {
            // Creamos una nueva receta para un paciente
            return new RecetaPacienteResource(RecetaPaciente::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la receta del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar una receta específica de un paciente
    public function show(string $id)
    {
        try {
            // Buscamos una receta por su ID
            $recetaPaciente = RecetaPaciente::find($id);

            // Si la receta no existe retornamos un error
            if (!$recetaPaciente) {
                return response()->json([
                    'message' => 'Receta del paciente no encontrada',
                    'error' => 'La receta del paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos la receta del paciente en formato JSON
            return new RecetaPacienteResource($recetaPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la receta del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar una receta específica de un paciente
    public function update(UpdateRecetaPacienteRequest $request, string $id)
    {
        try {
            // Buscamos una receta por su ID
            $recetaPaciente = RecetaPaciente::find($id);

            // Si la receta no existe retornamos un error
            if (!$recetaPaciente) {
                return response()->json([
                    'message' => 'Receta del paciente no encontrada',
                    'error' => 'La receta del paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos la receta del paciente
            $recetaPaciente->update($request->all());

            // Retornamos la receta del paciente en formato JSON
            return new RecetaPacienteResource($recetaPaciente);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la receta del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar una receta específica de un paciente
    public function destroy(string $id)
    {
        try {
            // Buscamos una receta por su ID
            $recetaPaciente = RecetaPaciente::find($id);

            // Si la receta no existe retornamos un error
            if (!$recetaPaciente) {
                return response()->json([
                    'message' => 'Receta del paciente no encontrada',
                    'error' => 'La receta del paciente con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos la receta del paciente
            $recetaPaciente->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Receta del paciente eliminada con éxito',
                'status' => '200'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la receta del paciente',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
