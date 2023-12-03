<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operation';
    public $timestamps = false;
    protected $primaryKey = "id_operation";

    protected $fillable = [
        'id_operation ',
        'delta',
        'date',
        'id_account '
    ];
}
