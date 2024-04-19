<?php

namespace App\Http\Resources\DatoMedico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatoMedicoPacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'dato_medico' => [
                'id' => $this->datoMedico->id,
                'nombre' => $this->datoMedico->nombre,
            ],
            'paciente' => [
                'id' => $this->paciente->id,
                'nombre' => $this->paciente->nombre,
            ],
            'valor' => $this->valor,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
