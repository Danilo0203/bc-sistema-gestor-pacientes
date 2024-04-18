<?php

namespace App\Http\Requests\Profesion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesionRequest extends FormRequest
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
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'nombre' => ['required', 'string', 'max:50', 'unique:profesiones,nombre']
            ];
        }  else {
            return [
                'nombre' => ['sometimes', 'required', 'string', 'max:50', 'unique:profesiones']
            ];
        }
    }
}
