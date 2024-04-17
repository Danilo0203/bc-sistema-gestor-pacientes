<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'direcciones';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'municipio_id'
    ];

    // Relación con la tabla municipios
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

}
