<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogViaje extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_salida',
        'precio',
        'pasajes_vendidos',
        'ruta_id',
        'hora_salida',
        'estado',
        'nombre_chofer',
        'mail_chofer',
        'id_chofer',
        'salida',
        'llegada'
    ];
}
