<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;

    // Nombre de la tabla 
    protected $table = 'estado_civil';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre'
    ];

    // Relación con la tabla pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
