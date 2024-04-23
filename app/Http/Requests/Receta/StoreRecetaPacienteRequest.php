<?php

namespace App\Http\Requests\Receta;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecetaPacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'receta_id' => ['required', 'integer', 'exists:recetas,id'],
            'paciente_id' => ['required', 'integer', 'exists:pacientes,id'],
            'descripcion' => ['required', 'string', 'max:2000'],
        ];
    }
}
