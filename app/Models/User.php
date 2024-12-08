<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Defina os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    // Opcional: Defina os campos que não devem ser serializados (caso precise)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Opcional: Defina o tipo de dados do campo `password` para garantir a criptografia
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
