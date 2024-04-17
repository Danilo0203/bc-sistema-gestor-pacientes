<?php

namespace App\Http\Resources\Direccion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DireccionResource extends JsonResource
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
            'nombre' => $this->nombre,
            'municipio' => [ 
                'id' => $this->municipio->id,
                'nombre' => $this->municipio->nombre,
                'departamento' => 
                [
                    'id' => $this->municipio->departamento->id,
                    'nombre' => $this->municipio->departamento->nombre
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
