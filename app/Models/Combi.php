<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
    protected $fillable = [
        'patente',
        'asientos',
        'isComoda',
        'chofer_id',
        'modelo',
    ];
}
