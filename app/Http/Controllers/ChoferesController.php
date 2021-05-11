<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ChoferesController extends Controller
{
    public function listarChoferes()
    {

        $resultado= User::whereRoleIs('chofer')
            ->paginate(6);

        return view('administrator.listarchoferes')->with('resultado',$resultado);
        ;
    }


    public static function  eliminarChofer(User $user){

        if(isset($user->combi)){
            return redirect()->to(route('profile', ['user'=> $user]))-> with('tienecombi',$user->name);

        }
        echo $user;
        DB::table('users')->whereId($user->id)->delete();
       return redirect()->to(route('listarchoferes'))-> with('usuarioeliminado',$user->name);

    }



}
