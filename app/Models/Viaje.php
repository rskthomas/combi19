<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_salida',
        'precio',
        'cant_asientos',
        'ruta',
        'hora_salida'
    ];
    protected $casts = [
  
        'hora_salida' => 'datetime:H:i:s'
    ];
    


    public function ruta(){
        return $this->belongsTo(Ruta::class,"ruta","id");


    }

    



}
