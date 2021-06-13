<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cvc',
        'number',
        'expiration_month',
        'expiration_year',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vencida()
    {
        return ($this->expiration_year > Date("Y",time()) &&($this->expiration_month > Date("m",time()))) ;
    }

}
