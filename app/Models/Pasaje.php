<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasaje extends Model
{
    use HasFactory;
    protected $fillable = [
        'asiento','estado','productos','total_pasaje','total_productos',
        'viaje_id'
    ];
    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

}
