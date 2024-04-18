<?php

namespace App\Http\Requests\EstadoCivil;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadoCivilRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:30', 'unique:estado_civil']
        ];
    }
}
