<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoMedicoPaciente extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'datos_medicos_paciente';

    // Campos que se pueden llenar
    protected $fillable = [
        'fecha',
        'dato_medico_id',
        'paciente_id',
        'valor'
    ];

    // Relación con la tabla datos medicos
    public function datoMedico(){
        return $this->belongsTo(DatoMedico::class);
    }

    // Relación con la tabla pacientes
    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

}
