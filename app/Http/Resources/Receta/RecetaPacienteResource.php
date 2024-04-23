<?php

namespace App\Http\Resources\Receta;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecetaPacienteResource extends JsonResource
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
            'receta' => [
                'id' => $this->receta->id,
                'fecha' => $this->receta->fecha,
            ],
            'paciente' => [
                'id' => $this->paciente->id,
                'nombre' => $this->paciente->nombre,
                'apellido' => $this->paciente->apellido,
            ],
            'descripcion' => $this->descripcion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    
    }
}
