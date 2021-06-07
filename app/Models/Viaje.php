<?php

namespace App\Models;

use DateTime;
use App\Models\Ruta;
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


    ];

    public function salida_formatted(){

        setlocale(LC_ALL,"es_ES");
        $date = DateTime::createFromFormat("d-m-Y", $this->fecha_salida);

        return strftime("%A %d %B",$date->getTimestamp());
    }

    public function ruta(){
        return $this->belongsTo(Ruta::class,"ruta_id","id");


    }





}
