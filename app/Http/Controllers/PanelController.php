<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PanelController extends Controller
{
    // Informacion del panel
    public function index()
    {
        try {
            // Informacion de los pacientes
            $pacientes = Paciente::select('id', 'nombre', 'apellido')->get();
            $totalPacientes = $pacientes->count();

            // Pacientes sin recetas médicas
            $pacientesSinRecetas = Paciente::doesntHave('recetaPacientes')->select('id')->get();
            $totalPacientesSinRecetas = $pacientesSinRecetas->count();

            // Pacientes atendidos hoy 
            $pacientesAtendidos = Paciente::whereHas('cita', function($query){
                $query->where('atender', 0)->whereDate('updated_at', now());
            })->select('id', 'nombre', 'apellido')->get();
            $conteoPacientesAtendidos = $pacientesAtendidos->count();

            // Pacientes por atender hoy
            $pacientesPorAtender = Paciente::whereHas('cita', function($query){
                $query->where('atender', 1);
            })->select('id', 'nombre', 'apellido')->get();
            $conteoPacientesPorAtender = $pacientesPorAtender->count();

            // Mandar mensaje si llegamos a 20 pacientes por atender
            $totalAtender = $conteoPacientesAtendidos + $conteoPacientesPorAtender;
            if ($totalAtender >= 20) {
                $mensaje = 'Llegamos al límite de pacientes por atender'; 
            }

            // Pacientes nuevos registrados hoy
            // $pacientesNuevosHoy = Paciente::whereDate('created_at', now())->select('id', 'nombre')->get();

            // Retornamos la información del panel en formato JSON
            return response()->json([
                'pacientes' => [
                    'data' => $pacientes,
                    'total' => $totalPacientes,
                    'sin_recetas' => $totalPacientesSinRecetas,
                    'con_recetas' => $totalPacientes - $totalPacientesSinRecetas,
                ],
                'pacientes_atendidos_hoy' => [
                    'data' => $pacientesAtendidos,
                    'total' => $conteoPacientesAtendidos
                ],
                'pacientes_por_atender' => [
                    'data' => $pacientesPorAtender,
                    'total' => $conteoPacientesPorAtender,
                    'mensaje' => $mensaje ?? null,
                ],
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los datos del panel',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }
}
