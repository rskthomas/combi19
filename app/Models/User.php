<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isGold',
        'cellphone',
        'birthdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function combi()
    {
        return $this->belongsTo(Combi::class);
    }

    public function tarjeta()
    {
        return $this->hasOne(Tarjeta::class);
    }

    public  function tieneTarjeta(){

        return isSet($this->tarjeta);
    }

    public function isGold(): bool{

        return $this->isGold;
    }

    public function asignarTarjeta($tarjeta){

            //setear la relacion 1-1 --
            $this->tarjeta()->save($tarjeta);
            $this->isGold = true;
            $this->save();

    }
    public static function choferesLibres()
    {

        $resultado = User::whereRoleIs('chofer')
                ->whereNull('combi_id')
                ->get();

        return $resultado;
    }
}
