<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;


class ChoferesController extends Controller
{
    public function listarChoferes()
    {

        $resultado= User::whereRoleIs('chofer')
            ->paginate(10);

        return view('administrator.listarchoferes')->with('resultado',$resultado);
        ;
    }

   


}
