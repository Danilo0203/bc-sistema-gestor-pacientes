<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            // Encriptamos la contraseña
            $this->merge([
                'password' => bcrypt($this->password),
            ]);
            return [
                'nombre' => ['required', 'string', 'max:30'],
                'usuario' => ['required', 'string', 'max:30', 'unique:users,usuario,' . $this->route('user')->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('user')->id],
                'password' => ['required', 'string', 'max:255', ''],
                'rol_id' => ['required', 'integer', 'exists:roles,id'],
            ];
        } else {
            if (!$this->filled('password')) {
                return [
                    'nombre' => ['sometimes', 'string', 'max:30'],
                    'usuario' => ['sometimes', 'string', 'max:30', 'unique:users,usuario'],
                    'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email'],
                    'rol_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            } else { 
                // ENCRIPTAR CONTRASEÑA
                $this->merge([
                    'password' => bcrypt($this->password),
                ]);
                return [
                    'nombre' => ['sometimes', 'string', 'max:30'],
                    'usuario' => ['sometimes', 'string', 'max:30', 'unique:users,usuario'],
                    'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email'],
                    'password' => ['sometimes', 'string', 'max:255'],
                    'rol_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            }
        }
    }
}
