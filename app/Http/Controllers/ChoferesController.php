<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;


class ChoferesController extends Controller
{
    public function listarChoferes()
    {   

        $resultado= User::select('users.id','users.name','users.email')
            ->join('role_user', 'users.id','=','role_user.user_id')
            ->where('role_user.role_id','=', '2')// si cambia el id del rol hay que modificarlo
            ->get();

        return view('listarChoferes')->with('resultado',$resultado);
        ;
    }

   
}
