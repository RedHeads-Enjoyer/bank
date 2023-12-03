<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    public $timestamps = false;
    protected $primaryKey = "id_account";

    protected $fillable = [
        'id_account',
        'id_user',
        'id_currency',
        'balance'
    ];
}
