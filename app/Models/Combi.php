<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
    protected $fillable = [
        'patente',
        'asientos',
        'tipo_de_combi',
        'chofer_id',
        'modelo',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function isComoda()
    {
        return ( $this->tipo_de_combi = 'comoda' );
    }
}
