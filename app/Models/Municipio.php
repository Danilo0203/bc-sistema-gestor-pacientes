<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    // Nombre de la tabla 
    protected $table = 'municipios';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'departamento_id'
    ];

    // Relación con la tabla departamentos
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    // Relación con la tabla direcciones
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
