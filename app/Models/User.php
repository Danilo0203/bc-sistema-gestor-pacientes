<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nombre de la tabla
    protected $table = 'users';

    // Campos que se pueden llenar 
    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'password',
        'rol_id',
    ];

    // Campos que se ocultan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Campos que se deben convertir a tipos nativos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación uno a muchos inversa con la tabla roles
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
