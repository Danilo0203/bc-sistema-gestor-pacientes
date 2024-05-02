<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'citas';

    // Campos que se pueden llenar
    protected $fillable = [
        'paciente_id',
        'atender'   
    ];

    // Relación con la tabla pacientes
    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

}
