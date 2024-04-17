<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Resources\Direccion\DepartamentoResource;
use App\Http\Resources\Direccion\DepartamentoCollection;
use App\Http\Requests\Direccion\StoreDepartamentoRequest;
use App\Http\Requests\Direccion\UpdateDepartamentoRequest;

class DepartamentoController extends Controller
{
    // Mostrar todos los departamentos
    public function index()
    {
        try {
            // Obtenemos todos los departamentos
            $departamentos = Departamento::all();

            // Retornamos la colección de departamentos en formato JSON
            return new DepartamentoCollection($departamentos);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los departamentos',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Crear un nuevo departamento
    public function store(StoreDepartamentoRequest $request)
    {
        try {
            // Creamos un nuevo departamento
            return new DepartamentoResource(Departamento::create($request->all()));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el departamento',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Mostrar un departamento específico
    public function show(string $id)
    {
        try {
            // Buscamos un departamento por su ID
            $departamento = Departamento::find($id);

            // Si el departamento no existe retornamos un error
            if (!$departamento) {
                return response()->json([
                    'message' => 'Departamento no encontrado',
                    'error' => 'El departamento con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Retornamos el departamento en formato JSON
            return new DepartamentoResource($departamento);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el departamento',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Actualizar un departamento
    public function update(UpdateDepartamentoRequest $request, string $id)
    {
        try {
            // Buscamos un departamento por su ID
            $departamento = Departamento::find($id);

            // Si el departamento no existe retornamos un error
            if (!$departamento) {
                return response()->json([
                    'message' => 'Departamento no encontrado',
                    'error' => 'El departamento con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Actualizamos el departamento
            $departamento->update($request->all());

            // Retornamos el departamento en formato JSON
            return new DepartamentoResource($departamento);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el departamento',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Eliminar un departamento
    public function destroy(string $id)
    {
        try {
            // Buscamos un departamento por su ID
            $departamento = Departamento::find($id);

            // Si el departamento no existe retornamos un error
            if (!$departamento) {
                return response()->json([
                    // 'message' => 'Departamento no encontrado',
                    'error' => 'El departamento con el ID proporcionado no existe',
                    'status' => '404'
                ], 404);
            }

            // Eliminamos el departamento
            $departamento->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Departamento eliminado con éxito',
                'status' => '200'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el departamento',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
