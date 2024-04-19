<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoMedico extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'datos_medicos';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre'
    ];

    // Relación cpn la tabla datos medicos pacientes
    public function datoMedicoPacientes(){
        return $this->hasMany(DatoMedicoPaciente::class);
    }
}
