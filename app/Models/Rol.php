<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'roles';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación uno a muchos
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
