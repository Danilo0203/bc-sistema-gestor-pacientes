<?php

namespace App\Http\Requests\DatoMedico;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDatoMedicoPacienteRequest extends FormRequest
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
        $method = $this->getMethod();

        if ($method === 'PUT') {
            return [
                'fecha' => ['required', 'date'],
                'dato_medico_id' => ['required', 'integer', 'exists:datos_medicos,id'],
                'paciente_id' => ['required', 'integer', 'exists:pacientes,id'],
                'valor' => ['required', 'string', 'max:50'],
            ];
        } else {
            return [
                'fecha' => ['sometimes','required', 'date'],
                'dato_medico_id' => ['sometimes','required', 'integer', 'exists:datos_medicos,id'],
                'paciente_id' => ['sometimes','required', 'integer', 'exists:pacientes,id'],
                'valor' => ['sometimes','required', 'string', 'max:50'],
            ];
        }
    }
}
