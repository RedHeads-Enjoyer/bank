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

  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }
}
