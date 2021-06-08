<?php

namespace App\Models;

use DateTime;
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


    ];

    public function salida_formatted(){

        setlocale(LC_ALL,"es_ES");
        $date = DateTime::createFromFormat("d-m-Y", $this->fecha_salida);

        return strftime("%A %d %B",$date->getTimestamp());
    }

    public function ruta(){
        return $this->belongsTo(Ruta::class,"ruta_id","id");


    }
    public function pasajes()
    {
        return $this->hasMany(Pasaje::class,"viaje_id","id");
    }

    public function pasajesLibres(){
        if( isset($this->pasajes)){
           return $this->cant_asientos -count($this->pasajes);
        }


   }
   public function siguienteAsiento(){

       return (count($this->pasajes))+1;



}






}
