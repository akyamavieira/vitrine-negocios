<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    public $incrementing = false; // Desativa incremento automático
    protected $keyType = 'string'; // Define o tipo da chave primária como string (para UUID)

    protected $fillable = [
        'id',
        'nickname',
        'name',
        'email',
    ];

}
