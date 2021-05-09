<?php

namespace App\Models;

use App\Models\Lugar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ruta extends Model
{
    use HasFactory;


    protected $fillable = [
        "lugar_salida","lugar_llegada","combi_id","tiempo","kms"
    ];

    public function salida()
    {
        return $this->belongsTo(Lugar::class,"id","lugar_llegada");
    }
    public function llegada()
    {
        return $this->belongsTo(Lugar::class,"id","lugar_llegada");
    }
    public function combi()
    {
        return $this->belongsTo(Combi::class);
    }
}
