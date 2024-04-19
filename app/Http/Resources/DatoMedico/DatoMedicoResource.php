<?php

namespace App\Http\Resources\DatoMedico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatoMedicoResource extends JsonResource
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
            'nombre'=> $this->nombre,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
