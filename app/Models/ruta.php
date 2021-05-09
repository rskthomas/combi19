<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruta extends Model
{
    use HasFactory;


    protected $fillable = [
        "lugar_salida","lugar_llegada","combi_id","tiempo","kms"
    ];
}
