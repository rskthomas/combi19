<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;


class ChoferesController extends Controller
{
    public function listarChoferes()
    {   

        $resultado= User::all();

        return view('listarChoferes')->with('resultado',$resultado);
        ;
    }

   
}
