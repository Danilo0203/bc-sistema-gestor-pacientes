<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'usuario' => $this->usuario,
            'email' => $this->email,
            'rol' => [
                'id' => $this->rol->id,
                'nombre' => $this->rol->nombre,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'recetas_registradas' => [
                'total' => $this->recetas->count(),
                'data' => $this->recetas,
            ],
        ];
    }
}
