<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'recetas';

    // Campos que se pueden llenar 
    protected $fillable = ['fecha', 'user_id'];

    // Relación con la tabla users
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos con la tabla receta pacientes
    public function receta_pacientes(){
        return $this->hasMany(RecetaPaciente::class);
    }
}
