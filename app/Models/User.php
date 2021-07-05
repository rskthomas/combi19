<?php

namespace App\Models;

use App\Models\Pasaje;
use Carbon\Carbon;
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
        'birthdate',
        'bloqueado',
        'comproPasaje'
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


    public function profile()
    {
        if ($this->hasRole('chofer'))  return view('chofer.profile');

        else return view('user.profile');
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

    public function realizoPasaje(){

        $this->comproPasaje = true;
    }

    public function comproPasaje(): bool
    {

        return $this->comproPasaje;
    }

    public function isGold(): bool
    {

        return $this->isGold == true;
    }

    public function asignarTarjeta($tarjeta)
    {

        //setear la relacion 1-1 --
        $this->tarjeta()->save($tarjeta);
        $this->isGold = true;
        $this->save();
    }

    public function asignarPasaje()
    {

        //setear la relacion 1-1 --
        $this->save();
    }


    public static function choferesLibres()
    {

        $resultado = User::whereRoleIs('chofer')
            ->whereNull('combi_id')
            ->get();

        return $resultado;
    }

    public function pasajes()
    {
        return $this->hasMany(Pasaje::class);
    }

    public function misViajes(){

        if (isSet ($this->combi->ruta)){

            return $this->combi->ruta->viajes->where('estado', 'pendiente');

        }else return null;

    }

    public function bloquear(){

        $this->update(['bloqueado' => Carbon::now()->addDays(15)]);

    }

    public function estoyBloqueado(): bool{

        return ( isSet($this->bloqueado)  and  (! Carbon::create($this->bloqueado)->isPast() ));

    }
    public function fecha_desbloqueo(){


        $date = Carbon::create($this->bloqueado);
        setlocale(LC_TIME, "es_ES.UTF-8");
        return strftime("%A %d %B %R",$date->getTimestamp());
    }
}
