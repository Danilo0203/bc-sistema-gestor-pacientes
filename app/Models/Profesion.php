<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'profesiones';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre'
    ];
}
