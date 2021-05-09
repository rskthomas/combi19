<?php

namespace App\Models;

use App\Models\ruta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lugar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre','provincia'
    ];
  
    public function ruta()
    {
        return $this->hasMany(ruta::class,'lugar_salida','lugar_salida');
    }

}
