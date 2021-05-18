<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
    protected $fillable = [
        'patente',
        'asientos',
        'tipo_de_combi',
        'modelo',
    ];



    public function chofer()
    {
        return $this->hasOne(User::class, 'combi_id');
    }
    public function isComoda()
    {
        return ( $this->tipo_de_combi == "comoda" );
    }
    public function ruta()
    {
        return $this->hasOne(ruta::class, 'combi_id',"id");
    }


    /*Borra el chofer asingnado a la combi, si este existe */
    public function desasignarChofer(){

        if (isset($this->chofer)) {
            $chofer_viejo = User::find($this->chofer->id);
            $chofer_viejo->combi()->dissociate();
            $chofer_viejo->save();
        }

    }

    /*asigna de forma segura el chofer a la combi */
    public function asignarChofer(int $chofer_id){

        if (isset($chofer_id)) {

            $chofer = User::find($chofer_id);
            //setear la relacion 1-1 --
            $this->chofer()->save($chofer);
        }
    }



}
