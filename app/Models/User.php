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

    public function home()
    {

        //if ($this->hasRole('administrator')) return view('administrator.home');
        if ($this->hasRole('administrator')) return view('user.search');

        else if ($this->hasRole('chofer'))  return view('chofer.home');

        else return view('user.search');
    }


    public function combi()
    {
        return $this->belongsTo(Combi::class);
    }

    public function tarjeta()
    {
        return $this->hasOne(Tarjeta::class);
    }

    public  function tieneTarjeta()
    {

        return isset($this->tarjeta);
    }

    public function isGold(): bool
    {

        return $this->isGold;
    }

    public function asignarTarjeta($tarjeta)
    {

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
