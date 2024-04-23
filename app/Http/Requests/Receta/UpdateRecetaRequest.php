<?php

namespace App\Http\Requests\Receta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecetaRequest extends FormRequest
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
                'fecha' => ['required', 'date'],
                'user_id' => ['required', 'exists:users,id'],
            ];
        } else {
            return [
                'fecha' => ['sometimes','date'],
                'user_id' => ['sometimes','exists:users,id'],
            ];
        }
    }
}
