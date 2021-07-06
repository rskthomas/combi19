<?php

namespace App\Models;

use DateTime;
use App\Models\Ruta;
use App\Models\Pasaje;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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


        $date = DateTime::createFromFormat("d-m-Y", $this->fecha_salida);
        setlocale(LC_TIME, "es_ES.UTF-8");
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
           return $this->cant_asientos -count($this->pasajes->where('estado','=' ,'pendiente'));
        }


   }
   public function siguienteAsiento(){

       return (count($this->pasajes))+1;



}



public static function seSuperpone(String $fecha_salida, String $hora_salida,String $ruta, $id= 0):bool{

    
    $v_mismoDia  = Viaje::where('ruta_id', '=', $ruta)->where('fecha_salida' , '=', $fecha_salida)->where('id' , '!=', $id)->get();

        $fecha_viaje = new Carbon($fecha_salida . $hora_salida);

        foreach ($v_mismoDia as $viaje) {

            $viajeDate = new CarbonImmutable($viaje->fecha_salida . $viaje->hora_salida);

            if ($fecha_viaje->between(
                $viajeDate->subHours($viaje->ruta->tiempo * 2),
                $viajeDate->addHours($viaje->ruta->tiempo * 2)
            )) {

                return true;
            };
        };
        return false;
}


}
