<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'departamentos';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
    ];

    // Relación con la tabla municipios
    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}
