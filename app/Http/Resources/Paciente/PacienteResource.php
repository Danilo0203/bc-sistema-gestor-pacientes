<?php

namespace App\Http\Resources\Paciente;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
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
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,  
            'genero' => [
                'id' => $this->genero->id,
                'nombre' => $this->genero->nombre
            ],
            'estado_civil' => [
                'id' => $this->estadoCivil->id,
                'nombre' => $this->estadoCivil->nombre
            ],
            'profesion' => [
                'id' => $this->profesion->id,
                'nombre' => $this->profesion->nombre
            ],
            'direccion' => [
                'id' => $this->direccion->id,
                'nombre' => $this->direccion->nombre,
                'municipio' => [ 
                    'id' => $this->direccion->municipio->id,
                    'nombre' => $this->direccion->municipio->nombre,
                    'departamento' => 
                    [
                        'id' => $this->direccion->municipio->departamento->id,
                        'nombre' => $this->direccion->municipio->departamento->nombre
                    ],
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
