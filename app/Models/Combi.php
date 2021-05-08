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
        return ( $this->tipo_de_combi = 'comoda' );
    }
}
