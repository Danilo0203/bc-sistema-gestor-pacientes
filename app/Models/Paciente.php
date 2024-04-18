<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'pacientes';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'genero_id',
        'estado_civil_id',
        'profesion_id',
        'direccion_id'
    ];

    // Relación con la tabla generos
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    // Relación con la tabla estado_civil
    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class);
    }

    // Relación con la tabla profesiones
    public function profesion()
    {
        return $this->belongsTo(Profesion::class);
    }

    // Relación con la tabla direcciones
    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }
    
}
