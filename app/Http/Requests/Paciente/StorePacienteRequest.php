<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:30'],
            'apellido' => ['required', 'string', 'max:30'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero_id' => ['required', 'exists:generos,id'],
            'estado_civil_id' => ['required', 'exists:estado_civil,id'],
            'profesion_id' => ['required', 'exists:profesiones,id'],
            'direccion_id' => ['required', 'exists:direcciones,id']
        ];
    }
}
