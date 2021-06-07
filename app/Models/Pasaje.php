<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
