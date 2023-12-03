<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';
    public $timestamps = false;
    protected $primaryKey = "id_card";

    protected $fillable = [
        'id_card',
        'number',
        'cvc',
        'id_account'
    ];
}
