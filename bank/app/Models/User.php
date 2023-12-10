<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Название таблица
    public $timestamps = false; // Создание полей "когда обновлено/создано"
    protected $primaryKey = "id_user"; // Указание первичного ключа

    // Перечесление полей
    protected $fillable = [
        'id_user',
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'phone',
        'email',
        'password'
    ];

    // Опция хеширования пароля
    protected $casts = [
        'password' => 'hashed'
    ];

    // Получения токена
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Поля, записынные в токен
    public function getJWTCustomClaims()
    {
        return [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'role' => $this->role,
            'id_user' => $this->id_user
        ];
    }
}
