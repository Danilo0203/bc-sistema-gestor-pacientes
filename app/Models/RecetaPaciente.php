<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaPaciente extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'receta_pacientes';

    // Campos que se pueden llenar
    protected $fillable = ['receta_id', 'paciente_id', 'descripcion'];

    // Relación uno a muchos con la tabla recetas
    public function receta(){
        return $this->belongsTo(Receta::class);
    }

    // Relación uno a muchos con la tabla pacientes
    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

}
