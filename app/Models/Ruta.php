<?php

namespace App\Models;

use App\Models\Lugar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruta extends Model
{
    use HasFactory;


    protected $fillable = [
        "lugar_salida","lugar_llegada","combi_id","tiempo","kms"
    ];

    public function salida()
    {
        return $this->belongsTo(Lugar::class,"lugar_salida","id");
    }
    public function llegada()
    {
        return $this->belongsTo(Lugar::class,"lugar_llegada","id");
    }
    public function combi()
    {
        return $this->belongsTo(Combi::class);
    }
    public function viajes()
    {
        return $this->hasMany(ruta::class,"ruta","id");
    }


}
