<?php

namespace App\Models;

use App\Models\Ruta;
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
        return $this->hasMany(ruta::class,"lugar_salida","id");
    }
    
    public function ruta2()
    {
        return $this->hasMany(ruta::class,"lugar_llegada","id");
    }

}
