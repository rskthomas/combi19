<?php

namespace App\Models;

use App\Models\Ruta;
use App\Models\Pasaje;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_salida',
        'precio',
        'cant_asientos',
        'ruta_id',
        'hora_salida',
        'estado'
    ];
    protected $casts = [
  
        'hora_salida' => 'datetime:H:i:s'
    ];
    


    public function ruta(){
        return $this->belongsTo(Ruta::class,"ruta_id","id");


    }
    public function viajes()
    {
        return $this->hasMany(Pasaje::class,"viaje_id","id");
    }

    



}
