<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = false;
    protected $primaryKey = "id_user";

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

    protected $casts = [
        'password' => 'hashed'
    ];
}
